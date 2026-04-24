<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientsTableSeeder extends Seeder
{
    public function run(): void
    {
        $userId = fn(string $email) => DB::table('users')->where('email', $email)->value('id');

        $patients = [
            [
                'user_id'        => $userId('MOHAMED@CABINET.COM'),
                'cin'            => 'AB000001',
                'date_naissance' => '1995-03-15',
                'telephone'      => '0633333333',
                'adresse'        => 'Casablanca',
            ],
            [
                'user_id'        => $userId('sara.benali@example.com'),
                'cin'            => 'AB000002',
                'date_naissance' => '1992-08-21',
                'telephone'      => '0644444444',
                'adresse'        => 'Rabat',
            ],
            [
                'user_id'        => $userId('hamid.ouchane@gmail.com'),
                'cin'            => 'AB123456',
                'date_naissance' => '1985-06-15',
                'telephone'      => '0661234567',
                'adresse'        => '12 Rue Ibn Sina, Guéliz, Marrakech',
            ],
            [
                'user_id'        => $userId('amina.bouchikhi@gmail.com'),
                'cin'            => 'GH901234',
                'date_naissance' => '1975-07-30',
                'telephone'      => '0694567890',
                'adresse'        => '3 Derb Seffah, Médina, Fès',
            ],
            [
                'user_id'        => $userId('tariq.senhaji@gmail.com'),
                'cin'            => 'IJ567890',
                'date_naissance' => '1988-02-14',
                'telephone'      => '0605678901',
                'adresse'        => '22 Avenue des FAR, Hamria, Meknès',
            ],
            [
                'user_id'        => $userId('fatima.aitouakrim@gmail.com'),
                'cin'            => 'KL123456',
                'date_naissance' => '1995-09-05',
                'telephone'      => '0616789012',
                'adresse'        => '8 Rue du 18 Novembre, Talborjt, Agadir',
            ],
        ];

        foreach ($patients as $data) {
            $patientId = DB::table('patients')->insertGetId(array_merge($data, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));

            DB::table('dossier_medical')->insert([
                'patient_id' => $patientId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
