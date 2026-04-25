<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //  Artist Aliases
    // CREATE TABLE artist_aliases (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     artist_id INT UNSIGNED NOT NULL,
    //     alias_name VARCHAR(255) NOT NULL,
    //     FOREIGN KEY (artist_id) REFERENCES artists(artist_id)
    // );

    public function up(): void
    {
        Schema::create('artist_aliases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artist_id');
            $table->string('alias_name');

            $table->foreign('artist_id')->references('artist_id')->on('artists');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_aliases');
    }
};
