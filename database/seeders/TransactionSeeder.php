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
            'payment_status' => 'Pending',
            'payment_url' => '',
            'total_price' => '100000',
            'vehicle_id' => 'B 1289 CKN',
            'user_id' => '1',
        ]);
        DB::table('transactions')->insert([
            'start_date' => '2004-03-15',
            'end_date' => '2004-04-29',
            'extend' => '0',
            'penalty' => '0',
            'exp_reward' => '150',
            'status' => 'Active',
            'payment_status' => 'Success',
            'payment_url' => 'https://www.example.com/payment/receipt/1234',
            'total_price' => '200000',
            'vehicle_id' => 'B 1289 CKN',
            'user_id' => '2',
        ]);
        DB::table('transactions')->insert(['start_date' => '2004-04-01', 'end_date' => '2004-05-15', 'extend' => '0', 'penalty' => '0', 'exp_reward' => '100', 'status' => 'Active', 'payment_status' => 'Success', 'payment_url' => '', 'total_price' => '150000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
        DB::table('transactions')->insert(['start_date' => '2004-05-20', 'end_date' => '2004-06-30', 'extend' => '1', 'penalty' => '0', 'exp_reward' => '50', 'status' => 'Active', 'payment_status' => 'Success', 'payment_url' => '', 'total_price' => '200000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
        DB::table('transactions')->insert(['start_date' => '2004-07-01', 'end_date' => '2004-08-14', 'extend' => '0', 'penalty' => '1', 'exp_reward' => '75', 'status' => 'Pending', 'payment_status' => '', 'payment_url' => '', 'total_price' => '300000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
        DB::table('transactions')->insert(['start_date' => '2004-08-15', 'end_date' => '2004-09-30', 'extend' => '1', 'penalty' => '0', 'exp_reward' => '150', 'status' => 'Active', 'payment_status' => 'Success', 'payment_url' => '', 'total_price' => '400000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
        DB::table('transactions')->insert(['start_date' => '2004-10-01', 'end_date' => '2004-11-14', 'extend' => '0', 'penalty' => '1', 'exp_reward' => '200', 'status' => 'Pending', 'payment_status' => '', 'payment_url' => '', 'total_price' => '500000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
        DB::table('transactions')->insert(['start_date' => '2004-11-15', 'end_date' => '2004-12-31', 'extend' => '1', 'penalty' => '0', 'exp_reward' => '250', 'status' => 'Active', 'payment_status' => 'Success', 'payment_url' => '', 'total_price' => '600000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
        DB::table('transactions')->insert(['start_date' => '2005-01-01', 'end_date' => '2005-02-14', 'extend' => '0', 'penalty' => '1', 'exp_reward' => '300', 'status' => 'Pending', 'payment_status' => '', 'payment_url' => '', 'total_price' => '700000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
        DB::table('transactions')->insert(['start_date' => '2005-02-15', 'end_date' => '2005-03-31', 'extend' => '1', 'penalty' => '0', 'exp_reward' => '350', 'status' => 'Active', 'payment_status' => 'Success', 'payment_url' => '', 'total_price' => '800000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
        DB::table('transactions')->insert(['start_date' => '2005-04-01', 'end_date' => '2005-05-15', 'extend' => '0', 'penalty' => '1', 'exp_reward' => '400', 'status' => 'Pending', 'payment_status' => '', 'payment_url' => '', 'total_price' => '900000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
        DB::table('transactions')->insert(['start_date' => '2005-05-20', 'end_date' => '2005-06-30', 'extend' => '1', 'penalty' => '0', 'exp_reward' => '450', 'status' => 'Active', 'payment_status' => 'Success', 'payment_url' => '', 'total_price' => '1000000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
        DB::table('transactions')->insert(['start_date' => '2005-07-01', 'end_date' => '2005-08-14', 'extend' => '0', 'penalty' => '1', 'exp_reward' => '500', 'status' => 'Pending', 'payment_status' => '', 'payment_url' => '', 'total_price' => '1100000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
        DB::table('transactions')->insert(['start_date' => '2005-08-15', 'end_date' => '2005-09-30', 'extend' => '1', 'penalty' => '0', 'exp_reward' => '550', 'status' => 'Active', 'payment_status' => 'Success', 'payment_url' => '', 'total_price' => '1200000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
        DB::table('transactions')->insert(['start_date' => '2005-10-01', 'end_date' => '2005-11-14', 'extend' => '0', 'penalty' => '1', 'exp_reward' => '600', 'status' => 'Pending', 'payment_status' => '', 'payment_url' => '', 'total_price' => '1300000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
        DB::table('transactions')->insert(['start_date' => '2005-11-15', 'end_date' => '2005-12-31', 'extend' => '1', 'penalty' => '0', 'exp_reward' => '650', 'status' => 'Active', 'payment_status' => 'Success', 'payment_url' => '', 'total_price' => '1400000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
        DB::table('transactions')->insert(['start_date' => '2006-01-01', 'end_date' => '2006-02-14', 'extend' => '0', 'penalty' => '1', 'exp_reward' => '700', 'status' => 'Pending', 'payment_status' => '', 'payment_url' => '', 'total_price' => '1500000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
        DB::table('transactions')->insert(['start_date' => '2006-02-15', 'end_date' => '2006-03-31', 'extend' => '1', 'penalty' => '0', 'exp_reward' => '750', 'status' => 'Active', 'payment_status' => 'Success', 'payment_url' => '', 'total_price' => '1600000', 'vehicle_id' => 'B 1289 CKN', 'user_id' => '1',]);
    }
}
