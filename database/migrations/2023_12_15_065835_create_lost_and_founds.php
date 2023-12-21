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
            $table->boolean('taken_status')->default(false);
            $table->text('lost_and_found_picture')->nullable();
            $table->text('description')->nullable();
            $table->string('slug')->unique();

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
