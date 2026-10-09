
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>

    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        form {
            display: inline;
        }

        button {
            cursor: pointer;
        }

        .item {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>Keranjang belanja</h3>
        <span>Tanpa login</span>
    </div>

    @php
        $total = 0;
    @endphp

    @forelse ($keranjang as $id => $item)
        @php
            $subtotal = $item['harga'] * $item['jumlah'];
            $total += $subtotal;
        @endphp

        <div class="item">
            <p>{{ $item['nama'] }}</p>

            <div>
                Rp {{ number_format($item['harga'], 0, ',', '.') }}
                x {{ $item['jumlah'] }}
                = Rp {{ number_format($subtotal, 0, ',', '.') }}
            </div>

            <div>
                <form action="{{ route('keranjang.kurang', $id) }}" method="POST">
                    @csrf
                    <button type="submit">-</button>
                </form>

                {{ $item['jumlah'] }}

                <form action="{{ route('keranjang.tambahJumlah', $id) }}" method="POST">
                    @csrf
                    <button type="submit">+</button>
                </form>

                <form action="{{ route('keranjang.hapus', $id) }}" method="POST">
                    @csrf
                    <button type="submit">hapus</button>
                </form>
            </div>
        </div>
    @empty
        <p>Keranjang masih kosong.</p>
    @endforelse

    <p>
        Total
        <span style="margin-left: 30px;">
            Rp {{ number_format($total, 0, ',', '.') }}
        </span>
    </p>

    <form action="{{ route('keranjang.kosongkan') }}" method="POST">
        @csrf
        <button type="submit">Kosongkan keranjang</button>
    </form>

    <p>
        <a href="{{ route('barang.index') }}">Kembali ke daftar barang</a>
    </p>
</body>
</html>