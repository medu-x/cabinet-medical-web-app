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
                'name' => 'Mohamed Ouhammou',
                'email' => 'claire.vallet@example.com',
                'password' => Hash::make('password'),
                'role' => 'doctor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Marc Antoine',
                'email' => 'marc.antoine@example.com',
                'password' => Hash::make('password'),
                'role' => 'doctor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        DB::table('users')
            ->whereIn('email', [
                'claire.vallet@example.com',
                'marc.antoine@example.com',
            ])
            ->delete();
    }
};
