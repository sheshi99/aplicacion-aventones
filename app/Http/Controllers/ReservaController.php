<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Ride;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    // Pasajero crea reserva
    public function store(Request $request, $id_ride)
    {
        $ride = Ride::findOrFail($id_ride);

        // Crear reserva
        Reserva::create([
            'id_ride' => $id_ride,
            'id_usuario' => Auth::id(),
            'estado' => 'pendiente'
        ]);

        return redirect()->back()->with('ok','Reserva enviada');
    }

    // Pasajero cancela
    public function cancelar($id)
    {
        $reserva = Reserva::findOrFail($id);

        // Solo pasajero puede cancelar su propia reserva
        if ($reserva->id_usuario != Auth::id()) {
            abort(403);
        }

        $reserva->estado = 'cancelada';
        $reserva->save();

        return redirect()->back()->with('ok','Reserva cancelada');
    }

    // Chofer acepta
    public function aceptar($id)
    {
        $reserva = Reserva::findOrFail($id);

        // Validar que el chofer dueño del ride sea el que acepta
        if ($reserva->ride->id_chofer != Auth::id()) {
            abort(403);
        }

        $reserva->estado = 'aceptada';
        $reserva->save();

        return redirect()->back()->with('ok','Reserva aceptada');
    }

    // Chofer rechaza
    public function rechazar($id)
    {
        $reserva = Reserva::findOrFail($id);

        if ($reserva->ride->id_chofer != Auth::id()) {
            abort(403);
        }

        $reserva->estado = 'rechazada';
        $reserva->save();

        return redirect()->back()->with('ok','Reserva rechazada');
    }

    // Ver reservas activas (pasajero o chofer)
    public function activas()
    {
        $reservas = Reserva::where('id_usuario', Auth::id())
            ->orWhereHas('ride', function($q){
                $q->where('id_chofer', Auth::id());
            })
            ->whereIn('estado',['pendiente','aceptada'])
            ->get();

        return view('reservas.activas', compact('reservas'));
    }

    // Histórico
    public function historico()
    {
        $reservas = Reserva::where('id_usuario', Auth::id())
            ->orWhereHas('ride', function($q){
                $q->where('id_chofer', Auth::id());
            })
            ->whereIn('estado',['cancelada','rechazada'])
            ->get();

        return view('reservas.historico', compact('reservas'));
    }
}
