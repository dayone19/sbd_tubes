<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //tabel label_release
    //sql
    // CREATE TABLE label_release (
        //     id INT(11) NOT NULL AUTO_INCREMENT,
        //     release_id INT(11) DEFAULT NULL,
        //     label_id INT(11) DEFAULT NULL,
        //     PRIMARY KEY (id),
        //     FOREIGN KEY (release_id) REFERENCES releases(release_id),
        //     FOREIGN KEY (label_id) REFERENCES  labels(label_id)
        // );
    public function up(): void
    {
        Schema::create('label_release', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('release_id')->nullable();
            $table->unsignedInteger('label_id')->nullable();

            // relasi antar tabel
            $table->foreign('release_id')->references('release_id')->on('releases');
            $table->foreign('label_id')->references('label_id')->on('labels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('label_release');
    }
};
