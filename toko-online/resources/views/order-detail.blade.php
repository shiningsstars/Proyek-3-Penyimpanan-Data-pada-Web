<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
</head>
<body>
    <h1>Detail Pesanan</h1>

    <p>
        <a href="{{ route('orders.index') }}">Kembali ke Riwayat Pesanan</a>
    </p>

    <h3>Informasi Pesanan</h3>

    <p>ID Pesanan: {{ $order->id_order }}</p>
    <p>Tanggal: {{ $order->tanggal_order }}</p>
    <p>Alamat Pengiriman: {{ $order->alamat_pengiriman }}</p>

    <h3>Barang yang Dibeli</h3>

    @if ($details->isEmpty())
        <p>Belum ada detail barang untuk pesanan ini.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $item)
                    <tr>
                        <td>
                            @if ($item->gambar)
                                <img
                                    src="{{ asset('images/' . $item->gambar) }}"
                                    alt="{{ $item->nama_barang }}"
                                    width="80"
                                >
                            @else
                                Tidak ada gambar
                            @endif
                        </td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>
                            Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}
                        </td>
                        <td>{{ $item->jumlah_beli }}</td>
                        <td>
                            Rp{{ number_format(
                                $item->harga_satuan * $item->jumlah_beli,
                                0,
                                ',',
                                '.'
                            ) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h3>
        Total Pembayaran:
        Rp{{ number_format($order->total_harga, 0, ',', '.') }}
    </h3>
</body>
</html>