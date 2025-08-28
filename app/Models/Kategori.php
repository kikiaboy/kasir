<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Mendaftarkan nama table yang ada di database ke model
    protected $table = 'kategori';

    // kolom yang akan diisi dari form input
    protected $fillable=[
        'nama_kategori',
        'deskripsi',

    ];
}
