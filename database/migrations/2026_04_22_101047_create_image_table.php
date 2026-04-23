<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //TABEL image 
    //SQL
        // CREATE TABLE image (
        //     image_id INT(11) NOT NULL AUTO_INCREMENT,
        //     release_id INT(11) UNSIGNED,
        //     url TEXT NOT NULL,
        //     type VARCHAR(70) DEFAULT NULL,
        //     PRIMARY KEY (image_id),
        //     FOREIGN KEY(release_id) REFERENCES release_table(release_id)
        // );

    public function up(): void
    {
        Schema::create('image', function (Blueprint $table) {
            $table->increments('image_id');
            $table->unsignedInteger('release_id');
            $table->text('url');
            $table->string('type', 70);

            // relasi antar tabel
            $table->foreign('release_id')->references('release_id')->on('release_table');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image');
    }
};
