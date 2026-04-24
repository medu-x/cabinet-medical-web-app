<?php

namespace Database\Factories;

use App\Models\Specialite;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedecinFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'       => User::factory()->state(['role' => 'doctor', 'email_verified_at' => now()]),
            'specialite_id' => Specialite::factory(),
            'cin'           => fake()->unique()->regexify('[A-Z]{2}[0-9]{6}'),
            'telephone'     => '06' . fake()->numerify('########'),
            'bio'           => fake()->sentence(),
            'experience'    => fake()->numberBetween(1, 20),
        ];
    }
}
