<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            //menambahkan kategori_id ken table produk
            $table->unsignedBigInteger('kategori_id')->after('stok')->nullable();
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            //menghapus foreign key
            //1.menghapus foreign key
            $table->dropForeign(['kategori_id']);
            //2.Baru menghapus kolom
            $table->dropColumn('kategori_id');
        });
    }
};
