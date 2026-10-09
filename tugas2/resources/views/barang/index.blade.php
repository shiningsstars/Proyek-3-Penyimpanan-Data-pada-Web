<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Alat Tulis</title>
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Toko Alat Tulis</h1>
        <a href="/keranjang">[ Keranjang ({{ $jumlahKeranjang }}) ]</a>
    </div>

    <h2>Daftar barang</h2>

    @foreach ($barangs as $barang)
        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 10px;">
            <img
                src="{{ asset('images/' . strtolower(str_replace(' ', '-', $barang->nama)) . '.jpg') }}"
                alt="{{ $barang->nama }}"
                width="60"
                height="60"
            >
            <span>{{ $barang->nama }}</span>
            <span>Rp {{ number_format($barang->harga, 0, ',', '.') }}</span>

            <form action="/keranjang/tambah/{{ $barang->id }}" method="POST">
                @csrf
                <button type="submit">Masukkan ke keranjang</button>
            </form>
        </div>
    @endforeach
</body>
</html>