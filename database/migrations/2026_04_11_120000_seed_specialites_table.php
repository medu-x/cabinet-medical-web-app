<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('specialites')
            ->whereIn('nom', ['Cardiologie', 'Neurologie', 'Dermatologie'])
            ->delete();
    }
};
