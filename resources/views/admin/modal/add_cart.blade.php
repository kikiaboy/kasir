<!-- Modal -->
<div class="modal fade" id="addCart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        {{-- <form method="post" action="/tambah_kategori"> --}}
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Produk</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <table class="table mt-3">
        <thead>
            <tr>
                <td>No</td>
                <td>Nama Produk</td>
                <td>Stok</td>
                <td>Harga</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $list)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$list->nama}}</td>
                <td>{{$list->stok}}</td>
                <td>{{$list->harga}}</td>
                <td>
                    <form action="/add_to_cart/{{$list->id}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Pilih</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>

       </table>
      </div>
      {{-- </form> --}}
    </div>
  </div>
</div>
