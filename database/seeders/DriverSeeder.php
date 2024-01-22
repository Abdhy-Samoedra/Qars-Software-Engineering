<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('drivers')->insert([
            'name' => 'Driver',
            'gender' => 'Male',
            'phone' => '0829384737',
            'age' => 24,
            'slug' => 'Driver-12312'
        ]);
    }
}
