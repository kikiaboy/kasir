    @extends('layouts.mainLayout')

    @section('tittle','Admin-Produk')

     @section('content')

    <h1>Ini halaman Produk</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahproduk">
  Tambah produk
</button>
@include('admin.modal.produk_add')


{{-- menampilkan data dari table kategori --}}
<table class="table table-bordered table-hover mt-3"  >
    <thead>
    <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Kategori</th>
        <th class="text-center">Aksi</th>
    </tr>
</thead>
<tbody>
    @foreach ($produk as $data)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$data->nama}}</td>
        <td>{{$data->harga}}</td>
        <td>{{$data->stok}}</td>
        <td>{{$data->showkategori->nama_kategori ?? '-'}}</td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#ubahproduk{{$data->id}}">Ubah</button>
             <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusproduk{{$data->id}}">Hapus</button>
        </td>
    </tr>
    @include('admin.modal.produk_edit')
    @include('admin.modal.produk_delete')
    @endforeach
</tbody>
</table>



     @endsection

