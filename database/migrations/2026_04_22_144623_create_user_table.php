<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //tabel users
    //sql
    // CREATE TABLE users(
    //     user_id INT(11) NOT NULL AUTO_INCREMENT,
    //     username VARCHAR(100) NOT NULL,
    //     email VARCHAR(150) NOT NULL UNIQUE,
    //     password VARCHAR(150) NOT NULL,
    //     created_at DATETIME CURRENT_TIMESTAMP,
    //     PRIMARY KEY(user_id),
    //     KEY email(email)
    // );
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('username', 100);
            $table->string('email', 150)->unique();
            $table->string('password', 250);
            $table->datetime('created_at')->useCurrent();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
