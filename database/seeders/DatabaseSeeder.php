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
            'name' => 'Official User',
            'username' => 'Official',
            'email' => 'official@example.com',
            'password' => Hash::make('password123'),
            'status' => 'approved',
            'isVerified' => true
        ]);

        User::create([
            'name' => 'Admin User',
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'Admin',
            'status' => 'approved',
            'isVerified' => true,
        ]);

        User::create([
            'name' => 'Super Admin',
            'username' => 'SuperAdmin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'SuperAdmin',
            'status' => 'approved',
            'isVerified' => true
        ]);
    }
}
