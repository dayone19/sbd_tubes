<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //tabel transaction_details
    //sql
    // CREATE TABLE transaction_details(
    //     detail_id INT(11) NOT NULL AUTO_INCREMENT,
    //     transaction_id INT(11) DEFAULT NULL,
    //     product_id INT(11) DEFAULT NULL,
    //     quantity INT(11) DEFAULT NULL,
    //     price DECIMAL(15, 2) DEFAULT NULL,
    //     PRIMARY KEY(detail_id),
    //     FOREIGN KEY (transaction_id) REFERENCES transactions(transaction_id),
    //     FOREIGN KEY (product_id) REFERENCES products(product_id)
    // );
    public function up(): void
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->increments('detail_id');
            $table->unsignedInteger('transaction_id')->nullable();
            $table->unsignedInteger('product_id')->nullable(); 
            $table->integer('quantity')->nullable(); 
            $table->decimal('price', 15, 2)->nullable(); 

            // relasi tabel
            $table->foreign('transaction_id')->references('transaction_id')->on('transactions');
            $table->foreign('product_id')->references('product_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
