<!-- BLUE PRINT DATABASE karena mau pakai blade -->

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
        // TABEL artist
        //SQL
        // CREATE TABLE artists (
        //     artist_id INT(11) NOT NULL AUTO_INCREMENT,
        //     name VARCHAR(255) NOT NULL,
        //     profile TEXT DEFAULT NULL,
        //     country VARCHAR(100) DEFAULT NULL,
        //     PRIMARY KEY (artist_id)
        // );

        Schema::create('artits', function (Blueprint $table) {
            $table->increments('artist_id');
            $table->string('name', 255);
            $table->text('profile')->nullable();
            $table->string('country', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artits');
    }
};
