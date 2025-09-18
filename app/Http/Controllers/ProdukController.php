<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         //menampilkan kategori
        // query untuk memanggil data dari table kategori
        $data['produk']=Produk::all();
        $data['kategori']=Kategori::all();

        // mengirim data ke tampilan
        return view('admin.produk',$data);
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
        $produk = new Produk;
        $produk->nama= $request->nama;
        $produk->harga= $request->harga;
        $produk->stok= $request->stok;
        $produk->kategori_id= $request->kategori_id;
        $produk->save();

        //kembali ke halaman kategori
       return redirect('/admin/produk');

        // dd($kategori);
        // die;
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
         //mengamnbil data dari form edit
        $produk=Produk::findOrFail($id);
        $produk->nama= $request->nama;
        $produk->harga= $request->harga;
        $produk->stok= $request->stok;
        $produk->kategori_id= $request->kategori_id;
        $produk->save();
        //kembali ke halaman kategori
       return redirect('/admin/produk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        //
    }
}
