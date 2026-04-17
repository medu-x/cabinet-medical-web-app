<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorUsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Mohamed Ouhammou',
                'email' => 'claire.vallet@example.com',
                'password' => Hash::make('password'),
                'role' => 'doctor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Marc Antoine',
                'email' => 'marc.antoine@example.com',
                'password' => Hash::make('password'),
                'role' => 'doctor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
