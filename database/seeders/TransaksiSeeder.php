<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $transaksis = [
            [
                'kode_transaksi' => 'TRX20240115001',
                'tanggal' => '2024-01-15',
                'kasir' => 'Admin',
                'nama_member' => 'Budi Santoso',
                'total_bayar' => 150000,
                'diskon' => 15000,
                'total_akhir' => 135000,
                'tunai' => 150000,
                'kembalian' => 15000,
                'status' => 'Selesai'
            ],
            [
                'kode_transaksi' => 'TRX20240120001',
                'tanggal' => '2024-01-20',
                'kasir' => 'Admin',
                'nama_member' => null,
                'total_bayar' => 75000,
                'diskon' => 0,
                'total_akhir' => 75000,
                'tunai' => 80000,
                'kembalian' => 5000,
                'status' => 'Selesai'
            ]
        ];

        foreach ($transaksis as $transaksi) {
            Transaksi::create($transaksi);
        }
    }
}
