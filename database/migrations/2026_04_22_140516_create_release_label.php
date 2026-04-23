<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //tabel release_label
    //sql
    // CREATE TABLE release_genre (
        //     id INT(11) NOT NULL AUTO_INCREMENT,
        //     release_id INT(11) DEFAULT NULL,
        //     label_id INT(11) DEFAULT NULL,
        //     PRIMARY KEY (id),
        //     FOREIGN KEY (release_id) REFERENCES release_table(release_id),
        //     FOREIGN KEY (label_id) REFERENCES  label(label_id)
        // );
    public function up(): void
    {
        Schema::create('release_label', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('release_id')->nullable();
            $table->unsignedInteger('label_id')->nullable();

            // relasi antar tabel
            $table->foreign('release_id')->references('release_id')->on('release_table');
            $table->foreign('label_id')->references('label_id')->on('label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('release_label');
    }
};
