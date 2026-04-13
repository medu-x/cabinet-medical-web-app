<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the application's admin user.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'root@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('adminadmin'),
                'role' => 'admin',
            ]
        );
    }
}
