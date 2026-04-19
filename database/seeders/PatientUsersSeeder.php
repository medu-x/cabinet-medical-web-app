<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientUsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'       => 'Mohamed ouhammou',
                'email'      => 'MOHAMED@CABINET.COM',
                'password'   => Hash::make('password'),
                'role'       => 'patient',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Sara Benali',
                'email'      => 'sara.benali@example.com',
                'password'   => Hash::make('password'),
                'role'       => 'patient',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
