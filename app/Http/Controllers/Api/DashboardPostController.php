<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Resources\BeritaResource;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Validator;


class DashboardPostController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10;
        $currentPage = $request->query('page', 1);
        $offset = ($currentPage - 1) * $perPage;

        $beritas = Berita::latest()
            ->filter($request->only('search'))
            ->skip($offset)
            ->take($perPage)
            ->paginate($perPage);

        return response()->json(['data' => $beritas]);
    }


    public function create()
    {
        return view('berita.createPost', [
            'categories' => Kategori::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'slug' => 'required|unique:berita',
            'description' => 'required',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        // Penyimpanan file photo
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $originalName = $file->getClientOriginalName(); // Menggunakan nama asli file
            $photoPath = $file->storeAs('uploads', $originalName, 'public');
            $data['photo'] = $photoPath; // Menyimpan path file ke dalam data
        }

        // Penyimpanan file related_images (jika diperlukan)
        if ($request->hasFile('related_images')) {
            $relatedImageFiles = $request->file('related_images');
            $relatedImagePaths = [];

            foreach ($relatedImageFiles as $relatedImage) {
                $path = $relatedImage->store('uploads', 'public');
                $relatedImagePaths[] = $path;
            }

            $data['related_images'] = json_encode($relatedImagePaths);
        }

        // Membuat entri berita
        $berita = Berita::create($data);

        return response()->json(['data' => new BeritaResource($berita)], 201);
    }





    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->first();
        return view('berita.show', ['berita' => $berita]);
    }

    public function edit($slug)
    {
        $berita = Berita::where('slug', $slug)->first();
        return view('berita.edit', [
            'berita' => $berita,
            'categories' => Kategori::all(),
        ]);
    }

    public function update(Request $request, $slug)
    {
        $berita = Berita::where('slug', $slug)->first();

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'kategori_id' => 'required',
            'related_images' => 'array',
            'related_images.*' => 'image|mimes:jpg,jpeg,png|max:2000',
        ]);

        if ($request->slug != $berita->slug) {
            $request->validate(['slug' => 'required|unique:berita']);
        }

        if ($request->slug != $berita->slug) {
            $rules['slug'] = 'required|unique:berita';
        }

        
        if ($request->hasFile('photo')) {
            $rules['photo'] = 'image|mimes:jpg,jpeg,png|max:2000';
        }

        $validatedData = $request->validate($rules);

       
        if ($request->hasFile('photo')) {
            if ($berita->photo) {
                $oldPhotoPath = storage_path('app/public/' . $berita->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }

                
                $file = $request->file('photo');
                $originalName = $file->getClientOriginalName();
                $photoPath = $file->storeAs('uploads', $originalName, 'public');
                $validatedData['photo'] = $photoPath;
            }
        }

        // Periksa apakah ada gambar terkait yang perlu dihapus dan ganti yang baru
        if ($request->hasFile('related_images')) {
            // Hapus gambar terkait lama (jika ada)
            $oldRelatedImages = json_decode($berita->related_images, true);

            foreach ($oldRelatedImages as $relatedImage) {
                $oldImagePath = storage_path('app/public/' . $relatedImage['path']);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $related_image = [];
            foreach ($request->file('related_images') as $photo) {
                $name = $photo->getClientOriginalName();
                $photoPath = $photo->store('uploads', 'public');
                $related_image[] = [
                    'name' => $name,
                    'path' => $photoPath,
                ];
            }

            $validatedData['related_images'] = json_encode($related_image);
        }

        $berita = Berita::create($validatedData);
        return new BeritaResource($berita);
    }

    public function destroy($slug)
    {
        $berita = Berita::where('slug', $slug)->first();
        if ($berita) {
            $berita->delete();
            return response()->json(['message' => 'Berita berhasil dihapus']);
        }
        return response()->json(['message' => 'Berita tidak ditemukan'], 404);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Berita::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}