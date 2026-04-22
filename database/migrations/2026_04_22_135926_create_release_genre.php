<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // tabel release_genre
    public function up(): void
    {
        Schema::create('release_genre', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('release_id');
            $table->unsignedInteger('genre_id');

            // relasi tabel
            $table->foreign('release_id')->references('release_id')->on('release_table');
            $table->foreign('genre_id')->references('genre_id')->on('genre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('release_genre');
    }
};
