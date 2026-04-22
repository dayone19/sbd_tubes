<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // tabel payment
    public function up(): void
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('payment_id');
            $table->unsignedInteger('transaction_id');
            $table->string('method', 50)->nullable();
            $table->string('status', 50)->nullable();
            $table->datetime('paid_at')->nullable();

            // relasi antar tabel
            $table->foreign('transaction_id')->references('transaction_id')->on('transaction');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
