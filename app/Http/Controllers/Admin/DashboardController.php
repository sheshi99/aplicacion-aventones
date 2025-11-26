<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios
        $usuarios = User::all();   

        // Retornar la vista enviando los usuarios
        return view('admin.dashboard', compact('usuarios'));
    }

    public function cambiarEstado($id)
    {
        $user = User::findOrFail($id);

        // Cambiar el estado
        if ($user->estado === 'activo') {
            $user->estado = 'inactivo';
        } else {
            $user->estado = 'activo';
        }

        $user->save();

        return back()->with('success', 'Estado del usuario actualizado correctamente.');
    }
}
