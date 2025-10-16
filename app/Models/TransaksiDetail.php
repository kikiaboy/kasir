<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiDetail extends Model
{
    use HasFactory;
     protected $table = 'transaksi_detail';

    // kolom yang akan diisi dari form input
    protected $fillable=[
        'transaksi_id',
        'produk_id',
        'qty',
        'harga',
        'subtotal',

    ];

    public function produk(){
        return $this->belongsTo(Produk::class,'produk_id','id');
    }
}
