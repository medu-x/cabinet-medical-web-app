<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
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

    public function down(): void
    {
        DB::table('patients')
            ->whereIn('user_id', [3, 4])
            ->delete();
    }
};
