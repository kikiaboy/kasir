@extends('layouts.mainLayout')

@section('title', 'Transaksi')
@section('content')
<style>
    .form-label {
        font-weight: bold;
    }
</style>

<h3>Transaksi Penjualan</h3>
@include('admin.modal.add_cart')
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
        <h4 class="mb-0">: {{$kodeTransaksi}}</h4>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-2">
        <h4 class="mb-0">Tanggal</h4>
    </div>
    <div class="col-md-10">
        <h4 class="mb-0">: {{ now()->format('d-m-Y') }} </h4>
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
        @foreach($keranjang as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->produk_id}}</td>
            <td>{{$data->nama_produk}}</td>
            <td>{{$data->harga}}</td>
            <td>{{$data->qty}}</td>
            <td>{{$data->subtotal}}</td>
            <td>
                <form action="{{route('keranjang.destroy',$data->id)}}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus barang ini dari keranjang?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
