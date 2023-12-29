<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\KategoriResource;
use Illuminate\Support\Facades\Validator;


class KategoriController extends Controller
{
    public function index()
    {
        // $kategoris = Kategori::all();
        // return KategoriResource::collection($kategoris);

        // Menggunakan filter jika ada parameter search
        $kategories = Kategori::latest()->filter(request(['search']))->get();

        // Menggunakan resource untuk mengubah format data
        return KategoriResource::collection($kategories);
    }

    public function show($id)
    {
        $kategori = Kategori::find($id);

        if ($kategori) {
            return new KategoriResource($kategori);
        } else {
            return response()->json(['message' => 'Kategori not found'], 404);
        }
    }

    public function store(Request $request)
    {
        // $data = $request->all();
        // $kategori = Kategori::create($data);
        // return new KategoriResource($kategori);

        $validatedData = $request->validate([
            'kategori' => 'required'
        ]);
    
        try {
            $kategori = Kategori::create($validatedData);
            // return redirect('/dashboard/kategori');
            return new KategoriResource($kategori);
        } catch (\Exception $e) {
            // Handle error if needed
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'kategori' => 'required'
            ]);
    
            $kategori = kategori::find($id);
            
            if (!$kategori) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }
    
            $kategori->update($validatedData);
    
            // return response()->json(['message' => 'Kategori berhasil diperbarui'], 200);
            return new KategoriResource($kategori);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat memperbarui kategori', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        // $kategori = Kategori::find($id);

        // if ($kategori) {
        //     $kategori->delete();
        //     return response()->json(['message' => 'Deleted successfully']);
        // } else {
        //     return response()->json(['message' => 'Kategori not found'], 404);
        // }

        try {
            $kategori = Kategori::find($id);
    
            if (!$kategori) {
                return response()->json(['message' => 'Kategori not found'], 404);
            }
    
            $kategori->delete();
    
            return response()->json(['message' => 'Kategori deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}