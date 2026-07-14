<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::first();
        
        if ($company) {
            Branch::create([
                'name' => 'Cabang Utama',
                'code' => 'CBG1',
                'is_active' => true,
                'company_id' => $company->id,
            ]);
        }
    }
}
