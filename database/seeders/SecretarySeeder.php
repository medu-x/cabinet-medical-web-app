<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Secretaire;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SecretarySeeder extends Seeder
{
    public function run(): void
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
                'name'   => 'Nadia Tahiri',
                'email'  => 'n.tahiri@cabinet.com',
                'cin'    => 'SEC11223',
                'bureau' => 'C',
            ],
        ];

        foreach ($secretaires as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'           => $data['name'],
                    'password'       => Hash::make('password'),
                    'role'           => 'secretary',
                    'remember_token' => Str::random(10),
                ]
            );

            Secretaire::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'cin'    => $data['cin'],
                    'bureau' => $data['bureau'],
                ]
            );
        }
    }
}

