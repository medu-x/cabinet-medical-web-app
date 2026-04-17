<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('patients')->insert([
            [
                'user_id' => 3,
                'date_naissance' => '1995-03-15',
                'telephone' => '0633333333',
                'adresse' => 'Casablanca',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'date_naissance' => '1992-08-21',
                'telephone' => '0644444444',
                'adresse' => 'Rabat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
