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
use App\Mail\UsuarioRegistrado;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use resources\Http\Controllers\Auth\ActivationController;




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
            'cedula' => ['required', 'string', 'max:20'],
            'fecha_nacimiento' => ['required', 'date'],
            'telefono' => ['required', 'string', 'max:20'],
            'fotografia' => ['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
        ]);

        // Determinar rol automáticamente
        $rol = Auth::check() ? 'admin' : $request->input('rol', 'pasajero');

        // Generar token de activación solo si no es admin
        $token = $rol !== 'admin' ? Str::random(64) : null;

        // Crear usuario
        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cedula' => $request->cedula,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono' => $request->telefono,
            'rol' => $rol,
            'token_activacion' => $token,
            'estado' => $rol === 'admin' ? 'activo' : 'pendiente',
        ]);

        // Subir fotografía
        if ($request->hasFile('fotografia')) {
            $extension = $request->file('fotografia')->getClientOriginalExtension();
            $nombreArchivo = $user->id . '_' . preg_replace('/\s+/', '_', $user->name) . '.' . $extension;
            $rutaFoto = $request->file('fotografia')->storeAs('usuarios', $nombreArchivo, 'public');
            $user->fotografia = $rutaFoto;
            $user->save();
        }

        // Evento de registro
        event(new Registered($user));

        // Enviar email si no es admin
        if ($rol !== 'admin') {
            Mail::to($user->email)->send(new UsuarioRegistrado($user));
        }

        // Login solo si es admin (usuarios pendientes no pueden iniciar sesión)
        if ($rol === 'admin') {
            Auth::login($user);
        }

        return redirect()->route('dashboard')->with('success', 'Registro exitoso. Verifica tu email si no eres admin.');
    }
}
