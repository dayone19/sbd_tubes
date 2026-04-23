<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //tabel sellers
    //sql
    // CREATE TABLE sellers (
    //     seller_id INT(11) NOT NULL AUTO_INCREMENT,
    //     user_id VARCHAR(50) DEFAULT NULL,
    //     store_name VARCHAR(255) NOT NULL,
    //     PRIMARY KEY(seller_id),
    //     FOREIGN KEY (user_id) REFERENCES users(user_id)
    // );
    public function up(): void
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->increments('seller_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('store_name', 255);

            // relasi tabel
            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};
