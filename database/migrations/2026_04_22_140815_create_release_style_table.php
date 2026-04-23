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
        //     release_id INT(11) DEFAULT NULL,
        //     style_id INT(11) DEFAULT NULL,
        //     PRIMARY KEY (id),
        //     FOREIGN KEY (release_id) REFERENCES release_table(release_id),
        //     FOREIGN KEY (style_id) REFERENCES  style(style_id)
        // );
    public function up(): void
    {
        Schema::create('release_style', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('release_id')->nullable();
            $table->unsignedInteger('style_id')->nullable();

            // relasi tabel
            $table->foreign('release_id')->references('release_id')->on('release_table');
            $table->foreign('style_id')->references('style_id')->on('style');
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
