<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class NotificacionController extends Controller
{
    // Mostrar formulario
    public function form()
    {
        return view('admin.notificar');
    }

    // Ejecutar el comando
    public function ejecutar(Request $request)
    {
        $request->validate([
        'minutos' => 'required|integer|min:1'
        ], [
            'minutos.required' => 'Debe ingresar la cantidad de minutos.',
            'minutos.integer'  => 'El valor debe ser un número válido.',
            'minutos.min'      => 'El valor debe ser mayor a 0.',
        ]);

        $minutos = $request->minutos;

        // Ejecutar comando de consola internamente
        Artisan::call("notificar:reservas $minutos");

        // Capturar la salida del comando
        $resultado = Artisan::output();

        return back()->with('resultado', $resultado);
    }
}
