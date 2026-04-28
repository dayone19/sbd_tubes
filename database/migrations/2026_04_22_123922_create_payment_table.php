<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // tabel payments
    //SQL
        // CREATE TABLE payments (
        //     payment_id INT(11) NOT NULL AUTO_INCREMENT,
        //     transaction_id INT(11) NOT NULL,
        //     method VARCHAR(50) NOT NULL,
        //     status VARCHAR(50) NOT NULL,
        //     paid_at DATETIME DEFAULT NULL,
        //     PRIMARY KEY (payment_id),
        //     FOREIGN KEY (transaction_id) REFERENCES transactions(transaction_id)
        // );
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('payment_id');
            $table->integer('transaction_id');
            $table->string('method', 50);
            $table->string('status', 50);
            $table->datetime('paid_at')->nullable();

            // relasi antar tabel
            $table->foreign('transaction_id')->references('transaction_id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
