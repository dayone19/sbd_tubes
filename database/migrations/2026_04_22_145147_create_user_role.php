<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //tabel user_roles
    //sql
    // CREATE TABLE user_roles(
    //     id INT(11) NOT NULL AUTO_INCREMENT,
    //     user_id INT(11) NOT NULL,
    //     role_id INT(11) NOT NULL,
    //     PRIMARY KEY(id),
    //     FOREIGN KEY (user_id) REFERENCES users(user_id),
    //     FOREIGN KEY (role_id) REFERENCES roles(role_id)
    // );
    public function up(): void
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('role_id');

            // relasi tabel
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('role_id')->references('role_id')->on('roles');

            // menghindari duplikasi user dan role
            $table->unique(['user_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
