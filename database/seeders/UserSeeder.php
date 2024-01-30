<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Bambang',
            'gender' => 'Male',
            'phone' => '087889535999',
            'email' => 'bambs@gmail.com',
            'driving_license_path' => '',
            'driving_license_status' => '',
            'age' => '38',
            'role' => 'Customer',
            'profile_photo_path' => '',
            'experience_point' => '12',
            'password' => bcrypt('password'),
            'slug' => 'bambang-19232',
        ]);
    }
}
