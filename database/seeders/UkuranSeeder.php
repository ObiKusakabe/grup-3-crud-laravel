<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ukuran;

class UkuranSeeder extends Seeder
{
    public function run(): void
    {
        $ukurans = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];

        foreach ($ukurans as $ukuran) {
            Ukuran::create(['nama' => $ukuran]);
        }
    }
}
