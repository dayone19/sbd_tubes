<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // tabel release_tabel
    //sql
    // CREATE TABLE release_table (
        //     release_id INT(11) NOT NULL AUTO_INCREMENT,
        //     master_id INT(11) DEFAULT NULL,
        //     title VARCHAR(255) NOT NULL,
        //     country VARCHAR(100) DEFAULT NULL,
        //     release_date DATE DEFAULT NULL,
        //     notes TEXT DEFAULT NULL,
        //     catalog_number VARCHAR(100) DEFAULT NULL
        //     PRIMARY KEY (release_id),
        //     FOREIGN KEY (master_id) REFERENCES master_album(master_id)
        // );
    public function up(): void
    {
        Schema::create('release_table', function (Blueprint $table) {
            $table->increments('release_id');
            $table->unsignedInteger('master_id')->nullable();
            $table->string('title', 255);
            $table->string('country', 100)->nullable();
            $table->date('release_date')->nullable();
            $table->text('notes')->nullable();
            $table->string('catalog_number', 100)->nullable();

            // relasi tabel
            $table->foreign('master_id')->references('master_id')->on('master_album');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('release_table');
    }
};
