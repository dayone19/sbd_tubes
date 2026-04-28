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
    //     transaction_id INT(11) NOT NULL,
    //     product_id INT(11) NOT NULL,
    //     quantity INT(11) NOT NULL,
    //     price DECIMAL(15, 2) NOT NULL,
    //     PRIMARY KEY(detail_id),
    //     FOREIGN KEY (transaction_id) REFERENCES transactions(transaction_id),
    //     FOREIGN KEY (product_id) REFERENCES products(product_id)
    // );
    public function up(): void
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->increments('detail_id');
            $table->integer('transaction_id');
            $table->integer('product_id'); 
            $table->integer('quantity'); 
            $table->decimal('price', 15, 2); 

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
