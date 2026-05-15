<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            ['nama' => 'PT. Fashion Indonesia', 'alamat' => 'Jl. Sudirman No. 123, Jakarta', 'telepon' => '021-12345678'],
            ['nama' => 'CV. Gaya Busana', 'alamat' => 'Jl. Gatot Subroto No. 45, Bandung', 'telepon' => '022-87654321'],
            ['nama' => 'UD. Trendi Textile', 'alamat' => 'Jl. Ahmad Yani No. 78, Surabaya', 'telepon' => '031-11223344'],
            ['nama' => 'PT. Mode Modern', 'alamat' => 'Jl. Pemuda No. 56, Semarang', 'telepon' => '024-55667788']
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
