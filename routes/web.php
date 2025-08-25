<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;

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

// Route::post('/logout', function () {
//     Auth::logout();
//     return redirect('/login');
// })->name('logout');
