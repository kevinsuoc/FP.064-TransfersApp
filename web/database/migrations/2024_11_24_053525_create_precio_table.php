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
        Schema::create('p3_transfer_precio', function (Blueprint $table) {
            $table->id('id_precio');
            $table->unsignedBigInteger('id_vehiculo');
            $table->unsignedBigInteger('id_hotel');
            $table->bigInteger('precio');

            $table->foreign('id_vehiculo')->references('id_vehiculo')->on('p3_transfer_vehiculo');
            $table->foreign('id_hotel')->references(columns: 'id_hotel')->on('p3_transfer_hotel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p3_transfer_precio');
    }
};
