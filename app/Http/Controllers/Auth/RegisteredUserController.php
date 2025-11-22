<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cedula' => ['nullable', 'string', 'max:20'],
            'fecha_nacimiento' => ['nullable', 'date'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'fotografia' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
        ]);

        // Crear usuario primero sin foto
        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cedula' => $request->cedula,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono' => $request->telefono,
            'fotografia' => null,
        ]);

        // Subir la foto si existe
        if ($request->hasFile('fotografia')) {
            $extension = $request->file('fotografia')->getClientOriginalExtension();
            // Usamos el ID del usuario y su nombre para el archivo
            $nombreArchivo = $user->id . '_' . preg_replace('/\s+/', '_', $user->name) . '.' . $extension;
            $rutaFoto = $request->file('fotografia')->storeAs('usuarios', $nombreArchivo, 'public');

            // Actualizar usuario con la ruta de la foto
            $user->fotografia = $rutaFoto;
            $user->save();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard'));
    }
}
