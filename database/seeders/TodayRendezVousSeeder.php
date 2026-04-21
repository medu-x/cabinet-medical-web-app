<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodayRendezVousSeeder extends Seeder
{
    /**
     * Seeder de test — Crée des RDV confirmés pour aujourd'hui
     * pour tester le dashboard médecin.
     *
     * Médecin 1 (user_id=1): Mohamed Ouhammou
     * Patients: patient_id=1 (user_id=3), patient_id=2 (user_id=4)
     */
    public function run(): void
    {
        $today = now()->toDateString();

        DB::table('rendez_vous')->insert([
            [
                'patient_id'       => 1,
                'medecin_id'       => 1,
                'date_rendez_vous' => $today,
                'heure_rendez_vous'=> '09:00:00',
                'statut'           => 'confirmé',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'patient_id'       => 2,
                'medecin_id'       => 1,
                'date_rendez_vous' => $today,
                'heure_rendez_vous'=> '09:30:00',
                'statut'           => 'confirmé',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'patient_id'       => 1,
                'medecin_id'       => 1,
                'date_rendez_vous' => $today,
                'heure_rendez_vous'=> '10:00:00',
                'statut'           => 'en_attente', // non confirmé — ne doit pas apparaitre
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'patient_id'       => 2,
                'medecin_id'       => 1,
                'date_rendez_vous' => $today,
                'heure_rendez_vous'=> '10:30:00',
                'statut'           => 'confirmé',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);
    }
}
