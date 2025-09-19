<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Official',
            'password' => Hash::make('password123'),
            'isVerified' => true
        ]);

        User::create([
            'username' => 'Admin',
            'password' => Hash::make('password123'),
            'role' => 'Admin',
            'isVerified' => true,
        ]);

        User::create([
            'username' => 'SuperAdmin',
            'password' => Hash::make('password123'),
            'role' => 'SuperAdmin',
            'isVerified' => true
        ]);
    }
}
