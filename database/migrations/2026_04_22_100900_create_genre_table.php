<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //tabel genre
    //SQL
        // CREATE TABLE genre (
        //     genre_id INT(11) NOT NULL AUTO_INCREMENT,
        //     name VARCHAR(100) NOT NULL,
        //     PRIMARY KEY (genre_id)
        // );

    public function up(): void
    {
        Schema::create('genre', function (Blueprint $table) {
            $table->increments('genre_id');
            $table->string('name' , 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre');
    }
};
