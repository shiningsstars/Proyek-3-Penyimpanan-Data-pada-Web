<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'id_barang' => 'BRG0000001',
                'nama_barang' => 'Kaos Basic',
                'deskripsi' => 'Kaos basic untuk penggunaan sehari-hari.',
                'harga' => 75000,
                'stok' => 20,
                'gambar' => 'kaos.png',
            ],
            [
                'id_barang' => 'BRG0000002',
                'nama_barang' => 'Hoodie Polos',
                'deskripsi' => 'Hoodie polos dengan bahan nyaman.',
                'harga' => 150000,
                'stok' => 15,
                'gambar' => 'hoodie.png',
            ],
            [
                'id_barang' => 'BRG0000003',
                'nama_barang' => 'Totebag Kanvas',
                'deskripsi' => 'Totebag kanvas untuk membawa barang.',
                'harga' => 45000,
                'stok' => 25,
                'gambar' => 'totebag.png',
            ],
            [
                'id_barang' => 'BRG0000004',
                'nama_barang' => 'Botol Minum',
                'deskripsi' => 'Botol minum praktis untuk aktivitas harian.',
                'harga' => 35000,
                'stok' => 18,
                'gambar' => 'botol.png',
            ],
            [
                'id_barang' => 'BRG0000005',
                'nama_barang' => 'Notebook',
                'deskripsi' => 'Buku catatan untuk kuliah dan pekerjaan.',
                'harga' => 20000,
                'stok' => 30,
                'gambar' => 'notebook.png',
            ],
            [
                'id_barang' => 'BRG0000006',
                'nama_barang' => 'Pulpen Gel',
                'deskripsi' => 'Pulpen gel untuk menulis dengan nyaman.',
                'harga' => 8000,
                'stok' => 50,
                'gambar' => 'pulpen.png',
            ],
            [
                'id_barang' => 'BRG0000007',
                'nama_barang' => 'Topi Casual',
                'deskripsi' => 'Topi casual untuk penggunaan sehari-hari.',
                'harga' => 40000,
                'stok' => 12,
                'gambar' => 'topi.png',
            ],
            [
                'id_barang' => 'BRG0000008',
                'nama_barang' => 'Tas Selempang',
                'deskripsi' => 'Tas selempang praktis untuk bepergian.',
                'harga' => 95000,
                'stok' => 10,
                'gambar' => 'tas.png',
            ],
            [
                'id_barang' => 'BRG0000009',
                'nama_barang' => 'Mug Keramik',
                'deskripsi' => 'Mug keramik untuk minuman favorit.',
                'harga' => 30000,
                'stok' => 16,
                'gambar' => 'mug.png',
            ],
            [
                'id_barang' => 'BRG0000010',
                'nama_barang' => 'Pouch Serbaguna',
                'deskripsi' => 'Pouch untuk menyimpan aksesori kecil.',
                'harga' => 25000,
                'stok' => 22,
                'gambar' => 'pouch.png',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['id_barang' => $product['id_barang']],
                $product
            );
        }
    }
}