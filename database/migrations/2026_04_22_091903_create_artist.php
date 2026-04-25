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
    // TABEL artists
    // SQL
    // CREATE TABLE artists (
    //     artist_id INT AUTO_INCREMENT PRIMARY KEY,
    //     name VARCHAR(255) NOT NULL,
    //     real_name VARCHAR(255),
    //     profile TEXT,
    //     country VARCHAR(100),
    //     birth_date DATE,
    //     is_group TINYINT(1) DEFAULT 0,
    //     image VARCHAR(255),
    //     created_at TIMESTAMP,
    //     updated_at TIMESTAMP
    // );

    Schema::create('artists', function (Blueprint $table) {
        $table->increments('artist_id');
        $table->string('name', 255);
        $table->string('real_name', 255)->nullable(); // ini tambahan nya ges
        $table->text('profile')->nullable();
        $table->string('country', 100)->nullable();
        $table->date('birth_date')->nullable(); // tambahan ges
        $table->boolean('is_group')->default(false); // tambahan ges
        $table->string('image')->nullable(); // tambahan ges
        $table->timestamps(); // created_at & updated_at ges
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artists');
    }
};
