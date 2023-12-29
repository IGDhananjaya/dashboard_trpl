<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
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
        $kategories=new kategori;
        $kategories = kategori::latest()
        ->filter(request(['search']))
        ->skip($offset) // Melewati item yang tidak dibutuhkan
        ->take($perPage) // Mengambil item sebanyak yang diperlukan untuk halaman saat ini
        ->paginate($perPage); // Menghitung paginasi dengan jumlah item per halaman
        // ->get();

        return view('kategori.index', ['kategories' => $kategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title="Create Page";
        $kategories=kategori::all();
        return view('kategori.addCategory',compact('kategories'));
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
            'kategori'=>'required'
        ]);
        // $response=kategori::create($validatedData);
        // // route(KategoriController.store);
        // dd($validatedData);
        //     return redirect('/dashboard/kategori')->with('success', 'kategori berhasil ditambahkan');
        try {
            $response = kategori::create($validatedData);
            // dd($response);
            return redirect('/dashboard/kategori');
        } catch (\Exception $e) {
            // dd($e->getMessage());
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
        $title="Edit Page";
        $kategories = kategori::all();
        $kategories=kategori::find($id);
        return view("kategori.editCategory",compact("kategories"));
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
            'kategori'=>'required'
        ]);
        // $response=kategori::create($validatedData);
        // // route(KategoriController.store);
        // dd($validatedData);
        //     return redirect('/dashboard/kategori')->with('success', 'kategori berhasil ditambahkan');
        try {
            $response = kategori::find($id)->update($validatedData);
            // dd($response);
            return redirect('/dashboard/kategori');
        } catch (\Exception $e) {
            // dd($e->getMessage());
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
            $dosens=kategori::find($id);
            $dosens->delete();
            return redirect('/dashboard/kategori');
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
