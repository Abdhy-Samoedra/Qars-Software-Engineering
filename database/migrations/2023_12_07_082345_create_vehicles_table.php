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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->string('license_plate')->primary();
            $table->timestamps();
            $table->unsignedBigInteger('vehicle_category_id');
            $table->string('color');
            $table->string('merk');
            $table->string('type');
            $table->integer('year_of_release');
            $table->string('fuel');
            $table->integer('rental_price');
            $table->longText('car_description');
            $table->integer('status')->default('0');
            $table->text('car_picture')->nullable();
            $table->string('slug')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
