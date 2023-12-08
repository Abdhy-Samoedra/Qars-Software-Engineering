<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voucher_categories', function (Blueprint $table) {
            $table->id();
            $table->text('voucher_picture')->nullable();
            $table->string('voucher_name');
            $table->integer('voucher_nominal');
            $table->integer('voucher_price');
            $table->date('expired_date');
            $table->integer('minimum_spending');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_categories');
    }
};
