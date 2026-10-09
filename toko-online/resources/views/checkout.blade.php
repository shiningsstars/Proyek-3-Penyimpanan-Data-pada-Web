@extends('layout')

@section('content')

<h2>Checkout</h2>

@if($errors->any())
    <p style="color:red;">
        {{ $errors->first() }}
    </p>
@endif

<h3>Ringkasan Pesanan</h3>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
    </tr>

    @foreach($items as $item)
        <tr>
            <td>{{ $item->nama_barang }}</td>

            <td>
                Rp{{ number_format($item->harga, 0, ',', '.') }}
            </td>

            <td>{{ $item->jumlah }}</td>

            <td>
                Rp{{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}
            </td>
        </tr>
    @endforeach
</table>

<h3>Total Bayar: Rp{{ number_format($total, 0, ',', '.') }}</h3>

<form action="{{ route('checkout.store') }}" method="POST">
    @csrf

    <label for="alamat_pengiriman">Alamat Pengiriman</label>
    <br>

    <textarea
        id="alamat_pengiriman"
        name="alamat_pengiriman"
        rows="4"
        cols="40"
        required
    >{{ old('alamat_pengiriman', auth()->user()->alamat) }}</textarea>

    <br>

    <button type="submit">Konfirmasi Pesanan</button>
</form>

<br>

<a href="{{ route('cart.index') }}">Kembali ke Keranjang</a>

@endsection