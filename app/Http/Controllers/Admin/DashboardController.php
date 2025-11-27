<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('admin.dashboard', compact('usuarios'));
    }

    public function cambiarEstado($id)
    {
        $superAdminId = 1; // Usuario superadmin por código
        $auth = Auth::user();
        $user = User::findOrFail($id);

        // 1. No se puede desactivar al superadmin
        if ($user->id == $superAdminId) {
            return back()->with('error', 'No se puede desactivar al SuperAdmin.');
        }

        // 2. Nadie puede desactivarse a sí mismo
        if ($auth->id == $user->id) {
            return back()->with('error', 'No puedes desactivarte a ti mismo.');
        }

        // 3. Superadmin puede desactivar a cualquier usuario
        if ($auth->id == $superAdminId) {
            $user->estado = 'inactivo';
            $user->save();
            return back()->with('success', 'Estado del usuario actualizado correctamente.');
        }

        // 4. Admin normal no puede desactivar a otros admins
        if ($auth->rol === 'admin') {

            if ($user->rol === 'admin') {
                return back()->with('error', 'No puedes desactivar a otro administrador.');
            }

            // Puede desactivar usuarios normales
            $user->estado = 'inactivo';
            $user->save();

            return back()->with('success', 'Estado del usuario actualizado correctamente.');
        }

        // 5. Usuarios normales NO pueden hacer nada
        return back()->with('error', 'No tienes permisos para cambiar estados.');
    }
}
