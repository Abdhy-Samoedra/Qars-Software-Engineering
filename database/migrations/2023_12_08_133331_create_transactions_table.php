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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('extend')->nullable();
            $table->integer('penalty')->nullable();
            $table->integer('exp_reward')->nullable();

            // payment status (pending,success,failed)
            $table->string('status')->default('Pending');
            $table->string('payment_status')->default('Pending');
            $table->string('payment_url')->nullable();

            $table->integer('total_price')->nullable();

            $table->foreignId('vehicle_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('driver_id')->nullable()->constrained();
            $table->foreignId('voucher_category_id')->nullable()->constrained();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
