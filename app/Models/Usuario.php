<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false; 

    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'fecha_nacimiento',
        'correo',
        'telefono',
        'fotografia',
        'contrasena',
        'rol',
        'estado',
        'token_activacion',
        'fecha_registro'
    ];

    protected $hidden = [
        'contrasena',
        'token_activacion'
    ];
}
?>