<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;

class RidePublicoController extends Controller
{
    public function index(Request $request)
    {
    $query = Ride::query();

    // Campo seleccionado (salida, llegada, dia)
    $campo = $request->get('campo');

    // Dirección (asc / desc)
    $direccion = $request->get('direccion', 'asc');

    // Si seleccionó un campo, se ordena por ese campo
    if ($campo) {
        $query->orderBy($campo, $direccion);
    }

    $rides = $query->get();

    return view('rides.publicos', compact('rides'));
    }

}
