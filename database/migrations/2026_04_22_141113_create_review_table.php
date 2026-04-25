<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //tabel riviews
    //sql
    // CREATE TABLE riviews (
        //     review_id INT(11) NOT NULL AUTO_INCREMENT,
        //     user_id INT(11) DEFAULT NULL,
        //     product_id INT(11) DEFAULT NULL,
        //     rating INT(11) DEFAULT NULL,
        //     created_at DATETIME CURRENT_TIMESTAMP,
        //     PRIMARY KEY (riview_id),
        //     FOREIGN KEY (user_id) REFERENCES users(user_id),
        //     FOREIGN KEY (product_id) REFERENCES  products(product_id)
        // );
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('review_id');
            $table->integer('user_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('rating')->nullable();
            $table->datetime('created_at')->useCurrent();

            // relasi tabel
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('product_id')->references('product_id')->on('products');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
