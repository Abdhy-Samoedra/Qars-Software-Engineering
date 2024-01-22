<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VoucherCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('voucher_categories')->insert([
            'voucher_name' => 'Introduction Voucher',
            'voucher_nominal' => '50000',
            'voucher_price' => '100000',
            'expired_date' => '2004-03-03',
            'minimum_spending' => '25000',
            'voucher_picture' => '',
            'slug' => 'Introduction Voucher-12323',
        ]);
    }
}
