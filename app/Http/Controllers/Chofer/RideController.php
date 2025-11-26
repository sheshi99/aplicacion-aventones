<?php

namespace App\Http\Controllers\Chofer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RideController extends Controller
{
    
     public function index()
    {
        $rides = Ride::with('vehiculo', 'chofer')->get();
        return view('rides.index', compact('rides'));
    }

   
    public function create()
    {
        $vehiculos = Vehiculo::all();
        return view('rides.create', compact('vehiculos'));
    }


    public function store(Request $request)
    {
        $this->validarRide($request);

        $vehiculo = Vehiculo::find($request->id_vehiculo);

        Ride::create([
            'id_chofer'        => auth()->id(),
            'id_vehiculo'      => $request->id_vehiculo,
            'nombre'           => $request->nombre,
            'salida'           => $request->salida,
            'llegada'          => $request->llegada,
            'dia'              => $request->dia,
            'hora'             => $request->hora,
            'costo'            => $request->costo,
            'espacios'         => $request->espacios,

            // Snapshot del vehículo
            'vehiculo_placa'   => $vehiculo->numero_placa,
            'vehiculo_marca'   => $vehiculo->marca,
            'vehiculo_modelo'  => $vehiculo->modelo,
            'vehiculo_anio'    => $vehiculo->anno,
        ]);

        return redirect()->route('rides.index')
            ->with('success', 'Ride creado correctamente');
    }

    public function edit($id_ride)
    {
        $ride = Ride::findOrFail($id_ride);
        $vehiculos = Vehiculo::all();
        return view('rides.edit', compact('ride', 'vehiculos'));
    }

 
    public function update(Request $request, $id_ride)
    {
        $this->validarRide($request, $id_ride);

        $ride = Ride::findOrFail($id_ride);
        $vehiculo = Vehiculo::find($request->id_vehiculo);

        $ride->update([
            'id_vehiculo'     => $request->id_vehiculo,
            'nombre'          => $request->nombre,
            'salida'          => $request->salida,
            'llegada'         => $request->llegada,
            'dia'             => $request->dia,
            'hora'            => $request->hora,
            'costo'           => $request->costo,
            'espacios'        => $request->espacios,

            // Datos actualizados del vehículo
            'vehiculo_placa'  => $vehiculo->numero_placa,
            'vehiculo_marca'  => $vehiculo->marca,
            'vehiculo_modelo' => $vehiculo->modelo,
            'vehiculo_anio'   => $vehiculo->anno,
        ]);

        return redirect()->route('rides.index')
            ->with('success', 'Ride actualizado correctamente');
    }

    public function destroy($id_ride)
    {
        Ride::findOrFail($id_ride)->delete();

        return redirect()->route('rides.index')
            ->with('success', 'Ride eliminado');
    }



     // ============================================================
    // VALIDACIONES con Request::validate()
    // ============================================================
    private function validarRide(Request $request, $id_ride_actual = null)
    {
        $validated = $request->validate([
            'id_vehiculo' => ['required', 'exists:vehiculos,id_vehiculo'],
            'nombre'      => ['required', 'string', 'max:100'],
            'salida'      => ['required', 'string', 'max:100'],
            'llegada'     => ['required', 'string', 'max:100'],
            'dia'         => ['required', 'date'],
            'hora'        => ['required'],
            'costo'       => ['required', 'numeric', 'min:0.01'],
            'espacios'    => ['required', 'integer', 'min:1'],
        ]);

        // --------------------------------------------------------
        // Validaciones personalizadas con after()
        // --------------------------------------------------------
        $request->validate([], [], [])->after(function ($validator) use ($request, $id_ride_actual) {

            // 1️⃣ Salida y llegada no pueden ser iguales
            if ($request->salida === $request->llegada) {
                $validator->errors()->add('llegada', 'El lugar de llegada no puede ser igual al de salida.');
            }

            // 2️⃣ La fecha no puede ser anterior a hoy
            if ($request->dia < date('Y-m-d')) {
                $validator->errors()->add('dia', 'El día del ride no puede ser anterior a hoy.');
            }

            // 3️⃣ La hora no puede ser anterior si el día es hoy
            if ($request->dia == date('Y-m-d') && $request->hora < date('H:i')) {
                $validator->errors()->add('hora', 'La hora no puede ser anterior a la hora actual.');
            }

            // 4️⃣ Validar capacidad del vehículo
            $vehiculo = Vehiculo::find($request->id_vehiculo);
            if ($vehiculo && $request->espacios > $vehiculo->capacidad_asientos) {
                $validator->errors()->add('espacios', "El vehículo solo tiene {$vehiculo->capacidad_asientos} asientos.");
            }

            // 5️⃣ Validar si el vehículo está ocupado
            $ocupado = Ride::where('id_vehiculo', $request->id_vehiculo)
                ->where('dia', $request->dia)
                ->where('hora', $request->hora)
                ->when($id_ride_actual, fn($q) => $q->where('id_ride', '!=', $id_ride_actual))
                ->exists();

            if ($ocupado) {
                $validator->errors()->add('hora', 'El vehículo ya tiene un ride en esa fecha y hora.');
            }
        });

        // EJECUTAR VALIDACIONES
        $request->validate([]);
    }


}
