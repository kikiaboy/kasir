<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    // kolom yang akan diisi dari form input
    protected $fillable=[
        'kode_transaksi',
        'tanggal_transaksi',
        'total',

    ];
}
