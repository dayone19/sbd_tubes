<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // tabel payment
    //SQL
        // CREATE TABLE payment (
        //     payment_id INT(11) NOT NULL AUTO_INCREMENT,
        //     transaction_id INT(11) DEFAULT NULL,
        //     method VARCHAR(50) DEFAULT NULL,
        //     status VARCHAR(50) DEFAULT NULL,
        //     paid_at DATETIME DEFAULT NULL,
        //     PRIMARY KEY (payment_id),
        //     FOREIGN KEY (transaction_id) REFERENCES transaction(transaction_id)
        // );
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
