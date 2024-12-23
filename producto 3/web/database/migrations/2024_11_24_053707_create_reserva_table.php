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
        Schema::create('p3_transfer_reserva', function (Blueprint $table) {
            // --- Meta
            $table->id('id_reserva');
            $table->timestamp('fecha_reserva');
            $table->timestamp('fecha_modificacion');
            $table->unsignedBigInteger('id_tipo_reserva');

            // --- General
            $table->string('localizador', 100);
            $table->string('email_cliente', 100);
            $table->integer('num_viajeros');
            $table->unsignedBigInteger( 'id_precio');

            // --- ida
            $table->date('fecha_entrada')->nullable();
            $table->time('hora_entrada')->nullable();
            $table->string('numero_vuelo_entrada', 100)->nullable();
            $table->string('origen_vuelo_entrada', 100)->nullable();


            // --- vuelta
            $table->date('fecha_salida')->nullable();
            $table->time('hora_salida')->nullable();
            $table->string('numero_vuelo_salida', 100)->nullable();
            $table->time('hora_recogida')->nullable();

            // --- Viajero
            $table->unsignedBigInteger('id_viajero')->nullable();

            // --- Hotel
            $table->unsignedBigInteger('id_hotel')->nullable();

            $table->foreign('id_tipo_reserva')->references('id_tipo_reserva')->on('p3_transfer_tipo_reserva');
            $table->foreign('id_precio')->references('id_precio')->on('p3_transfer_precio');
            $table->foreign('id_viajero')->references('id_viajero')->
            on('p3_transfer_viajero')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_hotel')->references('id_hotel')->on('p3_transfer_hotel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p3_transfer_reserva');
    }
};
