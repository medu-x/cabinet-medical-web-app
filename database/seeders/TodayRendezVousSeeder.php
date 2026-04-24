<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodayRendezVousSeeder extends Seeder
{
    public function run(): void
    {
        $today = now()->toDateString();

        $medecinId = DB::table('medecins')
            ->where('user_id', DB::table('users')->where('email', 'claire.vallet@example.com')->value('id'))
            ->value('id');

        $patient1 = DB::table('patients')
            ->where('user_id', DB::table('users')->where('email', 'MOHAMED@CABINET.COM')->value('id'))
            ->value('id');

        $patient2 = DB::table('patients')
            ->where('user_id', DB::table('users')->where('email', 'sara.benali@example.com')->value('id'))
            ->value('id');

        DB::table('rendez_vous')->insert([
            [
                'patient_id'        => $patient1,
                'medecin_id'        => $medecinId,
                'date_rendez_vous'  => $today,
                'heure_rendez_vous' => '09:00:00',
                'statut'            => 'confirmé',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'patient_id'        => $patient2,
                'medecin_id'        => $medecinId,
                'date_rendez_vous'  => $today,
                'heure_rendez_vous' => '09:30:00',
                'statut'            => 'confirmé',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'patient_id'        => $patient1,
                'medecin_id'        => $medecinId,
                'date_rendez_vous'  => $today,
                'heure_rendez_vous' => '10:00:00',
                'statut'            => 'en_attente',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'patient_id'        => $patient2,
                'medecin_id'        => $medecinId,
                'date_rendez_vous'  => $today,
                'heure_rendez_vous' => '10:30:00',
                'statut'            => 'confirmé',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
