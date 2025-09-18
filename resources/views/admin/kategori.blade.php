    @extends('layouts.mainLayout')

    @section('tittle','Admin-Kategori')

     @section('content')

    <h1>Ini halaman kategori</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahkategori">
  Tambah Kategori
</button>
@include('admin.modal.kategori_add')


{{-- menampilkan data dari table kategori --}}
<table class="table table-bordered table-hover mt-3"  >
    <thead>
    <tr>
        <th>No</th>
        <th>Nama Kategori</th>
        <th>Deskripsi</th>
        <th class="text-center">Aksi</th>
    </tr>
</thead>
<tbody>
    @foreach ($kategori as $data)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$data->nama_kategori}}</td>
        <td>{{$data->deskripsi}}</td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#ubahkategori{{$data->id}}">Ubah</button>
             <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapuskategori{{$data->id}}">Hapus</button>
        </td>
    </tr>
    @include('admin.modal.kategori_edit')
    @include('admin.modal.kategori_delete')
    @endforeach
</tbody>
</table>



     @endsection

