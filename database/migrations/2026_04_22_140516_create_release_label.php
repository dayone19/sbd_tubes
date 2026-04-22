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
        Schema::create('release_label', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('release_id');
            $table->unsignedInteger('label_id');

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
