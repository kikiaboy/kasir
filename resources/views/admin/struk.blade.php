<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
initial-scale=1.0">
    <title>Struk Transaksi {{ $transaksi->kode_transaksi }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .struk-container {
            width: 250px;
            margin: auto;
            padding: 10px;
        }

        .header {
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 16px;
        }

        .info {
            margin-bottom: 10px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        th,
        td {
            padding: 3px 0;
        }

        th {
            border-bottom: 1px dashed #000;
            text-align: left;
        }

        tfoot td {
            border-top: 1px dashed #000;
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .footer {
            border-top: 1px dashed #000;
            margin-top: 10px;
            padding-top: 5px;
            text-align: center;
            font-size: 11px;
        }
    </style>
</head>

<body>
    <div class="struk-container">
        <div class="header">
            <h2>Toko Anda</h2>
            <small>Jl. Contoh No. 123 - Cimahi</small><br>
            <small>Telp: 0812-3456-7890</small>
        </div>
        <div class="info">
            <div>Kode Transaksi: <strong>{{ $transaksi->kode_transaksi }}</strong></div>
            <div>Tanggal: {{ $transaksi->created_at->format('d/m/Y H:i') }}</div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail as $item)
                    <tr>
                        <td>{{ $item->produk->nama }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td>{{ number_format($transaksi->total, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="3">Tunai</td>
                    <td>{{ number_format($tunai, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="3">Kembali</td>
                    <td>{{ number_format($kembali, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
        <div class="footer">
            <p>Terima kasih sudah berbelanja!</p>
            <p>Barang yang sudah dibeli tidak dapat
                dikembalikan.</p>
        </div>
    </div>
</body>

</html>
