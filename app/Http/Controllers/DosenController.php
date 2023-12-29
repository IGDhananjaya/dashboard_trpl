<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage=10;
        $currentPage = request()->query('page', 1); 
        $offset = ($currentPage - 1) * $perPage;
        $dosens=new Dosen;

        $dosens = Dosen::latest()
        ->filter(request(['search']))
        ->skip($offset) // Melewati item yang tidak dibutuhkan
        ->take($perPage) // Mengambil item sebanyak yang diperlukan untuk halaman saat ini
        ->paginate($perPage); // Menghitung paginasi dengan jumlah item per halaman
        // ->get();

        return view('dosen.index', ['dosens' => $dosens]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create Page";
        $dosens = Dosen::all();
        return view('dosen.tambahDosen', compact('dosens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            "dosen_code" => "required",
            "name" => "required",
            "skill" => "required",
            "certified" => "required",
            "photo" => "required|image|mimes:jpg,jpeg,png|max:2000", // Validasi gambar
            "nip" => "required|numeric",
            "gender" => 'required'
        ]);

        try {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $originalName = $file->getClientOriginalName();
                
                // Simpan gambar ke direktori 'images/dosen' tanpa awalan 'images/dosen/'
                $photoPath = $file->storeAs('images/dosen', $originalName, 'public');
                
                // Modifikasi path sebelum disimpan ke database
                $validatedData['photo'] = $photoPath;
                
                // Jika Anda ingin memanggil fungsi untuk memproses path gambar (opsional)
                // $this->processImagePaths();
            }
            
            Dosen::create($validatedData);
            
            return redirect('/dashboard/dosen')->with('success', 'Data dosen berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/dashboard/dosen')->with('error', $e->getMessage());
        }
    }

    // Jika Anda memilih untuk memproses path gambar secara otomatis setelah setiap penyimpanan, Anda dapat memasukkan fungsi berikut:
    private function processImagePaths()
    {
        // Ambil semua data dosen
        $dosens = Dosen::all();
        
        foreach ($dosens as $dosen) {
            $currentPhoto = $dosen->photo;
            
            if (strpos($currentPhoto, 'images/dosen/') === 0) {
                // Hapus awalan 'images/dosen/' dari path
                $newPhotoPath = substr($currentPhoto, strlen('images/dosen/'));
                
                // Update path gambar di database
                $dosen->update(['photo' => $newPhotoPath]);
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Page";
        $dosens = Dosen::all();
        $dosens = Dosen::find($id);
        return view("dosen.editDosen", compact("dosens"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            "dosen_code" => "required",
            "name" => "required",
            "skill" => "required",
            "certified" => "required",
            "photo" => "nullable|image|mimes:jpg,jpeg,png|max:2000", // Validasi gambar (opsional)
            "nip" => "required|numeric",
            "gender" => 'required'
        ]);

        try {
            $dosen = Dosen::findOrFail($id);

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $originalName = $file->getClientOriginalName();
                
                // Simpan gambar ke direktori 'images/dosen' tanpa awalan 'images/dosen/'
                $photoPath = $file->storeAs('images/dosen', $originalName, 'public');
                
                // Modifikasi path sebelum disimpan ke database
                $validatedData['photo'] = $photoPath;
            }

            // Update data dosen dengan data yang validasi
            $dosen->update($validatedData);
            
            // Panggil fungsi untuk memproses path gambar
            $this->updateImagePaths();
            
            return redirect('/dashboard/dosen')->with('success', 'Data dosen berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect('/dashboard/dosen')->with('error', $e->getMessage());
        }
    }

    // Fungsi untuk memproses path gambar
    private function updateImagePaths()
    {
        // Ambil semua data dosen
        $dosens = Dosen::all();
        
        foreach ($dosens as $dosen) {
            $currentPhoto = $dosen->photo;
            
            if (strpos($currentPhoto, 'images/dosen/') === 0) {
                // Hapus awalan 'images/dosen/' dari path
                $newPhotoPath = substr($currentPhoto, strlen('images/dosen/'));
                
                // Update path gambar di database
                $dosen->update(['photo' => $newPhotoPath]);
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $dosens = Dosen::find($id);
            $dosens->delete();
            return redirect('/dashboard/dosen');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
