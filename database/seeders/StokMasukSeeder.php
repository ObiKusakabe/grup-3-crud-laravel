<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StokMasuk;

class StokMasukSeeder extends Seeder
{
    public function run(): void
    {
        $stokMasuks = [
            [
                'nama_barang' => 'Kaos Polos Hitam',
                'nama_supplier' => 'PT. Fashion Indonesia',
                'jumlah' => 50,
                'harga_beli' => 50000,
                'tanggal_masuk' => '2024-01-15',
                'keterangan' => 'Stok awal'
            ],
            [
                'nama_barang' => 'Kemeja Putih',
                'nama_supplier' => 'CV. Gaya Busana',
                'jumlah' => 30,
                'harga_beli' => 80000,
                'tanggal_masuk' => '2024-01-20',
                'keterangan' => 'Stok awal'
            ],
            [
                'nama_barang' => 'Celana Jeans Biru',
                'nama_supplier' => 'UD. Trendi Textile',
                'jumlah' => 25,
                'harga_beli' => 100000,
                'tanggal_masuk' => '2024-02-01',
                'keterangan' => 'Stok awal'
            ]
        ];

        foreach ($stokMasuks as $stokMasuk) {
            StokMasuk::create($stokMasuk);
        }
    }
}
