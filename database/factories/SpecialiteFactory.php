<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialiteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom'               => fake()->randomElement([
                'Cardiologie', 'Neurologie', 'Dermatologie',
                'Médecine Générale', 'Pédiatrie', 'Gynécologie-Obstétrique', 'Ophtalmologie',
            ]) . ' ' . fake()->unique()->numberBetween(1, 9999),
            'description'       => fake()->sentence(),
            'prix_consultation' => fake()->randomElement([40, 50, 55, 60, 65, 70]),
        ];
    }
}
