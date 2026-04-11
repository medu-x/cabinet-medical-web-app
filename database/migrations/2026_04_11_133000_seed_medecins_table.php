<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
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

    public function down(): void
    {
        DB::table('medecins')
            ->whereIn('user_id', [1, 2])
            ->delete();
    }
};
