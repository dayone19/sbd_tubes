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
        // TABEL cart
        Schema::create('cart', function (Blueprint $table) {
            $table->increments('cart_id');
            $table->unsignedInteger('user_id')->nullable();

            // relasi tabel
            $table->foreign('user_id')->references('user_id')->on(user);
        });

        // TABEL cart_item
        Schema::create('cart_item', function (Blueprint $table) {
            $table->increments('cart_item_id');
            $table->unsignedinteger('cart_id')->nullable();
            $table->unsignedInteger('product_id')->nullable(); 
            $table->integer('quantity')->default(1);

            // relasi tabel
            $table->foreign('cart_id')->references('cart_id')->on('cart'); 
            $table->foreign('product_id')->references('product_id')->on('product'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
        Schema::dropIfExists('cart_item');
    }
};
