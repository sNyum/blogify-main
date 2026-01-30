<?php

namespace Database\Seeders;

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
        // Seed Admin users (guard: web)
        $this->call(AdminSeeder::class);
        
        // Seed BPS Staff users (guard: bps, operator role)
        $this->call(BpsStaffSeeder::class);
        
        // Seed External users (guard: external, OPD/Instansi role)
        $this->call(ExternalUserSeeder::class);
    }

}
