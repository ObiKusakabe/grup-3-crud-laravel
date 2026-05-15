<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = [
            [
                'kode_barang' => 'BRG001',
                'nama' => 'Kaos Polos Hitam',
                'kategori' => 'Baju',
                'ukuran' => 'L',
                'warna' => 'Hitam',
                'harga_beli' => 50000,
                'harga_jual' => 75000,
                'stok' => 50
            ],
            [
                'kode_barang' => 'BRG002',
                'nama' => 'Kemeja Putih',
                'kategori' => 'Baju',
                'ukuran' => 'M',
                'warna' => 'Putih',
                'harga_beli' => 80000,
                'harga_jual' => 120000,
                'stok' => 30
            ],
            [
                'kode_barang' => 'BRG003',
                'nama' => 'Celana Jeans Biru',
                'kategori' => 'Celana',
                'ukuran' => '32',
                'warna' => 'Biru',
                'harga_beli' => 100000,
                'harga_jual' => 150000,
                'stok' => 25
            ],
            [
                'kode_barang' => 'BRG004',
                'nama' => 'Jaket Kulit',
                'kategori' => 'Jaket',
                'ukuran' => 'L',
                'warna' => 'Coklat',
                'harga_beli' => 250000,
                'harga_jual' => 350000,
                'stok' => 15
            ],
            [
                'kode_barang' => 'BRG005',
                'nama' => 'Sepatu Sneaker',
                'kategori' => 'Sepatu',
                'ukuran' => '42',
                'warna' => 'Hitam',
                'harga_beli' => 150000,
                'harga_jual' => 225000,
                'stok' => 20
            ]
        ];

        foreach ($barangs as $barang) {
            Barang::create($barang);
        }
    }
}
