<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
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

    public function down(): void
    {
        DB::table('avis')
            ->whereIn('commentaire', [
                'Tres bonne consultation, claire et rassurante.',
                'Bon diagnostic et explications utiles.',
            ])
            ->delete();
    }
};
