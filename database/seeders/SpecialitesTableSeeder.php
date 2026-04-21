<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialitesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('specialites')->insert([
            [
                'nom' => 'Cardiologie',
                'description' => 'Sante cardiaque et vasculaire',
                'prix_consultation' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Neurologie',
                'description' => 'Troubles du systeme nerveux',
                'prix_consultation' => 65,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Dermatologie',
                'description' => 'Soins de la peau et esthetique',
                'prix_consultation' => 55,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
