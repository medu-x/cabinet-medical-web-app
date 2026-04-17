<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Patient;
use App\Models\Medecin;
use App\Models\RendezVous;

class PatientsRendezVousSeeder extends Seeder
{
    public function run(): void
    {
        $medecin = Medecin::first(); // نفترض عندك طبيب واحد مسجل

        if(!$medecin) {
            return;
        }

        // نخلق 10 مرضى مع Users ديالهم
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => "Patient $i",
                'email' => "patient$i@example.com",
                'password' => bcrypt('password'),
            ]);

            $patient = Patient::create([
                'user_id' => $user->id,
                'date_naissance' => now()->subYears(rand(20,60))->format('Y-m-d'),
                'telephone' => '06'.rand(10000000,99999999),
                'adresse' => "Adresse $i",
            ]);

            // نخلق موعد واحد لكل مريض
            RendezVous::create([
                'patient_id' => $patient->id,
                'medecin_id' => $medecin->id,
                'date_rendez_vous' => now()->addDays($i)->format('Y-m-d'),
                'heure_rendez_vous' => rand(8,16).":00:00",
                'statut' => $i % 2 == 0 ? 'terminé' : 'en attente',
                'notes' => "Diagnostic: test$i | medicament$i - ".rand(1,3)." - ".rand(3,7)."j",
            ]);
        }
    }
}
