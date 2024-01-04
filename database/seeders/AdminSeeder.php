<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'gender' => 'Male',
            'phone' => '09947583544',
            'email' => 'admin@example.com',
            'age' => 24,
            'password' => bcrypt('password'),
            'role' => 'Admin',
            'slug' => 'Admin-34543'
        ]);
    }
}