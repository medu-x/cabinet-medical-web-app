<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RendezVous;
use App\Models\Patient;
use App\Models\Medecin;

class RendezVousSeeder extends Seeder
{
    public function run(): void
    {
        $patient = Patient::first();  
        $medecin = Medecin::first();   

        if(!$patient || !$medecin) {
            return;
        }

        RendezVous::create([
            'patient_id' => $patient->id,
            'medecin_id' => $medecin->id,
            'date_rendez_vous' => '2026-04-20',
            'heure_rendez_vous' => '10:00:00',
            'statut' => 'terminé',
            'notes' => 'Diagnostic: l9lb | aspro - 3 - 7j - fili',
        ]);

        RendezVous::create([
            'patient_id' => $patient->id,
            'medecin_id' => $medecin->id,
            'date_rendez_vous' => '2026-04-21',
            'heure_rendez_vous' => '14:30:00',
            'statut' => 'en attente',
            'notes' => 'Diagnostic: grib | doliprane - 2 - 5j',
        ]);
    }
}
