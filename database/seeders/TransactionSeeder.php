<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transactions')->insert([
            'start_date' => '2004-02-01',
            'end_date' => '2004-03-12',
            'extend' => '1',
            'penalty' => '1',
            'exp_reward' => '123',
            'status' => 'Pending',
            'payment_status' => '',
            'payment_url' => '',
            'total_price' => '100000',
            'vehicle_id' => 'B 1289 CKN',
            'user_id' => '1',
        ]);
    }
}
