@extends('layouts.mainLayout')

@section('title', 'Transaksi')
@section('content')
<style>
    .form-label {
        font-weight: bold;
    }
</style>

<h3>Transaksi Penjualan</h3>
<div class="row mb-3">
    <div class="col-md-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCart">
            Pilih Produk
        </button>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-2">
        <h4 class="mb-0">Kode Transaksi</h4>
    </div>
    <div class="col-md-10">
        <h4 class="mb-0">INI KODE</h4>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-2">
        <h4 class="mb-0">Tanggal</h4>
    </div>
    <div class="col-md-10">
        <h4 class="mb-0"> {{ now()->format('d-m-Y') }} </h4>
    </div>
</div>

<table class="table table-bordered">
    <thead class="thead-light">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@endsection
