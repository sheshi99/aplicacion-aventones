<?php

namespace App\Http\Controllers\Chofer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Illuminate\Validation\Rule;


class VehiculoController extends Controller
{
  
    public function index()
    {
        $vehiculos = Vehiculo::where('id_chofer', auth()->id())->get();

        return view('vehiculos.index', compact('vehiculos'));
    }

    
    public function create()
    {
        return view('vehiculos.create');
    }

    private function reglasValidacion(Vehiculo $vehiculo = null)
    {
        return [
            'numero_placa' => [
                'required',
                'max:20',
                // Si se pasa un vehículo, ignoramos su propia placa en la validación unique
                Rule::unique('vehiculos', 'numero_placa')->ignore($vehiculo?->id_vehiculo, 
                            'id_vehiculo'),
            ],
            'color' => 'required|max:50',
            'marca' => 'required|max:50',
            'modelo' => 'required|max:50',
            'anno' => 'required|integer|min:1900|max:' . date('Y'),
            'capacidad_asientos' => 'required|integer|min:2|max:5',
            'fotografia' => $vehiculo 
            ? 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'  // edición: foto opcional
            : 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // creación: foto obligatoria
        ];
    }

    private function procesarFoto(Request $request, Vehiculo $vehiculo = null)
    {
        $foto = $vehiculo->fotografia ?? null;

        if ($request->hasFile('fotografia')) {
            $archivo = $request->file('fotografia');

            $nombreArchivo = preg_replace('/[^A-Za-z0-9]/', '', $request->numero_placa)
                            . '_' . preg_replace('/[^A-Za-z0-9]/', '', $request->marca)
                            . '_' . preg_replace('/[^A-Za-z0-9]/', '', $request->modelo)
                            . '.' . $archivo->getClientOriginalExtension();

            $ruta = $archivo->storeAs('vehiculos', $nombreArchivo, 'public');

            if ($ruta) {
                // Borrar foto anterior solo si existe y es diferente
                if ($vehiculo && $vehiculo->fotografia && 
                    \Storage::disk('public')->exists($vehiculo->fotografia)) {
                    \Storage::disk('public')->delete($vehiculo->fotografia);
                }
                $foto = $ruta;
            }
        }
        return $foto;
    }


    // Crear un vehículo
    public function store(Request $request)
    {
        $request->merge(['numero_placa' => strtoupper($request->numero_placa)]);

        $request->validate($this->reglasValidacion());

        $foto = $this->procesarFoto($request);

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

    // Formulario edición
    public function edit(Vehiculo $vehiculo)
    {
        return view('vehiculos.edit', compact('vehiculo'));
    }

    // Editar un vehículo
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->merge(['numero_placa' => strtoupper($request->numero_placa)]);

        $request->validate($this->reglasValidacion($vehiculo));

        $foto = $this->procesarFoto($request, $vehiculo ?? null);
        
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

    
    public function destroy(Vehiculo $vehiculo)
    {
        // Verificar si tiene rides asociados
        if ($vehiculo->rides()->count() > 0) {
            return redirect()->route('vehiculos.index')
                            ->with('error', 'No se puede eliminar este vehículo porque tiene rides asociados.');
        }

        // Borrar la foto si existe
        if ($vehiculo->fotografia && \Storage::disk('public')->exists($vehiculo->fotografia)) {
            \Storage::disk('public')->delete($vehiculo->fotografia);
        }

        // Borrar el vehículo
        $vehiculo->delete();

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado');
    }


}

