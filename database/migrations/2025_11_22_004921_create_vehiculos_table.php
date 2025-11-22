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
                Schema::create('vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id_vehiculo');
            $table->unsignedBigInteger('id_chofer');

            $table->string('numero_placa', 20);
            $table->string('color', 50);
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->integer('anno');
            $table->integer('capacidad_asientos');
            $table->string('fotografia', 255)->nullable();

            // Clave foránea
            $table->foreign('id_chofer')
                  ->references('id_usuario')
                  ->on('usuarios')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
