<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        // TABEL carts
        //SQL
        // CREATE TABLE carts (
        //     cart_id INT(11) NOT NULL AUTO_INCREMENT,
        //     user_id INT(11) NOT NULL,
        //     PRIMARY KEY (cart_id),
        //     FOREIGN KEY (user_id) REFERENCES users(user_id)
        // );
        
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('cart_id');
            $table->integer('user_id');

            // relasi tabel
            $table->foreign('user_id')->references('user_id')->on('users');
        });

        // TABEL cart_items
        //SQL
        // CREATE TABLE cart_items (
        //     cart_item_id INT(11) NOT NULL AUTO_INCREMENT,
        //     cart_id INT(11) NOT NULL,
        //     product_id INT(11) NOT NULL,
        //     quantity INT(11) DEFAULT 1,
        //     PRIMARY KEY (cart_item_id),
        //     FOREIGN KEY (cart_id) REFERENCES carts(cart_id),
        //     FOREIGN KEY (product_id) REFERENCES products(product_id)
        // );

        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('cart_item_id');
            $table->integer('cart_id');
            $table->integer('product_id'); 
            $table->integer('quantity')->default(1);

            // relasi tabel
            $table->foreign('cart_id')->references('cart_id')->on('carts'); 
            $table->foreign('product_id')->references('product_id')->on('products'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts'); 
    }
};
