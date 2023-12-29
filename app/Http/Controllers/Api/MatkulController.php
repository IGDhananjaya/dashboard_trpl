<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatkulResource;
use App\Models\Kurikulum;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    public function index()
    {
        $matkuls = Kurikulum::latest()
                ->filter(request(['search']))
                ->get();

        return response()->json(['data' => $matkuls]);
    }

    public function show($id)
    {
        $matkul = Kurikulum::find($id);

        if ($matkul) {
            return new MatkulResource($matkul);
        } else {
            return response()->json(['message' => 'Matakuliah not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "mk_kode" => "required",
            "mk_nama" => "required",
            "semester" => "required",
            "sks" => "required",
        ]);
    
        // $response = Kurikulum::create($validatedData);
        // return response()->json(['message' => 'Data berhasil disimpan', 'data' => $response], 201);

        $matkul = Kurikulum::create($validatedData);
        return new MatkulResource($matkul);
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        "mk_kode" => "required",
        "mk_nama" => "required",
        "semester" => "required",
        "sks" => "required",
    ]);
    
    $matkul = Kurikulum::find($id);
    if (!$matkul) {
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
    
    $matkul->update($validatedData); // Gunakan metode update untuk memperbarui data yang ada.
    
    return new MatkulResource($matkul);
}


    public function destroy($id)
    {
        try {
            $matkul = Kurikulum::find($id);
            if (!$matkul) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }
            
            $matkul->delete();
            return response()->json(['message' => 'Data berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Terjadi kesalahan', 'error' => $th->getMessage()], 500);
        }
    }
}
