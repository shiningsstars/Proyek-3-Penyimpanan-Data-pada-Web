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
        <a href="{{ route('keranjang.index') }}">
            Keranjang ({{ $jumlahKeranjang }})
        </a>
    </div>

    <h2>Daftar Barang</h2>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @foreach ($barangs as $barang)
        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 15px;">
            <img
                src="{{ asset('images/' . strtolower(str_replace(' ', '-', $barang->nama)) . '.jpg') }}"
                alt="{{ $barang->nama }}"
                width="60"
                height="60"
            >

            <span>{{ $barang->nama }}</span>

            <span>
                Rp {{ number_format($barang->harga, 0, ',', '.') }}
            </span>

            <form action="{{ route('keranjang.tambah', $barang->id) }}" method="POST">
                @csrf
                <button type="submit">Masukkan ke keranjang</button>
            </form>
        </div>
    @endforeach
</body>
</html>