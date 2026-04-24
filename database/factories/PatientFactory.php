<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'        => User::factory()->state(['role' => 'patient', 'email_verified_at' => now()]),
            'cin'            => fake()->unique()->regexify('[A-Z]{2}[0-9]{6}'),
            'date_naissance' => fake()->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'telephone'      => '06' . fake()->numerify('########'),
            'adresse'        => fake()->address(),
        ];
    }
}
