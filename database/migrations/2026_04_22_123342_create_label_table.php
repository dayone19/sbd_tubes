<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //   tabel labels
    //SQL
        // CREATE TABLE labels (
        //     label_id INT(11) NOT NULL AUTO_INCREMENT,
        //     name VARCHAR(255) NOT NULL,
        //     PRIMARY KEY (label_id)
        // );
    public function up(): void
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->increments('label_id');
            $table->string('name', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labels');
    }
};
