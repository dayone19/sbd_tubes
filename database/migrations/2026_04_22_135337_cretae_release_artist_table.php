<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // tabel release_artist
    //sql
    // CREATE TABLE release_artist (
        //     id INT(11) NOT NULL AUTO_INCREMENT,
        //     master_id INT(11) DEFAULT NULL,
        //     release_id INT(11) DEFAULT NULL,
        //     artist_id INT(11) DEFAULT NULL,
        //     role VARCHAR(100) DEFAULT NULL,
        //     PRIMARY KEY (id),
        //     FOREIGN KEY (release_id) REFERENCES release_table(release_id),
        //     FOREIGN KEY (artist_id) REFERENCES  artist(artist_id)
        // );
    public function up(): void
    {
        Schema::create('release_artist', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('release_id')->nullable();
            $table->unsignedInteger('artist_id')->nullable();
            $table->string('role', 100)->nullable();

            //tabel relasi
            $table->foreign('release_id')->references('release_id')->on('release_table');
            $table->foreign('artist_id')->references('artist_id')->on('artist');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('release_artist');
    }
};
