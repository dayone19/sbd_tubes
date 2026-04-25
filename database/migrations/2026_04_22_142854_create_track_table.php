<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //tabel tracks
    //sql
    // CREATE TABLE tracks(
    //     track_id INT(11) NOT NULL AUTO_INCREMENT,
    //     release_id INT(11) DEFAULT NULL,
    //     title VARCHAR(255) NOT NULL,
    //     duration TIME DEFAULT NULL,
    //     position VARCHAR(35) DEFAULT NULL
    //     PRIMARY KEY(style_id),
    //     FOREIGN KEY (release_id) REFERENCES releases(release_id)
    // );
    public function up(): void
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->increments('track_id');
            $table->integer('release_id')->nullable();
            $table->string('title', 255);
            $table->time('duration')->nullable();
            $table->string('position', 35)->nullable();

            //relasi tabel
            $table->foreign('release_id')->references('release_id')->on('releases');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
