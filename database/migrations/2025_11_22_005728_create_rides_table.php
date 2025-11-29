<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id('id_ride');

            // FK a usuarios (chofer)
            $table->unsignedBigInteger('id_chofer');

            // FK a vehiculos
            $table->unsignedBigInteger('id_vehiculo');

            $table->string('nombre', 100);
            $table->string('salida', 100);
            $table->string('llegada', 100);
            $table->date('dia');
            $table->time('hora');
            $table->decimal('costo', 10, 2);
            $table->integer('espacios');

            // Datos del vehículo en el momento del ride
            $table->string('vehiculo_placa', 20);
            $table->string('vehiculo_marca', 50);
            $table->string('vehiculo_modelo', 50);
            $table->integer('vehiculo_anio');

            // ===== FOREIGN KEYS =====
            $table->foreign('id_chofer')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->foreign('id_vehiculo')
            ->references('id_vehiculo')
            ->on('vehiculos')
            ->onDelete('restrict');

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
