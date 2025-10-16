<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;

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
        $data['total']=$data['keranjang']->sum('subtotal');
        $data['kodeTransaksi']=$this->kodeOtomatis();
        $data['jumlahItem']=Keranjang::count();
        return view('admin.transaksi',$data);
    }

    // public function kodeOtomatis(){
    //     $query = Transaksi::selectraw('MAX(RIGHT(kode_transaksi,3))AS max_number');
    //     $kode="001";
    //     if ($query->count()> 0) {
    //         $data = $query->first();
    //         $number=((int)$data->max_number)+1;//5+1=6
    //         $kode = sprintf("%03s",$number);//006
    //     }
    //     return'TRS'.$kode;
    // }

    public function kodeOtomatis()
    {
        $tanggal=date('Ymd');

        //Ambil semua transaksi hari ini
        $dataHariIni= Transaksi::whereDate('tanggal_transaksi',today())->get();
        $maxNumber=0;

        foreach($dataHariIni as $item){
            //Ambil angka setelah TRS,sebelum tanda-
            if (preg_match('/TRS(\d+)-/', $item->kode_transaksi,$matches)){
                $angka =(int)$matches[1];
                if($angka>$maxNumber){
                    $maxNumber=$angka;
                }
            }
        }
        $kode = sprintf('%03d',$maxNumber+1);

        return 'TRS' . $kode .'-'.$tanggal;
    }

    public function updateQty(Request $request,$id){
        //validasi input untuk memastikan qty adalah integer minimal 1
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);
        //Cari item keranjang berdasarkan id
        $keranjang=Keranjang::findOrFail($id);
        //Upadate qty dan subtootal
        $keranjang ->qty=$request->input('qty');
        $keranjang->subtotal=$keranjang->qty*$keranjang->harga;
        //Simpan perubahan
        $keranjang->save();
        //Redirect kembali ke halaman tranbsaksi
        return redirect('/admin/transaksi');
    }

    public function simpanTransaksi(){
        $kode_transaksi =$this->kodeOtomatis();
        $tanggal_transaksi=Carbon::now()->format('Y-m-d');
        $keranjang= Keranjang::all();
        $total= $keranjang->sum('subtotal');

        //insert data transaksi ke database
        $transaki = new Transaksi();
        $transaki->kode_transaksi=$kode_transaksi;
        $transaki->tanggal_transaksi=$tanggal_transaksi;
        $transaki->total=$total;
        $transaki->save();

        foreach($keranjang as $cart){
            $detailTransaksi= new TransaksiDetail();
            $detailTransaksi->transaksi_id=$kode_transaksi;
            $detailTransaksi->produk_id=$cart->produk_id;
            $detailTransaksi->qty=$cart->qty;
            $detailTransaksi->harga=$cart->harga;
            $detailTransaksi->subtotal=$cart->subtotal;
            $detailTransaksi->save();

        }
        Keranjang::truncate();

        //kirim respon JSON ke frontend
        return response()->json([
            'status'=> 'success',
            'kode_transaksi'=>$kode_transaksi
        ]);

    }

    public function cetak($kode_transaksi,Request $request){
        $transaksi= Transaksi::where('kode_transaksi',$kode_transaksi)->firstOrFail();
        $detail =TransaksiDetail::with('produk')->where('transaksi_id',$kode_transaksi)->get();

        //Ambil tunai dan kembali dari query string (tidak dari database )
        $tunai = $request->query('tunai',0);
        $kembali = $request->query('kembali',0);

        $pdf=PDF::loadView('admin.struk',compact('transaksi','detail','tunai','kembali'))->setPaper([0,0,250,600],'portrait');

        return $pdf->stream('struk.pdf');

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
