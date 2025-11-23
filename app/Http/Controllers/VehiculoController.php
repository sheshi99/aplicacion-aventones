<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    // LISTAR TODOS LOS VEHÍCULOS DEL CHOFER
    public function index()
    {
        $vehiculos = Vehiculo::where('id_chofer', auth()->id())->get();

        return view('vehiculos.index', compact('vehiculos'));
    }

    // FORMULARIO CREAR
    public function create()
    {
        return view('vehiculos.create');
    }

     // GUARDAR EN BD
    public function store(Request $request)
    {
        $request->validate([
            'numero_placa' => 'required|max:20',
            'color' => 'required|max:50',
            'marca' => 'required|max:50',
            'modelo' => 'required|max:50',
            'anno' => 'required|integer|min:1900|max:' . date('Y'),
            'capacidad_asientos' => 'required|integer|min:1|max:60',
            'fotografia' => 'nullable|image|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('fotografia')) {
            $foto = $request->file('fotografia')->store('vehiculos', 'public');
        }

        Vehiculo::create([
            'id_chofer' => auth()->id(),
            'numero_placa' => $request->numero_placa,
            'color' => $request->color,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'anno' => $request->anno,
            'capacidad_asientos' => $request->capacidad_asientos,
            'fotografia' => $foto
        ]);

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo creado');
    }

    // FORMULARIO EDITAR
    public function edit(Vehiculo $vehiculo)
    {
        return view('vehiculos.edit', compact('vehiculo'));
    }

    // ACTUALIZAR
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->validate([
            'numero_placa' => 'required|max:20',
            'color' => 'required|max:50',
            'marca' => 'required|max:50',
            'modelo' => 'required|max:50',
            'anno' => 'required|integer|min:1900|max:' . date('Y'),
            'capacidad_asientos' => 'required|integer|min:1|max:60',
            'fotografia' => 'nullable|image|max:2048',
        ]);

        $foto = $vehiculo->fotografia;

        if ($request->hasFile('fotografia')) {
            $foto = $request->file('fotografia')->store('vehiculos', 'public');
        }

        $vehiculo->update([
            'numero_placa' => $request->numero_placa,
            'color' => $request->color,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'anno' => $request->anno,
            'capacidad_asientos' => $request->capacidad_asientos,
            'fotografia' => $foto
        ]);

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado');
    }

    // ELIMINAR
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado');
    }
}

