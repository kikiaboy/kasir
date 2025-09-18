<!-- Modal -->
<div class="modal fade" id="tambahproduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form method="post" action="/tambah_produk">
            @csrf
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" name="nama" id="nama">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" name="harga" id="harga">
        </div>
         <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="text" class="form-control" name="stok" id="stok">
        </div>
        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
        <select name="kategori_id" id="kategori_id" class="form form-control">
            <option value="" selected disabled>Pilih kategori.......</option>
            @foreach($kategori as $data)
                <option value="{{ $data->id }}">{{ $data->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
         {{-- <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <input type="text" class="form-control" name="kategori_id" id="kategori_id">
        </div> --}}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
