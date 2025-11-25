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
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cedula' => ['required', 'regex:/^[0-9]{9,}$/'],
            'fecha_nacimiento' => ['required', 'date', 'before:today'],
            'telefono' => ['required', 'regex:/^[0-9]{8,}$/'],
            'fotografia' => [
                'required',
                'file',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048' 
            ],
        ], [
            'cedula.regex' => 'La cédula debe contener al menos 9 números.',
            'telefono.regex' => 'El teléfono debe contener al menos 8 números.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento no puede ser futura.',
            'fotografia.max' => 'La fotografía no debe superar los 2MB.',
            'fotografia.mimes' => 'Solo se permiten imágenes JPG, JPEG o PNG.',
        ]);

        // VALIDACIÓN DE EDAD SEGÚN ROL
        $fechaNacimiento = new \DateTime($request->fecha_nacimiento);
        $edad = (new \DateTime())->diff($fechaNacimiento)->y;

        $rol = $request->input('rol', 'pasajero');

        if (in_array($rol, ['chofer', 'admin']) && $edad < 18) {
            return back()->withErrors([
                'fecha_nacimiento' => 'Debe tener al menos 18 años para registrarse como ' . $rol
            ])->withInput();
        }

        if ($rol === 'pasajero' && $edad < 15) {
            return back()->withErrors([
                'fecha_nacimiento' => 'Debe tener al menos 15 años para registrarse como pasajero'
            ])->withInput();
        }
        // CREAR USUARIO
        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cedula' => $request->cedula,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono' => $request->telefono,
            'rol' => $rol,
            'estado' => $rol === 'admin' ? 'activo' : 'pendiente',
            'token_activacion' => $rol === 'admin' ? null : Str::random(64),
        ]);

        if ($request->hasFile('fotografia')) {

            $extension = $request->file('fotografia')->getClientOriginalExtension();
            $nombreArchivo =
                $user->id . '_' . preg_replace('/\s+/', '_', $user->name) . '.' . $extension;
            $rutaFoto = $request->file('fotografia')
                ->storeAs('usuarios', $nombreArchivo, 'public');
            $user->fotografia = $rutaFoto;
            $user->save();
        }
        // ENVIAR EMAIL SI NO ES ADMIN
        if ($rol !== 'admin') {
            Mail::to($user->email)->send(new UsuarioRegistrado($user));
        }
        // INICIAR SESIÓN SI ES ADMIN
        if ($rol === 'admin') {
            Auth::login($user);
        }
        return redirect()->route('login')
            ->with('success', 'Registro exitoso. Revisa tu correo para activar tu cuenta.');
    }
}
