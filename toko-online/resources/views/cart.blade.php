@extends('layout')

@section('content')

<h2>Keranjang Belanja</h2>

@if($errors->any())
    <p style="color:red;">
        {{ $errors->first() }}
    </p>
@endif

@if($items->isEmpty())

    <p>Keranjang kamu masih kosong.</p>
    <a href="{{ route('products.index') }}">Lihat Produk</a>

@else

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>

        @foreach($items as $item)
            <tr>
                <td>{{ $item->nama_barang }}</td>

                <td>
                    Rp{{ number_format($item->harga, 0, ',', '.') }}
                </td>

                <td>
                    <form
                        action="{{ route('cart.update', $item->id_barang) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PUT')

                        <input
                            type="number"
                            name="jumlah"
                            value="{{ $item->jumlah }}"
                            min="1"
                            max="{{ $item->stok }}"
                            required
                        >

                        <button type="submit">Update</button>
                    </form>
                </td>

                <td>
                    Rp{{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}
                </td>

                <td>
                    <form
                        action="{{ route('cart.destroy', $item->id_barang) }}"
                        method="POST"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <h3>
        Total: Rp{{ number_format($total, 0, ',', '.') }}
    </h3>

    <a href="{{ route('products.index') }}">Lanjut Belanja</a>

    <br><br>

    <a href="{{ route('checkout.index') }}">Checkout</a>

@endif

@endsection