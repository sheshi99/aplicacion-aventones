<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Ride;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReservaController extends Controller
{

    // Acciones Pasajero 
 
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


    private function clasificar($reservas)
    {
        $activas = [];
        $pasadas = [];
        $now = now()->format('Y-m-d H:i:s');

        foreach($reservas as $r) {
            $fechaHora = $r->ride->dia . ' ' . $r->ride->hora;

            if ($fechaHora >= $now) {
                $activas[] = $r;
            } else {
                // Si estaba aceptada y ya pasó, marcar como realizado
                if ($r->estado === 'aceptada') {
                    $r->estado = 'realizado';
                }
                $pasadas[] = $r;
            }
        }

        return ['activas' => $activas, 'pasadas' => $pasadas];
    }


    public function reservasPasajero()
    {
        $reservas = Reserva::with(['ride','ride.chofer'])
            ->where('id_pasajero', Auth::id())
            ->orderBy('id_reserva','desc')
            ->get();

        $clasificadas = $this->clasificar($reservas);

        return view('reservas.pasajero', [
            'activas' => $clasificadas['activas'],
            'pasadas' => $clasificadas['pasadas']
        ]);
    }


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


    // Acciones chofer

    public function reservasChofer()
    {
        $reservas = Reserva::whereHas('ride', function($q){
            $q->where('id_chofer', Auth::id());
        })
        ->with(['ride', 'pasajero'])
        ->orderBy('id_reserva', 'desc')
        ->get();

        $clasificadas = $this->clasificar($reservas);

        return view('reservas.chofer', [
            'activas' => $clasificadas['activas'],
            'pasadas' => $clasificadas['pasadas']
        ]);
    }


    public function aceptar($id)
    {
        $reserva = Reserva::findOrFail($id);
        $ride = $reserva->ride;

        if ($ride->id_chofer != auth()->id()) {
            abort(403);
        }

        // No permitir aceptar reservas canceladas
        if ($reserva->estado === 'cancelada') {
            return back()->with('error', 'No se puede aceptar una reserva cancelada 
                                por el pasajero.');
        }

        // Validar cupos solo si la reserva no estaba aceptada
        if ($reserva->estado !== 'aceptada' && $ride->espacios <= 0) {
            return back()->with('error', 'No hay cupos disponibles.');
        }

        // Si estaba rechazada y ahora acepta, descontar cupo
        if ($reserva->estado !== 'aceptada') {
            $ride->espacios -= 1;
            $ride->save();
        }

        // Cambiar estado a aceptada
        $reserva->estado = 'aceptada';
        $reserva->save();

        return back()->with('success', 'Reserva aceptada.');
    }



    public function rechazar($id)
    {
        $reserva = Reserva::findOrFail($id);
        $ride = $reserva->ride;

        if ($ride->id_chofer != auth()->id()) {
            abort(403);
        }

         // No permitir rechazar reservas canceladas
        if ($reserva->estado === 'cancelada') {
            return back()->with('error', 'No se puede rechazar una reserva cancelada 
                                por el pasajero.');
        }

        // Si estaba aceptada, devolver el cupo
        if ($reserva->estado === 'aceptada') {
            $ride->espacios += 1;
            $ride->save();
        }

        $reserva->estado = 'rechazada';
        $reserva->save();

        return back()->with('success', 'Reserva rechazada.');
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
