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
        Schema::create('p3_transfer_hotel', function (Blueprint $table) {
            $table->id('id_hotel');
            $table->unsignedBigInteger('id_zona');
            $table->foreign('id_zona')->references('id_zona')->on('p3_transfer_zona');
            $table->integer('comision', false, true);
            $table->string('usuario', 100)->unique();
            $table->string('password', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p3_transfer_hotel');
    }
};
