<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Secretaire;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SecretarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // On crée l'utilisateur Secrétaire
        $user = User::updateOrCreate(
            ['email' => 'secretary@cabinet.com'],
            [
                'name' => 'yahya sihame',
                'password' => Hash::make('password'),
                'role' => 'secretary',
                'remember_token' => Str::random(10),
            ]
        );

        // On lui crée sa fiche secrétaire associée
        Secretaire::firstOrCreate(
            ['user_id' => $user->id],
            [
                'cin' => 'SEC12345',
                'bureau' => 'Accueil Principal',
                'adresse' => 'Bureau A, RdC Cabinet Vitality',
            ]
        );
    }
}
