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
        Schema::create('shipping', function (Blueprint $table) {
            $table->increments('shipping_id');
            $table->unsignedInteger('transaction_id');
            $table->text('address');
            $table->decimal('cost', 15, 2)->nullable();
            $table->string('status', 100)->nullable();

            // relasi tabel
            $table->foreign('transaction_id')->references('transaction_id')->on('transaction');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping');
    }
};
