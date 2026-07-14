<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use App\Models\KategoriBarang;

class KategoriBarangSeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::first();
        if (!$company) return;

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
            KategoriBarang::create(['nama' => $kategori, 'company_id' => $company->id]);
        }
    }
}
