<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicles')->insert([
            'id' => 'B 1289 CKN',
            'vehicle_category_id' => '1',
            'color' => 'Black',
            'brand' => 'BMW',
            'type' => 'A Good One',
            'year_of_release' => '2018',
            'fuel' => 'Diesel',
            'rental_price' => '300000',
            'car_description' => 'BMW Black with Custom BMW Logo',
            'status' => '0',
            'car_picture' => '"[\"assets\\\/item\\\/NF6JNTNfhGFQYQM0xNXn6SiwlaIRQSp2yNggYVKL.png\"]"',
            'slug' => '1-19283',
        ]);
    }
}
