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
        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->increments('detail_id');
            $table->unsignedInteger('transaction_id');
            $table->unsignedInteger('product_id'); 
            $table->integer('quantity'); 
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
