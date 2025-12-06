<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Ride;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservaController extends Controller
{

    // Acción del pasajero
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

    // Clasificación de las reservas
    private function clasificar($reservas)
    {
        $activas = [];
        $pasadas = [];
        $ahora = Carbon::now(); 

        foreach($reservas as $r) {
            // Convertimos la fecha y hora del ride a un objeto Carbon
            $fechaHora = Carbon::parse($r->ride->dia . ' ' . $r->ride->hora);

            if ($fechaHora->gte($ahora)) { // gte = mayor o igual
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

    // Mostrar las reservas del Pasajero
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

    // Acción de pasajero
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


    // Mostrar reservas del chofer
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

    // Acción del chofer
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


    // Acción del chofer
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

}
