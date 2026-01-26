<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BpsStaff;
use Illuminate\Support\Facades\Hash;

class BpsStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BpsStaff::create([
            'name' => 'Staff BPS Test',
            'email' => 'staff@bps.go.id',
            'password' => Hash::make('password'),
            'nip' => '199001012020011001',
            'position' => 'Statistisi Ahli Muda',
            'division' => 'Bidang Statistik Sosial',
            'is_active' => true,
        ]);

        BpsStaff::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi@bps.go.id',
            'password' => Hash::make('password'),
            'nip' => '198505152010011002',
            'position' => 'Kepala Seksi Statistik Produksi',
            'division' => 'Bidang Statistik Produksi',
            'is_active' => true,
        ]);
    }
}
