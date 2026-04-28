<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //tabel release_style
    //sql
    // CREATE TABLE release_style (
        //     id INT(11) NOT NULL AUTO_INCREMENT,
        //     release_id INT(11) NOT NULL,
        //     style_id INT(11) NOT NULL,
        //     PRIMARY KEY (id),
        //     FOREIGN KEY (release_id) REFERENCES releases(release_id),
        //     FOREIGN KEY (style_id) REFERENCES  styles(style_id)
        // );
    public function up(): void
    {
        Schema::create('release_style', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('release_id');
            $table->integer('style_id');

            // relasi tabel
            $table->foreign('release_id')->references('release_id')->on('releases');
            $table->foreign('style_id')->references('style_id')->on('styles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('release_style');
    }
};
