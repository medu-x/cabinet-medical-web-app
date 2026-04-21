<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Doctor 1
        $user1 = DB::table('users')->insertGetId([
            'name'       => 'Mohamed Ouhammou',
            'email'      => 'claire.vallet@example.com',
            'password'   => Hash::make('password'),
            'role'       => 'doctor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('medecins')->insert([
            'user_id'      => $user1,
            'specialite_id' => 1, // Ajuste selon ta table specialites
            'experience'   => 8,
            'bio'          => 'Médecin spécialiste avec 8 ans d\'expérience.',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // Doctor 2
        $user2 = DB::table('users')->insertGetId([
            'name'       => 'Marc Antoine',
            'email'      => 'marc.antoine@example.com',
            'password'   => Hash::make('password'),
            'role'       => 'doctor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('medecins')->insert([
            'user_id'      => $user2,
            'specialite_id' => 2, // Ajuste selon ta table specialites
            'experience'   => 5,
            'bio'          => 'Médecin généraliste avec 5 ans d\'expérience.',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }
}
