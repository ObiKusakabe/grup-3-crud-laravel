<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user first
        $adminUser = User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'role' => 'admin',
        ]);

        // Create company for admin
        $company = Company::create([
            'name' => 'PT Test Fashion',
            'email' => 'info@testfashion.com',
            'address' => 'Jl. Fashion No. 123, Jakarta',
            'phone' => '021-123-4567',
            'admin_user_id' => $adminUser->id,
        ]);

        // Update admin user with company_id
        $adminUser->update(['company_id' => $company->id]);

        // Create employee users
        User::create([
            'name' => 'Kasir Test',
            'email' => 'kasir@test.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'pos',
            'company_id' => $company->id,
            'created_by' => $adminUser->id,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Inventaris Test',
            'email' => 'inventaris@test.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'inventaris',
            'company_id' => $company->id,
            'created_by' => $adminUser->id,
            'email_verified_at' => now(),
        ]);

        $this->call([
            BranchSeeder::class,
            KategoriBarangSeeder::class,
            SupplierSeeder::class,
            MemberSeeder::class,
            BarangSeeder::class,
            TransaksiSeeder::class,
            DetailTransaksiSeeder::class,
        ]);
    }
}
