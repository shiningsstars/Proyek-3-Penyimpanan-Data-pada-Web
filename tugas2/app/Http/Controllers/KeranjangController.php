<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\RedirectResponse;

class KeranjangController extends Controller
{
    public function tambah(int $id): RedirectResponse
    {
        $barang = Barang::findOrFail($id);

        $keranjang = session()->get('keranjang', []);

        $jumlah = $keranjang[$id] ?? 0;

        if ($jumlah < $barang->stok) {
            $keranjang[$id] = $jumlah + 1;
        }

        session()->put('keranjang', $keranjang);

        return redirect('/');
    }
}