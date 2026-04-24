<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RendezVousTableSeeder extends Seeder
{
    public function run(): void
    {
        $medecinId = fn(string $email) => DB::table('medecins')
            ->where('user_id', DB::table('users')->where('email', $email)->value('id'))
            ->value('id');

        $patientId = fn(string $email) => DB::table('patients')
            ->where('user_id', DB::table('users')->where('email', $email)->value('id'))
            ->value('id');

        DB::table('rendez_vous')->insert([
            // Existing (kept as-is for TodayRendezVousSeeder + AvisTableSeeder compatibility)
            [
                'patient_id'        => $patientId('MOHAMED@CABINET.COM'),
                'medecin_id'        => $medecinId('claire.vallet@example.com'),
                'date_rendez_vous'  => '2026-04-08',
                'heure_rendez_vous' => '10:00:00',
                'statut'            => 'terminé',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'patient_id'        => $patientId('sara.benali@example.com'),
                'medecin_id'        => $medecinId('marc.antoine@example.com'),
                'date_rendez_vous'  => '2026-04-09',
                'heure_rendez_vous' => '14:30:00',
                'statut'            => 'terminé',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            // Moroccan patients — past (terminé)
            [
                'patient_id'        => $patientId('hamid.ouchane@gmail.com'),
                'medecin_id'        => $medecinId('omar.elfassi@cabinet.ma'),
                'date_rendez_vous'  => '2026-04-10',
                'heure_rendez_vous' => '09:00:00',
                'statut'            => 'terminé',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'patient_id'        => $patientId('amina.bouchikhi@gmail.com'),
                'medecin_id'        => $medecinId('ahmed.rhazoui@cabinet.ma'),
                'date_rendez_vous'  => '2026-04-12',
                'heure_rendez_vous' => '10:30:00',
                'statut'            => 'terminé',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'patient_id'        => $patientId('tariq.senhaji@gmail.com'),
                'medecin_id'        => $medecinId('meryem.tazi@cabinet.ma'),
                'date_rendez_vous'  => '2026-04-15',
                'heure_rendez_vous' => '14:00:00',
                'statut'            => 'terminé',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            // Annulé
            [
                'patient_id'        => $patientId('fatima.aitouakrim@gmail.com'),
                'medecin_id'        => $medecinId('claire.vallet@example.com'),
                'date_rendez_vous'  => '2026-04-20',
                'heure_rendez_vous' => '11:00:00',
                'statut'            => 'annulé',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            // Futur — confirmé
            [
                'patient_id'        => $patientId('hamid.ouchane@gmail.com'),
                'medecin_id'        => $medecinId('claire.vallet@example.com'),
                'date_rendez_vous'  => '2026-04-28',
                'heure_rendez_vous' => '09:00:00',
                'statut'            => 'confirmé',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'patient_id'        => $patientId('fatima.aitouakrim@gmail.com'),
                'medecin_id'        => $medecinId('meryem.tazi@cabinet.ma'),
                'date_rendez_vous'  => '2026-05-05',
                'heure_rendez_vous' => '10:00:00',
                'statut'            => 'confirmé',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
