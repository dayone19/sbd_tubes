<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //tabel styles
    //sql
    // CREATE TABLE styles(
    //     style_id INT(11) NOT NULL AUTO_INCREMENT,
    //     name VARCHAR(100) NOT NULL,
    //     PRIMARY KEY(style_id)
    // );
    public function up(): void
    {
        Schema::create('styles', function (Blueprint $table) {
            $table->increments('style_id');
            $table->string('name', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('styles');
    }
};
