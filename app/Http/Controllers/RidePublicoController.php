<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;

class RidePublicoController extends Controller
{
   
    public function index(Request $request)
    {
        $now = date('Y-m-d H:i:s'); // fecha y hora actual

        $query = Ride::whereRaw("CONCAT(dia, ' ', hora) >= ?", [$now]);

        // FILTRO: LUGAR DE SALIDA
        if ($request->filled('salida')) {
            $query->where('salida', 'LIKE', '%' . $request->salida . '%');
        }

        // FILTRO: LUGAR DE LLEGADA
        if ($request->filled('llegada')) {
            $query->where('llegada', 'LIKE', '%' . $request->llegada . '%');
        }

        // ORDENAR
        $campo = $request->get('campo');
        $direccion = $request->get('direccion', 'asc');

        if ($campo) {
            $query->orderBy($campo, $direccion);
        }

        // Obtener resultados
        $rides = $query->get();

        return view('rides.publicos', compact('rides'));
    }

    public function intento($id)
    {
        // 1. Validar login
        if (!auth()->check()) {
            return back()->with('error', 'Debes iniciar sesión para reservar un ride.');
        }

        // 2. Validar rol pasajero
        if (auth()->user()->rol !== 'pasajero') {
            return back()->with('error', 'Solo los usuarios con rol PASAJERO pueden reservar rides.');
        }

        // 3. Si pasa validaciones, redirigimos al controlador correcto
        return redirect()->route('reservas.store', $id);
    }



}
