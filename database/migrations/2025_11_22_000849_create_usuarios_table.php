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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id_usuario');
            $table->string('nombre', 50);
            $table->string('apellido', 100);
            $table->string('cedula', 20)->unique();
            $table->date('fecha_nacimiento');
            $table->string('correo', 100)->unique();
            $table->string('telefono', 20);
            $table->string('fotografia', 100);

            $table->string('contrasena', 255);

            $table->enum('rol', ['Administrador', 'Chofer', 'Pasajero']);
            $table->enum('estado', ['Pendiente', 'Activo', 'Inactivo'])->default('Pendiente');

            $table->string('token_activacion', 255)->nullable();

            $table->dateTime('fecha_registro')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
