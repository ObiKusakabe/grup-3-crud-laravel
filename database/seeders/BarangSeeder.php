<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\ProductStock;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::first();
        if (!$company) return;

        $kategoriBaju = KategoriBarang::where('nama', 'Baju')->first()->id;
        $kategoriCelana = KategoriBarang::where('nama', 'Celana')->first()->id;
        $kategoriJaket = KategoriBarang::where('nama', 'Jaket')->first()->id;
        $kategoriSepatu = KategoriBarang::where('nama', 'Sepatu')->first()->id;

        $branch = Branch::first();
        $branchId = $branch ? $branch->id : null;

        $barangs = [
            [
                'kode_barang' => 'BRG001',
                'nama' => 'Kaos Polos Hitam',
                'kategori_id' => $kategoriBaju,
                'harga_beli' => 50000,
                'harga_jual' => 75000,
                'stok' => 50,
                'company_id' => $company->id
            ],
            [
                'kode_barang' => 'BRG002',
                'nama' => 'Kemeja Putih',
                'kategori_id' => $kategoriBaju,
                'harga_beli' => 80000,
                'harga_jual' => 120000,
                'stok' => 30,
                'company_id' => $company->id
            ],
            [
                'kode_barang' => 'BRG003',
                'nama' => 'Celana Jeans Biru',
                'kategori_id' => $kategoriCelana,
                'harga_beli' => 100000,
                'harga_jual' => 150000,
                'stok' => 25,
                'company_id' => $company->id
            ],
            [
                'kode_barang' => 'BRG004',
                'nama' => 'Jaket Kulit',
                'kategori_id' => $kategoriJaket,
                'harga_beli' => 250000,
                'harga_jual' => 350000,
                'stok' => 15,
                'company_id' => $company->id
            ],
            [
                'kode_barang' => 'BRG005',
                'nama' => 'Sepatu Sneaker',
                'kategori_id' => $kategoriSepatu,
                'harga_beli' => 150000,
                'harga_jual' => 225000,
                'stok' => 20,
                'company_id' => $company->id
            ]
        ];

        foreach ($barangs as $barang) {
            $stok = $barang['stok'];
            unset($barang['stok']);
            
            $createdBarang = Barang::create($barang);
            
            // Create product stock for default branch
            if ($branchId) {
                ProductStock::create([
                    'product_id' => $createdBarang->id,
                    'branch_id' => $branchId,
                    'stock' => $stok,
                    'min_stock' => 5,
                    'company_id' => $company->id
                ]);
            }
        }
    }
}
