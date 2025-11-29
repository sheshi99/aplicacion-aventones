<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;

class RidePublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Ride::query();

        // Filtros
        if ($request->salida) {
            $query->where('salida','LIKE',"%".$request->salida."%");
        }

        if ($request->llegada) {
            $query->where('llegada','LIKE',"%".$request->llegada."%");
        }

        // Ordenamiento
        if ($request->orden == 'fecha') {
            $query->orderBy('dia');
        } elseif ($request->orden == 'origen') {
            $query->orderBy('salida');
        } elseif ($request->orden == 'destino') {
            $query->orderBy('llegada');
        }

        $rides = $query->get();

        return view('publico.rides', compact('rides'));
    }
}
