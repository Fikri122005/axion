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
<<<<<<< HEAD
=======

        User::firstOrCreate(
            ['email' => 'user@axionvet.test'],
            [
                'name' => 'Pengguna',
                'password' => Hash::make('password'),
                'role' => 'user',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354
    }
}
