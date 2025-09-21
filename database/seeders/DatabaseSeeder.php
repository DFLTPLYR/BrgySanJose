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
            'name' => 'Official User',              // Add this
            'username' => 'Official',
            'email' => 'official@example.com',      // Add this
            'password' => Hash::make('password123'),
            'status' => 'approved',                 // Add this (since officials should be approved)
            'isVerified' => true
        ]);

        User::create([
            'name' => 'Admin User',                 // Add this
            'username' => 'Admin',
            'email' => 'admin@example.com',         // Add this
            'password' => Hash::make('password123'),
            'role' => 'Admin',
            'status' => 'approved',                 // Add this
            'isVerified' => true,
        ]);

        User::create([
            'name' => 'Super Admin',                // Add this
            'username' => 'SuperAdmin',
            'email' => 'superadmin@example.com',    // Add this
            'password' => Hash::make('password123'),
            'role' => 'SuperAdmin',
            'status' => 'approved',                 // Add this
            'isVerified' => true
        ]);
    }
}
