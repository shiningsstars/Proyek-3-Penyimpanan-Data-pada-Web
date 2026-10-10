<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
</head>
<body>
    <h1>Riwayat Pesanan</h1>

    <a href="{{ route('products.index') }}">Kembali ke Beranda</a>

    @if ($orders->isEmpty())
        <p>Belum ada pesanan.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Tanggal</th>
                    <th>Total Harga</th>
                    <th>Alamat Pengiriman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id_order }}</td>
                        <td>{{ $order->tanggal_order }}</td>
                        <td>Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $order->alamat_pengiriman }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id_order) }}">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>