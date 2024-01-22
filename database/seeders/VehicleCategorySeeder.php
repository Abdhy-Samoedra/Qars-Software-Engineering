<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehicleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicle_categories')->insert([
            'vehicle_category_name' => 'BMW',
            'vehicle_category_capacity' => '8',
            'vehicle_category_description' => 'Nice Luxurious Car',
            'slug' => 'bmw-29282',
        ]);
    }
}
