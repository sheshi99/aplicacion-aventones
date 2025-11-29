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
            'id_pasajero' => Auth::id(),
            'estado' => 'pendiente'
        ]);

        return redirect()->back()->with('success','Reserva enviada');
    }

    // Pasajero cancela
    public function cancelar($id)
    {
        $reserva = Reserva::findOrFail($id);

        if ($reserva->id_pasajero != auth()->id()) {
            abort(403);
        }

        if (!in_array($reserva->estado, ['pendiente', 'aceptada'])) {
            return back()->with('error', 'Esta reserva no se puede cancelar.');
        }

        // Si la reserva estaba aceptada → devolver cupo
        if ($reserva->estado == 'aceptada') {
            $ride = $reserva->ride;
            $ride->espacios += 1;
            $ride->save();
        }

        // Cambiar estado
        $reserva->estado = 'cancelada';
        $reserva->save();

        return back()->with('success', 'Reserva cancelada.');
    }

    public function reservasChofer()
    {
      
        $reservas = Reserva::whereHas('ride', function($query){
            $query->where('id_chofer', Auth::id());
        })
        ->with(['ride', 'pasajero']) // Cargar el ride y el pasajero para usarlos en la vista
        ->orderBy('created_at', 'desc') // Ordenar por la más reciente
        ->get();

        return view('reservas.chofer', compact('reservas'));
    }


    // Chofer acepta
    public function aceptar($id)
    {
        $reserva = Reserva::findOrFail($id);
        $ride = $reserva->ride;

        // solo chofer dueño del ride puede aceptar
        if ($ride->id_chofer != auth()->id()) {
            abort(403);
        }

        // validar estado
        if ($reserva->estado != 'pendiente') {
            return back()->with('error', 'Esta reserva no está pendiente.');
        }

        // validar cupos
        if ($ride->espacios <= 0) {
            return back()->with('error', 'No hay cupos disponibles.');
        }

        // Descontar cupo  
        $ride->espacios -= 1;
        $ride->save();

        // Cambiar estado
        $reserva->estado = 'aceptada';
        $reserva->save();

        return back()->with('success', 'Reserva aceptada.');
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

        return redirect()->back()->with('success','Reserva rechazada');
    }

    // Ver reservas activas (pasajero o chofer)
    public function activas()
    {
        $reservas = Reserva::where('id_pasajero', Auth::id())
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
        $reservas = Reserva::where('id_pasajero', Auth::id())
            ->orWhereHas('ride', function($q){
                $q->where('id_chofer', Auth::id());
            })
            ->whereIn('estado',['cancelada','rechazada'])
            ->get();

        return view('reservas.historico', compact('reservas'));
    }
}
