<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // tabel product
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->unsignedInteger('seller_id');//fk ke tabel seller
            $table->unsignedInteger('release_id');//fk ke tabel release
            $table->decimal('price', 15, 2);
            $table->string('condition', 100)->nullable();
            $table->string('status', 50)->nullable();
            $table->integer('stock')->default(1);

            // relasi antar tabel
            $table->foreign('seller_id')->references('seller_id')->on('seller');
            $table->foreign('release_id')->references('release_id')->on('release_table');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
