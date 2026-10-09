<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
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
                'products.stok'
            )
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')
                ->withErrors(['cart' => 'Keranjang kamu masih kosong.']);
        }

        $total = $items->sum(function ($item) {
            return $item->harga * $item->jumlah;
        });

        return view('checkout', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat_pengiriman' => 'required|string|max:5000',
        ]);

        $idUser = auth()->user()->id_user;

        DB::transaction(function () use ($validated, $idUser) {
            $cartItems = DB::table('cart_items')
                ->where('id_user', $idUser)
                ->lockForUpdate()
                ->get();

            if ($cartItems->isEmpty()) {
                throw ValidationException::withMessages([
                    'cart' => 'Keranjang kamu masih kosong.',
                ]);
            }

            $total = 0;
            $details = [];

            foreach ($cartItems as $cartItem) {
                $product = DB::table('products')
                    ->where('id_barang', $cartItem->id_barang)
                    ->lockForUpdate()
                    ->first();

                if (!$product) {
                    throw ValidationException::withMessages([
                        'cart' => 'Ada produk yang sudah tidak tersedia.',
                    ]);
                }

                if (
                    $cartItem->jumlah < 1 ||
                    $cartItem->jumlah > $product->stok
                ) {
                    throw ValidationException::withMessages([
                        'cart' => 'Stok ' . $product->nama_barang .
                            ' tidak mencukupi. Silakan perbarui keranjang.',
                    ]);
                }

                $subtotal = $product->harga * $cartItem->jumlah;
                $total += $subtotal;

                $details[] = [
                    'id_barang' => $product->id_barang,
                    'harga_satuan' => $product->harga,
                    'jumlah_beli' => $cartItem->jumlah,
                ];
            }

            do {
                $idOrder = 'ORD' . Str::upper(Str::random(12));
            } while (
                DB::table('orders')
                    ->where('id_order', $idOrder)
                    ->exists()
            );

            DB::table('orders')->insert([
                'id_order' => $idOrder,
                'id_user' => $idUser,
                'tanggal_order' => now(),
                'total_harga' => $total,
                'alamat_pengiriman' => $validated['alamat_pengiriman'],
            ]);

            foreach ($details as $detail) {
                DB::table('order_details')->insert([
                    'id_order' => $idOrder,
                    'id_barang' => $detail['id_barang'],
                    'harga_satuan' => $detail['harga_satuan'],
                    'jumlah_beli' => $detail['jumlah_beli'],
                ]);

                DB::table('products')
                    ->where('id_barang', $detail['id_barang'])
                    ->decrement('stok', $detail['jumlah_beli']);
            }

            DB::table('cart_items')
                ->where('id_user', $idUser)
                ->delete();
        });

        return redirect()->route('products.index')
            ->with('success', 'Checkout berhasil! Pesanan kamu sudah disimpan.');
    }
}