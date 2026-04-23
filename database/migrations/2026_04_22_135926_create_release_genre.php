<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // tabel release_genre
    //sql
    // CREATE TABLE release_genre (
        //     id INT(11) NOT NULL AUTO_INCREMENT,
        //     release_id INT(11) DEFAULT NULL,
        //     genre_id INT(11) DEFAULT NULL,
        //     PRIMARY KEY (id),
        //     FOREIGN KEY (release_id) REFERENCES release_table(release_id),
        //     FOREIGN KEY (genre_id) REFERENCES  genre(genre_id)
        // );
    public function up(): void
    {
        Schema::create('release_genre', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('release_id')->nullable();
            $table->unsignedInteger('genre_id')->nullable();

            // relasi tabel
            $table->foreign('release_id')->references('release_id')->on('release_table');
            $table->foreign('genre_id')->references('genre_id')->on('genre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('release_genre');
    }
};
