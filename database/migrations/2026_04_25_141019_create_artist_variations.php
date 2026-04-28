<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // SQL
    // CREATE TABLE artist_variations (
    //     id INT NOT NULL AUTO_INCREMENT,
    //     artist_id INT(11) NOT NULL,
    //     variation_name VARCHAR(255) NOT NULL,
    //     PRIMARY KEY (id),
    //     FOREIGN KEY (artist_id) REFERENCES artists(artist_id)
    // );
    public function up(): void
    {
        Schema::create('artist_variations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artist_id'); // FK ke artists
            $table->string('variation_name', 255);

            $table->foreign('artist_id')->references('artist_id')->on('artists');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_variations');
    }
};
