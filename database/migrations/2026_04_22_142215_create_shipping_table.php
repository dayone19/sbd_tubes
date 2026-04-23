<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //tabel shippings
    //sql
    // CREATE TABLE shippings(
    //     shipping_id INT(11) NOT NULL AUTO_INCREMENT,
    //     transaction_id INT(11) DEFAULT NULL,
    //     address TEXT NOT NULL,
    //     cost DECIMAL (15, 2) DEFAULT NULL,
    //     status VARCHAR(100) DEFAULT NULL,
    //     PRIMARY KEY(shipping_id),
    //     FOREIGN KEY (transaction_id) REFERENCES transactions(transaction_id)
    // );
    public function up(): void
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('shipping_id');
            $table->unsignedInteger('transaction_id')->nullable();
            $table->text('address');
            $table->decimal('cost', 15, 2)->nullable();
            $table->string('status', 100)->nullable();

            // relasi tabel
            $table->foreign('transaction_id')->references('transaction_id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
