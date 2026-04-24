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
                'prix_consultation' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Neurologie',
                'description' => 'Troubles du systeme nerveux',
                'prix_consultation' => 400,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Dermatologie',
                'description' => 'Soins de la peau et esthetique',
                'prix_consultation' => 555,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom'               => 'Médecine Générale',
                'description'       => 'Soins primaires et prévention',
                'prix_consultation' => 400,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'nom'               => 'Pédiatrie',
                'description'       => 'Santé de l\'enfant et de l\'adolescent',
                'prix_consultation' => 550,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'nom'               => 'Gynécologie-Obstétrique',
                'description'       => 'Santé féminine, suivi de grossesse et maternité',
                'prix_consultation' => 470,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
