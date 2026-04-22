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
        Schema::create('release_style', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('release_id');
            $table->unsignedInteger('style_id');

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
