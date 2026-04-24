<?php

namespace Database\Factories;

use App\Models\Medecin;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class RendezVousFactory extends Factory
{
    public function definition(): array
    {
        return [
            'patient_id'        => Patient::factory(),
            'medecin_id'        => Medecin::factory(),
            'date_rendez_vous'  => now()->addDays(7)->toDateString(),
            'heure_rendez_vous' => '09:00:00',
            'statut'            => 'en_attente',
        ];
    }

    public function termine(): static
    {
        return $this->state([
            'date_rendez_vous' => now()->subDays(5)->toDateString(),
            'statut'           => 'terminé',
        ]);
    }

    public function confirme(): static
    {
        return $this->state(['statut' => 'confirmé']);
    }

    public function annule(): static
    {
        return $this->state(['statut' => 'annulé']);
    }
}
