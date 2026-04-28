<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Artist Sites
        // CREATE TABLE artist_sites (
        //     id INT NOT NULL AUTO_INCREMENT,
        //     artist_id INT NOT NULL,
        //     type VARCHAR(100),
        //     url VARCHAR(255) NOT NULL,
        //     PRIMARY KEY (id),
        //     FOREIGN KEY (artist_id) REFERENCES artists(artist_id)
        // );
        Schema::create('artist_sites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artist_id');
            $table->string('type')->nullable();
            $table->string('url', 255);

            $table->foreign('artist_id')->references('artist_id')->on('artists');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_sites');
    }
};
