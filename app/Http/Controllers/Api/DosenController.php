<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Resources\DosenResource;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $dosens = Dosen::latest()->filter($request->all())->get();
        return DosenResource::collection($dosens);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "dosen_code" => "required",
            "name" => "required",
            "skill" => "required",
            "certified" => "required",
            "photo" => "required|image|mimes:jpg,jpeg,png|max:2000",
            "nip" => "required|numeric",
            "gender" => 'required'
        ]);

        try {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $originalName = $file->getClientOriginalName();
                $photoPath = $file->storeAs('images/dosen', $originalName, 'public');
                $validatedData['photo'] = $photoPath;
            }

            $dosen = Dosen::create($validatedData);
            $this->processImagePaths();
            return new DosenResource($dosen);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

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
            
            return (new DosenResource($dosen))->response()->setStatusCode(200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function destroy($id)
    {
        try {
            $dosen = Dosen::find($id);
            if ($dosen) {
                $dosen->delete();
                return response()->json(['message' => 'Dosen berhasil dihapus']);
            } else {
                return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
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
}


// ------


// namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
// use App\Models\Dosen;
// use Illuminate\Http\Request;
// use App\Http\Resources\DosenResource;

// class DosenController extends Controller
// {
//     public function index(Request $request)
//     {
//         $dosens = Dosen::latest()->filter($request->all())->get();
//         return DosenResource::collection($dosens);
//     }

//     public function store(Request $request)
//     {
//         $validatedData = $request->validate([
//             "dos    en_code" => "required",
//             "name" => "required",
//             "skill" => "required",
//             "certified" => "required",
//             "photo" => "required|image|mimes:jpg,jpeg,png|max:2000",
//             "nip" => "required|numeric",
//             "gender" => 'required'
//         ]);

//         try {
//             if ($request->hasFile('photo')) {
//                 $file = $request->file('photo');
//                 $originalName = $file->getClientOriginalName();
//                 $photoPath = $file->storeAs('images/dosen', $originalName, 'public');
//                 $validatedData['photo'] = $photoPath;
//             }

//             $dosen = Dosen::create($validatedData);
//             return new DosenResource($dosen);

//         } catch (\Exception $e) {
//             return response()->json(['error' => $e->getMessage()], 500);
//         }
//     }

//     public function update(Request $request, $id)
//     {
//         $validatedData = $request->validate([
//             "dosen_code" => "required",
//             "name" => "required",
//             "skill" => "required",
//             "certified" => "required",
//             "photo" => "nullable|image|mimes:jpg,jpeg,png|max:2000",
//             "nip" => "required|numeric",
//             "gender" => 'required'
//         ]);

//         try {
//             $dosen = Dosen::findOrFail($id);

//             if ($request->hasFile('photo')) {
//                 $file = $request->file('photo');
//                 $originalName = $file->getClientOriginalName();
//                 $photoPath = $file->storeAs('images/dosen', $originalName, 'public');
//                 $validatedData['photo'] = $photoPath;
//             }

//             $dosen->update($validatedData);
//             return new DosenResource($dosen);

//         } catch (\Exception $e) {
//             return response()->json(['error' => $e->getMessage()], 500);
//         }
//     }

//     public function destroy($id)
//     {
//         try {
//             $dosen = Dosen::find($id);
//             if ($dosen) {
//                 $dosen->delete();
//                 return response()->json(['message' => 'Dosen berhasil dihapus']);
//             } else {
//                 return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
//             }
//         } catch (\Exception $e) {
//             return response()->json(['error' => $e->getMessage()], 500);
//         }
//     }
// }
