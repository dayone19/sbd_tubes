<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // tabel releases
    //sql
    // CREATE TABLE releases (
        //     release_id INT(11) NOT NULL AUTO_INCREMENT,
        //     master_id INT(11) DEFAULT NULL,
        //     title VARCHAR(255) NOT NULL,
        //     country VARCHAR(100) DEFAULT NULL,
        //     release_date DATE DEFAULT NULL,
        //     notes TEXT DEFAULT NULL,
        //     catalog_number VARCHAR(100) DEFAULT NULL
        //     PRIMARY KEY (release_id),
        //     FOREIGN KEY (master_id) REFERENCES master_albums(master_id)
        // );
    public function up(): void
    {
        Schema::create('releases', function (Blueprint $table) {
            $table->increments('release_id');
            $table->unsignedInteger('master_id')->nullable();
            $table->string('title', 255);
            $table->string('country', 100)->nullable();
            $table->date('release_date')->nullable();
            $table->text('notes')->nullable();
            $table->string('catalog_number', 100)->nullable();

            // relasi tabel
            $table->foreign('master_id')->references('master_id')->on('master_albums');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('releases');
    }
};
