<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    // Mendaftarkan nama table yang ada di database ke model
    protected $table = 'produk';

    // kolom yang akan diisi dari form input
    protected $fillable=[
        'nama',
        'harga',
        'stok',
        'kategori_id',

    ];
}
