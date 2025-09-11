<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //menampilkan halaman kategori
        return view('admin.kategori');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$kategori diisi dengan objek dari model kategori
        //$kategori->nama_kategori sesuai dengan nama field di table
        //$reuest->nama_kategori sesuai dengan name pada form input
        $kategori = new Kategori;
        $kategori->nama_kategori= $request->nama_kategori;
        $kategori->deskripsi= $request->deskripsi;
        $kategori->save();

        //kembali ke halaman kategori
       return redirect('/admin/kategori');

        // dd($kategori);
        // die;
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}
