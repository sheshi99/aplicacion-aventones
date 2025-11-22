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
        Schema::create('reservas', function (Blueprint $table) {

            $table->id('id_reserva');

            $table->unsignedBigInteger('id_ride');
            $table->unsignedBigInteger('id_pasajero');

            $table->timestamp('fecha_reserva')->useCurrent();
            $table->string('estado', 20)->default('Pendiente');

            $table->foreign('id_ride')->references('id_ride')->on('rides');
            $table->foreign('id_pasajero')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
