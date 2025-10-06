<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //memanggil data produk
        $data['produk']=Produk::all();
        //memanggil data keranjang
        $data['keranjang']=Keranjang::all();
        $data['kodeTransaksi']=$this->kodeOtomatis();
        return view('admin.transaksi',$data);
    }

    public function kodeOtomatis(){
        $query = Transaksi::selectraw('MAX(RIGHT(kode_transaksi,3))AS max_number');
        $kode="001";
        if ($query->count()> 0) {
            $data = $query->first();
            $number=((int)$data->max_number)+1;//5+1=6
            $kode = sprintf("%03s",$number);//006
        }
        return'TRS'.$kode;
    }

    public function add_cart($id){
        $produk = Produk::findOrFail($id);
        //cek apakah kode_barang sudah ada di tabel keranjang
        $keranjang = Keranjang::where('produk_id',$produk->id)->first();
        //jika keranjang==true atau tidak NULL/produk ada
        if($keranjang){
            //jika produk sudah ada di keranjang, update qty dan subtotal
            $keranjang->qty +=1;//menambah qty
            $keranjang->subtotal = $keranjang->qty * $keranjang->harga;

        }else {
            //jika produk belum ada di keranjang,buat daata keranjang baru
            $keranjang =new Keranjang;
            $keranjang->produk_id=$produk->id;
            $keranjang->nama_produk=$produk->nama;
            $keranjang->harga=$produk->harga;
            $keranjang->qty=1;
            $keranjang->subtotal=$keranjang->qty * $keranjang->harga;
        }
        //simpan data ke tabel keranjang
        $keranjang->save();
        //kembalin ke keranjang,sesuaikan urlnya sesuia yang ada di web.php
        return redirect('/admin/transaksi');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //temukan item di keranjang berdasarkan id
        $keranjang= Keranjang::findOrFail($id);
        //Hapus item dari keranjang
        $keranjang->delete();
        //kembali ke transaksi
        return redirect('/admin/transaksi');
    }
}
