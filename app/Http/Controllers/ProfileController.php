<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request)
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

        // Manejar fotografía
        if ($request->hasFile('fotografia')) {
        $archivo = $request->file('fotografia');

        $nombreLimpio = preg_replace('/[^A-Za-z0-9_\-]/', '_', $user->cedula . '_' . $user->name . '_' . $user->apellido);

        $nombreArchivo = $nombreLimpio . '.' . $archivo->getClientOriginalExtension();

        // Borrar la foto anterior ANTES de guardar la nueva
        if ($user->fotografia && Storage::disk('public')->exists($user->fotografia)) {
            Storage::disk('public')->delete($user->fotografia);
        }

        // Guardar nueva foto SOLO UNA VEZ
        $ruta = $archivo->storeAs('usuarios', $nombreArchivo, 'public');

        $user->fotografia = $ruta;
    }


        $user->save();

        return redirect()->route('profile.edit')
            ->with('success', 'Perfil actualizado correctamente.');
    }
}
