<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvisTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('avis')->insert([
            [
                'rendez_vous_id' => 1,
                'note' => 5,
                'commentaire' => 'Tres bonne consultation, claire et rassurante.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rendez_vous_id' => 2,
                'note' => 4,
                'commentaire' => 'Bon diagnostic et explications utiles.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
