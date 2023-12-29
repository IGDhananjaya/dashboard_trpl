<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use Illuminate\Http\Request;

class MatkulController extends Controller
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
        $matkuls=new Kurikulum;

        // $matkuls=new Kurikulum;
        // $matkuls=Kurikulum::get();
        // return view('matkul.index', compact('matkuls'));
        // $matkuls = $matkuls->paginate(10);
        
        $matkuls = Kurikulum::latest()
        ->filter(request(['search']))
        ->skip($offset) // Melewati item yang tidak dibutuhkan
        ->take($perPage) // Mengambil item sebanyak yang diperlukan untuk halaman saat ini
        ->paginate($perPage); // Menghitung paginasi dengan jumlah item per halaman

        return view('matkul.index', ['matkuls' => $matkuls]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title="Create Page";
        $matkuls=Kurikulum::all();
        return view('matkul.addMatkul',compact('matkuls'));
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
            "mk_kode" => "required",
            "mk_nama" => "required",
            "semester" => "required",
            "sks" => "required",
        ]);
        $response=Kurikulum::create($validatedData);
        return redirect('/dashboard/matkul');
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
        $title="Edit Page";
        $matkuls = Kurikulum::all();
        $matkuls = Kurikulum::find($id);
        return view("matkul.editMatkul",compact("matkuls"));
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
            "mk_kode" => "required",
            "mk_nama" => "required",
            "semester" => "required",
            "sks" => "required",
        ]);
        $response=Kurikulum::find($id)->update($validatedData);
        return redirect('/dashboard/matkul');
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
            $dosens=Kurikulum::find($id);
            $dosens->delete();
            return redirect('/dashboard/matkul');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
