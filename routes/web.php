<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', function(){
    return 'Selamat Datang di 12 RPL B';
});

//menampilkan halaman biodata dari biodata.blade.php
Route::get('/biodata', function(){
    return view('biodata',[
        'nama'=>'Kiki',
        'alamat'=>'Bandung',
        'hobi'=>'Game',

    ]);
});

Route::get('/penjumlahan', function(){
    return 4*4;
});

//menampilkan tampilan login
Route::get('/login',[LoginController::class,'index']);
//untuk cek login
Route::post('/login',[LoginController::class,'cek_login']);
Route::get('/admin/home',[AdminController::class,'index']);
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('main');
    })->name('main');
});
//logout
Route::get('/logout', [LoginController::class,'logout'])->name ('logout');

//Memanggil halaman admin - kategori
Route::get('/admin/kategori',[KategoriController::class,'index']);
// Route::post('/logout', function () {
//     Auth::logout();
//     return redirect('/login');
// })->name('logout');
//menyimpan data kategori
Route::post('/tambah_kategori',[KategoriController::class,'store']);

//update data kategori
Route::put('/ubah_kategori/{id}',[KategoriController::class,'update'])->name('ubah_kategori');

// hapus data kategori
Route::delete('/hapus_kategori/{id}',[KategoriController::class,'destroy'])->name('hapus_kategori');


Route::get('/admin/produk',[ProdukController::class,'index']);
// Route::post('/logout', function () {
//     Auth::logout();
//     return redirect('/login');
// })->name('logout');
//menyimpan data kategori
Route::post('/tambah_produk',[ProdukController::class,'store']);

//update data kategori
Route::put('/ubah_produk/{id}',[ProdukController::class,'update'])->name('ubah_produk');

// hapus data kategori
Route::delete('/hapus_produk/{id}',[ProdukController::class,'destroy'])->name('hapus_produk');
//memanggil halaman admin - transaksi
Route::get('/admin/transaksi',[TransaksiController::class,'index']);

//menambahkan produk ke keranjang
Route::post('/add_to_cart/{id}',[TransaksiController::class,'add_cart'])->name('add_cart');

// hapus item keranjang
Route::delete('/keranjang/{id}',[TransaksiController::class,'destroy'])->name('keranjang.destroy');
