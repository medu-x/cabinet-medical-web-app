<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('rendez_vous')->insert([
            [
                'patient_id' => 1,
                'medecin_id' => 1,
                'date_rendez_vous' => '2026-04-08',
                'heure_rendez_vous' => '10:00:00',
                'statut' => 'termine',
                'notes' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => 2,
                'medecin_id' => 2,
                'date_rendez_vous' => '2026-04-09',
                'heure_rendez_vous' => '14:30:00',
                'statut' => 'termine',
                'notes' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        DB::table('rendez_vous')
            ->whereIn('date_rendez_vous', ['2026-04-08', '2026-04-09'])
            ->whereIn('heure_rendez_vous', ['10:00:00', '14:30:00'])
            ->delete();
    }
};
