<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warna;

class WarnaSeeder extends Seeder
{
    public function run(): void
    {
        $warnas = [
            ['nama' => 'Hitam', 'kode_hex' => '#000000'],
            ['nama' => 'Putih', 'kode_hex' => '#FFFFFF'],
            ['nama' => 'Merah', 'kode_hex' => '#FF0000'],
            ['nama' => 'Biru', 'kode_hex' => '#0000FF'],
            ['nama' => 'Hijau', 'kode_hex' => '#008000'],
            ['nama' => 'Kuning', 'kode_hex' => '#FFFF00'],
            ['nama' => 'Pink', 'kode_hex' => '#FFC0CB'],
            ['nama' => 'Ungu', 'kode_hex' => '#800080'],
            ['nama' => 'Coklat', 'kode_hex' => '#964B00'],
            ['nama' => 'Abu-abu', 'kode_hex' => '#808080']
        ];

        foreach ($warnas as $warna) {
            Warna::create($warna);
        }
    }
}
