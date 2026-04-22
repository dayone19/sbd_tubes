<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('track', function (Blueprint $table) {
            $table->increments('track_id');
            $table->unsignedInteger('release_id');
            $table->string('title', 255);
            $table->time('duration')->nullable();
            $table->string('position', 35)->nullable();

            //relasi tabel
            $table->foreign('release_id')->references('release_id')->on('release_table');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track');
    }
};
