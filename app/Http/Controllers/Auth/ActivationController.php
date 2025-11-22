<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ActivationController extends Controller
{
    public function activarCuenta($token)
    {
        $user = User::where('token_activacion', $token)->first();

        if (!$user) {
            return redirect('/login')->with('error', 'Token inválido o caducado.');
        }

        // Activar cuenta y borrar token
        $user->estado = 'activo';
        $user->token_activacion = null;
        $user->email_verified_at = now();
        $user->save();

        return redirect('/login')->with('success', 'Cuenta activada correctamente.');
    }
}
?>
