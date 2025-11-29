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

            $nombreArchivo = Str::slug($user->id . '_' . $user->name) . '.' . $archivo->getClientOriginalExtension();
            $ruta = $archivo->storeAs('usuarios', $nombreArchivo, 'public');

            // Borrar foto anterior si existe
            if ($user->fotografia && Storage::disk('public')->exists($user->fotografia)) {
                Storage::disk('public')->delete($user->fotografia);
            }

            $user->fotografia = $ruta;
        }

        $user->save();

        return redirect()->route('profile.edit')
            ->with('success', 'Perfil actualizado correctamente.');
    }
}
