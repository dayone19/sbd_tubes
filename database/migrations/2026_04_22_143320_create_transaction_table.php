<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //tabel transactions
    //sql
    // CREATE TABLE transactions(
    //     transaction_id INT(11) NOT NULL AUTO_INCREMENT,
    //     user_id INT(11) DEFAULT NULL,
    //     total_price DECIMAL(15, 2) NOT NULL,
    //     status VARCHAR(50) DEFAULT NULL,
    //     created_at DATETIME CURRENT_TIMESTAMP,
    //     PRIMARY KEY(transaction_id),
    //     FOREIGN KEY (user_id) REFERENCES user(user_id)
    // );
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('transaction_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->decimal('total_price', 15, 2);
            $table->string('status', 50)->nullable();
            $table->datetime('created_at')->useCurrent();

            // relasi tabel
            $table->foreign('user_id')->references('user_id')->on('users');
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
