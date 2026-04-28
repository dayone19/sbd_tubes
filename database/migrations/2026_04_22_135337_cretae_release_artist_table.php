<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // tabel artist_release
    //sql
    // CREATE TABLE artist_release (
        //     id INT(11) NOT NULL AUTO_INCREMENT,
        //     release_id INT(11) NOT NULL,
        //     artist_id INT(11) NOT NULL,
        //     role VARCHAR(100) NOT NULL,
        //     PRIMARY KEY (id),
        //     FOREIGN KEY (release_id) REFERENCES releases(release_id),
        //     FOREIGN KEY (artist_id) REFERENCES  artists(artist_id)
        // );
    public function up(): void
    {
        Schema::create('artist_release', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('release_id');
            $table->integer('artist_id');
            $table->string('role', 100);

            //tabel relasi
            $table->foreign('release_id')->references('release_id')->on('releases');
            $table->foreign('artist_id')->references('artist_id')->on('artists');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_release');
    }
};
