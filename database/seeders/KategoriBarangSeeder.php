<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriBarang;

class KategoriBarangSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            'Baju',
            'Celana',
            'Jaket',
            'Sepatu',
            'Aksesoris',
            'Tas',
            'Topi',
            'Kaos Kaki'
        ];

        foreach ($kategoris as $kategori) {
            KategoriBarang::create(['nama' => $kategori]);
        }
    }
}
