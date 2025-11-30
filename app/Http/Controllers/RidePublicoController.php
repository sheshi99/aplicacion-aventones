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


}
