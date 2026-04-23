<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //tabel transaction_detail
    //sql
    // CREATE TABLE transaction_detail(
    //     detail_id INT(11) NOT NULL AUTO_INCREMENT,
    //     transaction_id INT(11) DEFAULT NULL,
    //     product_id INT(11) DEFAULT NULL,
    //     quantity INT(11) DEFAULT NULL,
    //     price DECIMAL(15, 2) DEFAULT NULL,
    //     PRIMARY KEY(detail_id),
    //     FOREIGN KEY (transaction_id) REFERENCES transaction(transaction_id)
    // );
    public function up(): void
    {
        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->increments('detail_id');
            $table->unsignedInteger('transaction_id')->nullable();
            $table->unsignedInteger('product_id')->nullable(); 
            $table->integer('quantity')->nullable(); 
            $table->decimal('price', 15, 2)->nullable(); 

            // relasi tabel
            $table->foreign('transaction_id')->references('transaction_id')->on('transaction');
            $table->foreign('product_id')->references('product_id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_detail');
    }
};
