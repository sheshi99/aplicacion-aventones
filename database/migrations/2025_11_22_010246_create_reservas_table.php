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

            // Foreign key a rides.id_ride
            $table->unsignedBigInteger('id_ride');
            $table->foreign('id_ride')->references('id_ride')->on('rides');

            // Foreign key a users.id
            $table->unsignedBigInteger('id_pasajero');
            $table->foreign('id_pasajero')->references('id')->on('users');

            // Estado de la reserva
            $table->enum('estado', ['pendiente', 'aceptada', 'rechazada', 'cancelada'])->default('pendiente');

            $table->timestamps();
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
