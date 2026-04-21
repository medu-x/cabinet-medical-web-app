<?php

namespace Database\Seeders;

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
        $this->call([
            SpecialitesTableSeeder::class,
            DoctorUsersSeeder::class,
            MedecinsTableSeeder::class,
            PatientUsersSeeder::class,
            PatientsTableSeeder::class,
            RendezVousTableSeeder::class,
            TodayRendezVousSeeder::class,
            AvisTableSeeder::class,
            AdminUserSeeder::class,
            SecretarySeeder::class,
        ]);
    }
}
