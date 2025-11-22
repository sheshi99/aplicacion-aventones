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
        Schema::create('rides', function (Blueprint $table) {
            $table->bigIncrements('id_ride');

            $table->unsignedBigInteger('id_chofer');
            $table->unsignedBigInteger('id_vehiculo');

            $table->string('nombre', 100);
            $table->string('salida', 100);
            $table->string('llegada', 100);
            $table->date('dia');
            $table->time('hora');
            $table->decimal('costo', 10, 2);
            $table->integer('espacios');

            // Relaciones
            $table->foreign('id_chofer')
                ->references('id_usuario')
                ->on('usuarios')
                ->onDelete('cascade');

            $table->foreign('id_vehiculo')
                ->references('id_vehiculo')
                ->on('vehiculos')
                ->onDelete('cascade');
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
