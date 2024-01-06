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
        Schema::create('lost_and_founds', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('found_date');
            // $table->string('license_plate')->nullable();
            $table->string('taken_status')->default('Not Taken');
            $table->date('taken_date')->nullable();
            $table->text('lost_and_found_picture')->nullable();
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->string('vehicle_id')->nullable();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_and_founds');
    }
};
