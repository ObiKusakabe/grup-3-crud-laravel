<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailTransaksi;

class DetailTransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $details = [
            [
                'kode_transaksi' => 'TRX20240115001',
                'nama_barang' => 'Kaos Polos Hitam',
                'ukuran' => 'L',
                'warna' => 'Hitam',
                'jumlah' => 2,
                'harga_satuan' => 75000,
                'subtotal' => 150000,
                'jenis' => 'jual'
            ],
            [
                'kode_transaksi' => 'TRX20240120001',
                'nama_barang' => 'Kaos Polos Hitam',
                'ukuran' => 'L',
                'warna' => 'Hitam',
                'jumlah' => 1,
                'harga_satuan' => 75000,
                'subtotal' => 75000,
                'jenis' => 'jual'
            ]
        ];

        foreach ($details as $detail) {
            DetailTransaksi::create($detail);
        }
    }
}
