<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['nama' => 'Budi Santoso', 'telepon' => '081234567890', 'diskon_persen' => 10],
            ['nama' => 'Siti Aminah', 'telepon' => '081234567891', 'diskon_persen' => 15],
            ['nama' => 'Ahmad Wijaya', 'telepon' => '081234567892', 'diskon_persen' => 5],
            ['nama' => 'Dewi Lestari', 'telepon' => '081234567893', 'diskon_persen' => 20],
            ['nama' => 'Rudi Hartono', 'telepon' => '081234567894', 'diskon_persen' => 10]
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
