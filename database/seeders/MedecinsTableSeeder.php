<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedecinsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('medecins')->insert([
            [
                'user_id' => 1,
                'telephone' => '0611111111',
                'bio' => 'Neurologue senior specialisee dans le suivi clinique.',
                'experience' => '12',
                'photo_path' => null,
                'specialite_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'telephone' => '0622222222',
                'bio' => 'Specialiste en neurologie avec une approche clinique personnalisee.',
                'experience' => '10',
                'photo_path' => null,
                'specialite_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
