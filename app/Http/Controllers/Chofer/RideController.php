<?php

namespace App\Http\Controllers\Chofer;

use App\Http\Controllers\Controller;
use App\Http\Requests\RideRequest;
use App\Models\Ride;
use App\Models\Vehiculo;

class RideController extends Controller
{
    public function index()
    {
        $rides = Ride::with('vehiculo', 'chofer')->get();
        return view('rides.index', compact('rides'));
    }

    public function create()
    {
        $vehiculos = Vehiculo::where('id_chofer', auth()->id())->get();
        return view('rides.create', compact('vehiculos'));
    }


    public function store(RideRequest $request)
    {
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
            'vehiculo_placa'   => $vehiculo->numero_placa ?? null,
            'vehiculo_marca'   => $vehiculo->marca ?? null,
            'vehiculo_modelo'  => $vehiculo->modelo ?? null,
            'vehiculo_anio'    => $vehiculo->anno ?? null,
        ]);

        return redirect()->route('rides.index')
            ->with('success', 'Ride creado correctamente');
    }

    public function edit(Ride $ride)
    {
        $vehiculos = Vehiculo::where('id_chofer', auth()->id())->get();
        return view('rides.edit', compact('ride', 'vehiculos'));
    }


    public function update(RideRequest $request, Ride $ride)
    {
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
            'vehiculo_placa'  => $vehiculo->numero_placa ?? null,
            'vehiculo_marca'  => $vehiculo->marca ?? null,
            'vehiculo_modelo' => $vehiculo->modelo ?? null,
            'vehiculo_anio'   => $vehiculo->anno ?? null,
        ]);

        return redirect()->route('rides.index')
            ->with('success', 'Ride actualizado correctamente');
    }


    public function destroy(Ride $ride)
    {
        $ride->delete();
        return redirect()->route('rides.index')->with('success', 'Ride eliminado');
    }

}
