<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@axionvet.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'pakar@axionvet.test'],
            [
                'name' => 'Dokter Hewan',
                'password' => Hash::make('password'),
                'role' => 'pakar',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
