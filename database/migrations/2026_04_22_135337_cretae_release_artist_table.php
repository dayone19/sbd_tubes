<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // tabel release_artist
    public function up(): void
    {
        Schema::create('release_artist', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('release_id');
            $table->unsignedInteger('artist_id');
            $table->string('role', 100)->nullable();

            //tabel relasi
            $table->foreign('release_id')->references('release_id')->on('release_table');
            $table->foreign('artist_id')->references('artist_id')->on('artist');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('release_artist');
    }
};
