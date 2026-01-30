<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExternalUser;
use Illuminate\Support\Facades\Hash;

class ExternalUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExternalUser::create([
            'name' => 'User OPD Test',
            'email' => 'user@opd.go.id',
            'password' => Hash::make('password'),
            'phone' => '081234567890',
            'organization' => 'Dinas Kesehatan Batang Hari',
            'is_verified' => true,
            'is_active' => true,
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        ExternalUser::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@opd.go.id',
            'password' => Hash::make('password'),
            'phone' => '081298765432',
            'organization' => 'Dinas Pendidikan Batang Hari',
            'is_verified' => true,
            'is_active' => true,
            'status' => 'approved',
            'approved_at' => now(),
        ]);
    }
}
