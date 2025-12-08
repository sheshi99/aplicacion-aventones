<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ActivationController extends Controller
{
    /**
     * Activa la cuenta del usuario mediante un token enviado al correo.
     *
     * @param string $token  Token único generado al registrarse.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activarCuenta($token)
    {
        // Buscar un usuario cuyo token_activacion coincida con el proporcionado.
        // first() devuelve el primer registro encontrado o null si no existe.
        $user = User::where('token_activacion', $token)->first();

        // Si no se encuentra un usuario con este token, significa que:
        // - El token ya fue usado
        // - El token es inválido
        // - El usuario no existe
        if (!$user) {
            return redirect('/login')->with('error', 'Token inválido o caducado.');
        }

        // Si el token es válido, se procede a activar la cuenta.
        // Cambia el estado del usuario a "activo".
        $user->estado = 'activo';

        // Elimina el token de activación, para evitar que vuelva a utilizarse.
        $user->token_activacion = null;

        // Registra que el correo fue verificado en este momento.
        $user->email_verified_at = now();

        // Guarda todos los cambios en la base de datos.
        $user->save();

        // Redirige al login con mensaje de éxito.
        return redirect('/login')->with('success', 'Cuenta activada correctamente.');
    }
}

?>
