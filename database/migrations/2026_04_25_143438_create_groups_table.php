<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // tabel Groups
    //sql
    // CREATE TABLE `groups` (
    //     group_id INT NOT NULL AUTO_INCREMENT,
    //     name VARCHAR(255) NOT NULL,
    //     PRIMARY KEY (group_id)
    // );
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('group_id');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
