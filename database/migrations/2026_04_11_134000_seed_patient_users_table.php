<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Jean Dupont',
                'email' => 'jean.dupont@example.com',
                'password' => Hash::make('password'),
                'role' => 'patient',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sara Benali',
                'email' => 'sara.benali@example.com',
                'password' => Hash::make('password'),
                'role' => 'patient',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        DB::table('users')
            ->whereIn('email', [
                'jean.dupont@example.com',
                'sara.benali@example.com',
            ])
            ->delete();
    }
};
