<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RendezVousTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rendez_vous')->insert([
            [
                'patient_id' => 1,
                'medecin_id' => 1,
                'date_rendez_vous' => '2026-04-08',
                'heure_rendez_vous' => '10:00:00',
                'statut' => 'termine',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 2,
                'medecin_id' => 2,
                'date_rendez_vous' => '2026-04-09',
                'heure_rendez_vous' => '14:30:00',
                'statut' => 'termine',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
