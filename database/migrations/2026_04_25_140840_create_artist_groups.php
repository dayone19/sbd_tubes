<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //  Artist Group (Pivot)
//    CREATE TABLE artist_groups (
//             id INT AUTO_INCREMENT PRIMARY KEY,
//             artist_id INT NOT NULL,
//             group_id INT NOT NULL,
//             FOREIGN KEY (artist_id) REFERENCES artists(artist_id),
//             FOREIGN KEY (group_id) REFERENCES groups(group_id)
//     );
    public function up(): void
    {
        Schema::create('artist_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artist_id');
            $table->integer('group_id');

            $table->foreign('artist_id')->references('artist_id')->on('artists');
            $table->foreign('group_id')->references('group_id')->on('groups');

            $table->unique(['artist_id', 'group_id']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_groups');
    }
};
