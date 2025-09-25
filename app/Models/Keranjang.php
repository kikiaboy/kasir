<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $table = 'keranjang';

    // kolom yang akan diisi dari form input
    protected $fillable=[
        'produk_id',
        'nama_produk',
        'harga',
        'qty',
        'subtotal',

    ];
}
