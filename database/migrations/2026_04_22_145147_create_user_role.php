<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //tabel user_role
    //sql
    // CREATE TABLE user_role(
    //     id INT(11) NOT NULL AUTO_INCREMENT,
    //     user_id INT(11) DEFAULT NULL,
    //     role_id INT(11) DEFAULT NULL,
    //     PRIMARY KEY(id),
    //     FOREIGN KEY (user_id) REFERENCES user(user_id),
    //     FOREIGN KEY (role_id) REFERENCES role(role_id)
    // );
    public function up(): void
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('role_id')->nullable();

            // relasi tabel
            $table->foreign('user_id')->references('user_id')->on('user');
            $table->foreign('role_id')->references('role_id')->on('role');

            // menghindari duplikasi user dan role
            $table->unique(['user_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_role');
    }
};
