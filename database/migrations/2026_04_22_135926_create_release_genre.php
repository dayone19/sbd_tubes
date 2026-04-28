<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // tabel genre_release
    //sql
    // CREATE TABLE genre_release (
        //     id INT(11) NOT NULL AUTO_INCREMENT,
        //     release_id INT(11) NOT NULL,
        //     genre_id INT(11) NOT NULL,
        //     PRIMARY KEY (id),
        //     FOREIGN KEY (release_id) REFERENCES releases(release_id),
        //     FOREIGN KEY (genre_id) REFERENCES  genres(genre_id)
        // );
    public function up(): void
    {
        Schema::create('genre_release', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('release_id');
            $table->integer('genre_id');

            // relasi tabel
            $table->foreign('release_id')->references('release_id')->on('releases');
            $table->foreign('genre_id')->references('genre_id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_release');
    }
};
