<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function register(Request $request){
    $request->validate([
        'nombre' => 'required',
        'apellido' => 'required',
        'cedula' => 'required|unique:usuarios',
        'fecha_nacimiento' => 'required|date',
        'correo' => 'required|email|unique:usuarios',
        'telefono' => 'required',
        'contrasena' => 'required|min(6)',
        'rol' => 'required|in:Chofer,Pasajero,Administrador',
    ]);

    $usuario = Usuario::create([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'cedula' => $request->cedula,
        'fecha_nacimiento' => $request->fecha_nacimiento,
        'correo' => $request->correo,
        'telefono' => $request->telefono,
        'contrasena' => Hash::make($request->contrasena),
        'rol' => $request->rol,
        'estado' => 'Activo',     // ACTIVADO DE UNA
        'token_activacion' => null,
    ]);

    return response()->json([
        'ok' => true,
        'mensaje' => 'Registrado correctamente',
        'usuario' => $usuario
    ]);
    }

}
