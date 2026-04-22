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
        Schema::create('review', function (Blueprint $table) {
            $table->increments('review_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');
            $table->integer('rating')->nullable();
            $table->datetime('created_at')->nullable();

            // relasi tabel
            $table->foreign('user_id')->references('user_id')->on('user');
            $table->foreign('product_id')->references('product_id')->on('product');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
