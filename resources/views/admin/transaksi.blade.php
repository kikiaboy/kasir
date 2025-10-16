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
            <h4 class="mb-0">: {{ $kodeTransaksi }}</h4>
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
            @foreach ($keranjang as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><span class="badge bg-success">{{ $data->produk_id }}</span></td>
                    <td>{{ $data->nama_produk }}</td>
                    <td>{{ $data->harga }}</td>

                    <td>
                        <form action="/keranjang/update/{{ $data->id }}" method="POST">
                            @csrf
                            <input type="number" name="qty" value="{{ $data->qty }}" class="form-control"min="1"
                                onchange="this.form.submit()">
                        </form>
                    </td>
                    <td>{{ $data->subtotal }}</td>
                    <td>
                        <form action="{{ route('keranjang.destroy', $data->id) }}" method="POST"
                            onsubmit="return confirm('Apakah anda yakin ingin menghapus barang ini dari keranjang?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form id="form-transaksi" action="/transaksi/simpan" method="POST">
        @csrf

        <div class="row mt-3">
            <div class="col-md-2">
                <label for="bayar" class="form-label">Total</label>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="bayar"
                    value="Rp. {{ number_format($total, 0, ',', '.') }}" readonly>
                <input type="hidden" name="total" value="{{ $total }}">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-2">
                <label for="diterima" class="form-label">Bayar</label>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="diterima"
                    placeholder="Masukkan jumlah uang yang diterima"required>
                <div id="error-message" class="text-danger mt-2" style="display:none;"></div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-2">
                <label for="kembali" class="form-label">Kembalian</label>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="kembali" value="Rp. 0" readonly>
            </div>
        </div>

        <div class="text-end mt-4">
            <button id="btnSimpan" type="button" class="btn btn-primary" {{ $jumlahItem == 0 ? 'disabled' : '' }}>
                Simpan Transaksi
            </button>
        </div>
    </form>
    @include('admin.modal.transaksi_sukses')

    <script>
        document.getElementById("cariProduk").addEventListener("keyup", function() {
                    const keyword = this.value.toLowerCase();
                    const rows = document.querySelectorAll("#tabelProduk tbody tr");
                    rows.forEach(function(row) {
                            const namaProduk = row.querySelector(".nama-
                                produk ").textContent.toLowerCase();
                                row.style.display = namaProduk.includes(keyword) ? "" : "none";
                            });
                    });
    </script>

    <script>
        function formatCurrency(value) {
            value = value.replace(/\D/g, '');
            return 'Rp. ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function updateKembalian() {
            var bayar = parseFloat(document.getElementById('bayar').value.replace(/Rp\. /g,
                '').replace(/\./g, '').trim());
            var diterima = document.getElementById('diterima').value.replace(/Rp\. /g,
                    '').replace(/\D/g, '')
                .trim();
            var errorMessage = document.getElementById('error-message');
            var kembaliField = document.getElementById('kembali');
            if (diterima === "" || isNaN(diterima)) {
                errorMessage.innerHTML = "Uang tidak boleh kosong";
                errorMessage.style.display = "block";
                kembaliField.value = "Rp. 0";
                return;
            }
            // Hitung kembalian
            var kembali = parseFloat(diterima) - bayar;
            // kembalian negatif
            if (kembali < 0) {
                errorMessage.innerHTML = "Uang tidak boleh kurang dari total bayar";
                errorMessage.style.display = "block";
                kembaliField.value = "Rp. 0";
                return;
            }
            errorMessage.style.display = "none";
            kembaliField.value = "Rp. " + kembali.toLocaleString('id-ID');
        }
        document.getElementById('bayar').addEventListener('input', function() {
            this.value = formatCurrency(this.value);
            updateKembalian();
        });
        document.getElementById('diterima').addEventListener('input', function() {
            var diterima = this.value.replace(/Rp\. /g, '').replace(/\D/g, '').trim();
            this.value = formatCurrency(diterima);
            updateKembalian();
        });
        // Form submit
        document.getElementById('form-transaksi').addEventListener('submit',
            function(event) {
                var bayar = parseFloat(document.getElementById('bayar').value.replace(/Rp\. /g,
                        '').replace(/\./g, '')
                    .trim());
                var diterima = document.getElementById('diterima').value.replace(/Rp\. /g,
                        '').replace(/\D/g, '')
                    .trim();
                var errorMessage = document.getElementById('error-message');
                if (diterima === "" || isNaN(diterima)) {
                    errorMessage.innerHTML = "Uang tidak boleh kosong";
                    errorMessage.style.display = "block";
                    event.preventDefault();
                    return;
                }
                var kembali = parseFloat(diterima) - bayar;
                if (kembali < 0) {
                    errorMessage.innerHTML = "Uang tidak boleh kurang dari total bayar";
                    errorMessage.style.display = "block";
                    event.preventDefault();
                    return;
                }
                errorMessage.style.display = "none";
            });
    </script>

    <script>
document.getElementById('btnSimpan').addEventListener('click', function(e) {
    e.preventDefault();

    const form = document.getElementById('form-transaksi');
    const formData = new FormData(form);

    fetch("{{ route('transaksi.simpan') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            // tampilkan kode transaksi di modal
            document.getElementById('kodeTransaksi').innerHTML =
                'Kode Transaksi: <strong>' + data.kode_transaksi + '</strong>';

            const modal = new bootstrap.Modal(document.getElementById('modalSukses'));
            modal.show();

            // 🖨 tombol CETAK
            document.getElementById('btnCetak').onclick = function() {
                modal.hide();

                // Ambil nilai tunai dan kembalian dari input
                const tunai = document.getElementById('diterima').value
                    .replace(/Rp\. /g, '')
                    .replace(/\./g, '')
                    .trim();

                const kembali = document.getElementById('kembali').value
                    .replace(/Rp\. /g, '')
                    .replace(/\./g, '')
                    .trim();

                // Bangun URL cetak dengan query string
                const urlCetak = "{{ url('transaksi/cetak') }}/" +
                    data.kode_transaksi +
                    "?tunai=" + tunai +
                    "&kembali=" + kembali;

                // Buka jendela baru untuk cetak PDF
                window.open(urlCetak, "_blank");

                // Reload halaman transaksi setelah 1 detik
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }

            // tombol TIDAK CETAK
            document.getElementById('btnTidakCetak').onclick = function() {
                modal.hide();
                window.location.reload();
            }
        }
    })
    .catch(err => console.error(err));
});
</script>


@endsection
