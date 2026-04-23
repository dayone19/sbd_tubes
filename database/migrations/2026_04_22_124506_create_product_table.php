<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // tabel product
    //sql
    // CREATE TABLE product (
        //     product_id INT(11) NOT NULL AUTO_INCREMENT,
        //     seller_id INT(11)UNSIGNED DEFAULT NULL,
        //     release_id INT(11)UNSIGNED DEFAULT NULL,
        //     price DECIMAL(15, 2) NOT NULL,
        //     condition VARCHAR(100) DEFAULT NULL,
        //     status VARCHAR(50) DEFAULT NULL,
        //     stock INT(11) DEFAULT 1,
        //     PRIMARY KEY (product_id),
        //     FOREIGN KEY (seller_id) REFERENCES seller(seller_id),
        //     FOREIGN KEY (release_id) REFERENCES release_table(release_id)
        // );
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->unsignedInteger('seller_id')->nullable();//fk ke tabel seller
            $table->unsignedInteger('release_id')->nullable();//fk ke tabel release
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
