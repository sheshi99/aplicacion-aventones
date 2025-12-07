<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('admin.dashboard', compact('usuarios'));
    }

    public function createAdmin()
    {
        return view('auth.register', ['esAdmin' => true]);
    }


    public function storeAdmin(Request $request)
    {   
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cedula' => ['required', 'regex:/^[0-9]{9,}$/', 'unique:users,cedula'], 
            'fecha_nacimiento' => ['required', 'date', 'before:today'],
            'telefono' => ['required', 'regex:/^[0-9]{8,}$/'],
            'fotografia' => [
                'required',
                'file',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048'
            ],
        ],

        [
            'cedula.regex' => 'La cédula debe contener al menos 9 números.',
            'telefono.regex' => 'El teléfono debe contener al menos 8 números.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento no puede ser futura.',
            'fotografia.max' => 'La fotografía no debe superar los 2MB.',
            'fotografia.mimes' => 'Solo se permiten imágenes JPG, JPEG o PNG.',
        ]);


        // Calcular edad
        $fechaNacimiento = new \DateTime($request->fecha_nacimiento);
        $edad = (new \DateTime())->diff($fechaNacimiento)->y;

        // Validación mayor de edad
        if ($edad < 18) {
            return back()->withErrors([
                'fecha_nacimiento' => 'Debe tener al menos 18 años para registrarse como administrador.'
            ])->withInput();
        }

        // Crear usuario
        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cedula' => $request->cedula,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono' => $request->telefono,
            'rol' => 'admin',      
            'estado' => 'activo',  
            'token' => null        
        ]);

        // Guardar fotografía
        if ($request->hasFile('fotografia')) {

            $extension = $request->file('fotografia')->getClientOriginalExtension();

            $nombreArchivo =
                $user->id . '_' . preg_replace('/\s+/', '_', $user->name) . '.' . $extension;

            $rutaFoto = $request->file('fotografia')
                ->storeAs('usuarios', $nombreArchivo, 'public');

            $user->fotografia = $rutaFoto;
            $user->save();
        }

        return redirect()->route('admin.panel')->with('success', 'Administrador creado correctamente.');
    }


    public function cambiarEstado($id)
    {
        $superAdminId = 1; 
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

        // 3. Superadmin puede activar/desactivar a cualquier usuario
        if ($auth->id == $superAdminId) {

        if ($user->estado === 'inactivo' || $user->estado === 'pendiente') {
            $user->estado = 'activo';
        } else {
            $user->estado = 'inactivo';
        }

            $user->save();
            return back()->with('success', 'Estado del usuario actualizado correctamente.');
        }

        // 4. Admin normal no puede modificar a otros admins
        if ($auth->rol === 'admin') {

            if ($user->rol === 'admin') {
                return back()->with('error', 'No puedes desactivar o activar a otro administrador.');
            }

            if ($user->estado === 'inactivo' || $user->estado === 'pendiente') {
                $user->estado = 'activo';
            } else {
                $user->estado = 'inactivo';
            }


            $user->save();
            return back()->with('success', 'Estado del usuario actualizado correctamente.');
        }

        // 5. Usuarios normales NO pueden hacer nada
        return back()->with('error', 'No tienes permisos para cambiar estados.');
    }

}
