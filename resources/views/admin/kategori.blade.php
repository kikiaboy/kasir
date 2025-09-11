    @extends('layouts.mainLayout')

    @section('tittle','Admin-Kategori')

     @section('content')

    <h1>Ini halaman kategori</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahkategori">
  Tambah Kategori
</button>
@include('admin.modal.kategori_add')


     @endsection

