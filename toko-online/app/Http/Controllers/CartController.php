<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $items = DB::table('cart_items')
            ->join('products', 'cart_items.id_barang', '=', 'products.id_barang')
            ->where('cart_items.id_user', auth()->user()->id_user)
            ->select(
                'cart_items.id_barang',
                'cart_items.jumlah',
                'products.nama_barang',
                'products.harga',
                'products.stok',
                'products.gambar'
            )
            ->get();

        $total = $items->sum(function ($item) {
            return $item->harga * $item->jumlah;
        });

        return view('cart', compact('items', 'total'));
    }

    public function store(Request $request, string $id_barang)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $product = DB::table('products')
            ->where('id_barang', $id_barang)
            ->first();

        if (!$product) {
            abort(404);
        }

        if ($product->stok < 1) {
            return back()->withErrors([
                'jumlah' => 'Produk sedang habis.',
            ]);
        }

        $idUser = auth()->user()->id_user;

        $cartItem = DB::table('cart_items')
            ->where('id_user', $idUser)
            ->where('id_barang', $id_barang)
            ->first();

        $jumlahBaru = ($cartItem->jumlah ?? 0) + (int) $request->jumlah;

        if ($jumlahBaru > $product->stok) {
            return back()->withErrors([
                'jumlah' => 'Jumlah pembelian melebihi stok yang tersedia.',
            ]);
        }

        DB::table('cart_items')->updateOrInsert(
            [
                'id_user' => $idUser,
                'id_barang' => $id_barang,
            ],
            [
                'jumlah' => $jumlahBaru,
            ]
        );

        return redirect()->route('cart.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, string $id_barang)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $idUser = auth()->user()->id_user;

        $product = DB::table('products')
            ->where('id_barang', $id_barang)
            ->first();

        if (!$product) {
            abort(404);
        }

        if ((int) $request->jumlah > $product->stok) {
            return back()->withErrors([
                'jumlah' => 'Jumlah pembelian melebihi stok yang tersedia.',
            ]);
        }

        DB::table('cart_items')
            ->where('id_user', $idUser)
            ->where('id_barang', $id_barang)
            ->update([
                'jumlah' => (int) $request->jumlah,
            ]);

        return redirect()->route('cart.index')
            ->with('success', 'Jumlah barang berhasil diperbarui.');
    }

    public function destroy(string $id_barang)
    {
        DB::table('cart_items')
            ->where('id_user', auth()->user()->id_user)
            ->where('id_barang', $id_barang)
            ->delete();

        return redirect()->route('cart.index')
            ->with('success', 'Barang berhasil dihapus dari keranjang.');
    }
}