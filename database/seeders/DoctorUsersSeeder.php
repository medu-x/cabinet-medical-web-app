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
            'user_id'       => $user1,
            'cin'           => 'MED10001',
            'specialite_id' => 1,
            'experience'    => 8,
            'bio'           => 'Médecin spécialiste avec 8 ans d\'expérience.',
            'created_at'    => now(),
            'updated_at'    => now(),
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
            'user_id'       => $user2,
            'cin'           => 'MED10002',
            'specialite_id' => 2,
            'experience'    => 5,
            'bio'           => 'Médecin généraliste avec 5 ans d\'expérience.',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // Doctor 3 — Médecine Générale
        $user3 = DB::table('users')->insertGetId([
            'name'              => 'Omar El Fassi',
            'email'             => 'omar.elfassi@cabinet.ma',
            'password'          => Hash::make('password'),
            'role'              => 'doctor',
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        DB::table('medecins')->insert([
            'user_id'       => $user3,
            'cin'           => 'MED10003',
            'specialite_id' => 4,
            'experience'    => 10,
            'bio'           => 'Médecin généraliste avec 10 ans d\'expérience en médecine de famille.',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // Doctor 4 — Pédiatrie
        $user4 = DB::table('users')->insertGetId([
            'name'              => 'Ahmed Rhazoui',
            'email'             => 'ahmed.rhazoui@cabinet.ma',
            'password'          => Hash::make('password'),
            'role'              => 'doctor',
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        DB::table('medecins')->insert([
            'user_id'       => $user4,
            'cin'           => 'MED10004',
            'specialite_id' => 5,
            'experience'    => 14,
            'bio'           => 'Pédiatre passionné spécialisé en néonatologie et suivi de croissance.',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // Doctor 5 — Gynécologie-Obstétrique
        $user5 = DB::table('users')->insertGetId([
            'name'              => 'Meryem Tazi',
            'email'             => 'meryem.tazi@cabinet.ma',
            'password'          => Hash::make('password'),
            'role'              => 'doctor',
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        DB::table('medecins')->insert([
            'user_id'       => $user5,
            'cin'           => 'MED10005',
            'specialite_id' => 6,
            'experience'    => 16,
            'bio'           => 'Gynécologue-obstétricienne avec 16 ans d\'expérience en suivi de grossesse et chirurgie.',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
    }
}
