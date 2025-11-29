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

            $table->foreignId('id_ride')->constrained('rides');
            $table->foreignId('id_pasajero')->constrained('users');

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
