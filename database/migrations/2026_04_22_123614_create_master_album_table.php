<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // tabel master_albums
    //SQL
        // CREATE TABLE master_albums (
        //     master_id INT(11) NOT NULL AUTO_INCREMENT,
        //     title VARCHAR(255) NOT NULL,
        //     year INT(11) DEFAULT NULL,
        //     PRIMARY KEY (master_id)
        // );
    public function up(): void
    {
        Schema::create('master_albums', function (Blueprint $table) {
            $table->increments('master_id');
            $table->string('title', 255);
            $table->integer('year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_albums');
    }
};
