<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Actualizar campos
        $user->name = $request->name;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->cedula = $request->cedula;
        $user->telefono = $request->telefono;
        $user->fecha_nacimiento = $request->fecha_nacimiento;

        // Cambiar contraseña solo si se ingresó
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Manejar fotografía (respetando tu fragmento original)
        if ($request->hasFile('fotografia')) {
            $archivo = $request->file('fotografia');
            $baseRuta = 'usuarios/';
            $rolRuta = $baseRuta . strtolower($user->rol) . '/';

            if (!is_dir(public_path($rolRuta))) {
                mkdir(public_path($rolRuta), 0777, true);
            }

            $extension = $archivo->getClientOriginalExtension();
            $nombreArchivo = "{$user->id}_" . preg_replace('/\s+/', '_', $user->name) . ".{$extension}";
            $destino = $rolRuta . $nombreArchivo;

            // Borrar foto existente
            if ($user->fotografia && file_exists(public_path($user->fotografia))) {
                unlink(public_path($user->fotografia));
            }

            // Mover archivo
            $archivo->move(public_path($rolRuta), $nombreArchivo);
            $user->fotografia = $destino;
        }

        $user->save();

        return Redirect::route('profile.edit')
            ->with('success', 'Perfil actualizado correctamente.');
    }
}
