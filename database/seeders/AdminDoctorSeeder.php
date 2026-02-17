<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminDoctorSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'System Admin',
            'email' => 'admin1@test.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        // Doctor
        User::create([
            'name' => 'Dr. Smith',
            'email' => 'doctor1@test.com',
            'password' => Hash::make('password123'),
            'role' => 'doctor'
        ]);
    }
}
