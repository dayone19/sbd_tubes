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
            $table->integer('user_id')->nullable();
        });

        // TABEL cart_item
        Schema::create('cart_item', function (Blueprint $table) {
            $table->increments('cart_item_id');
            $table->integer('cart_id')->nullable()->index();
            $table->integer('product_id')->nullable()->index(); //->index() dipakai karena ini adalah foreign key gaes // yoan
            $table->integer('quantity')->nullable()->default(1);
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
