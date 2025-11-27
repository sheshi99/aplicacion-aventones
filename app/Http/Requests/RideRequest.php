<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Vehiculo;
use App\Models\Ride;

class RideRequest extends FormRequest
{
   

    public function rules()
    {
        return [
            'id_vehiculo' => 'required|exists:vehiculos,id_vehiculo',
            'nombre'      => 'required',
            'salida'      => 'required',
            'llegada'     => 'required',
            'dia'         => 'required|date',
            'hora'        => 'required',
            'costo'       => 'required|numeric|min:0',
            'espacios'    => 'required|integer|min:1',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $vehiculo = Vehiculo::find($this->id_vehiculo);
            $idRide = $this->route('ride')->id_ride ?? null;

            // Validaciones extra
            if ($msg = $this->validarCapacidad($vehiculo, $this->espacios)) {
                $validator->errors()->add('espacios', $msg);
            }

            if ($msg = $this->validarChoqueHorario(
                $this->id_vehiculo, $this->dia, $this->hora, $idRide
            )) {
                $validator->errors()->add('hora', $msg);
            }

            if ($msg = $this->validarDiaHoraActual($this->dia, $this->hora)) {
                $validator->errors()->add('hora', $msg);
            }

            if ($msg = $this->validarSalidaLlegada($this->salida, $this->llegada)) {
                $validator->errors()->add('llegada', $msg);
            }
        });
    }

    // -------------------------
    // FUNCIONES INTERNAS AQUÍ
    // -------------------------

    private function validarCapacidad($vehiculo, $espacios)
    {
        if ($vehiculo && $espacios > $vehiculo->capacidad_asientos) {
            return "Los espacios superan la capacidad del vehículo.";
        }
        return null;
    }

    private function validarChoqueHorario($idVehiculo, $dia, $hora, $idRide = null)
    {
        $query = Ride::where('id_vehiculo', $idVehiculo)
                    ->where('dia', $dia)
                    ->where('hora', $hora);

        // Evitar conflicto al actualizar
        if ($idRide) {
            $query->where('id_ride', '!=', $idRide);
        }

        return $query->exists()
            ? "Este vehículo ya tiene un ride programado en esa fecha y hora."
            : null;
    }


    private function validarDiaHoraActual($dia, $hora)
    {
        $hoy = date('Y-m-d');
        $ahora = date('H:i');

        $diaNorm = date('Y-m-d', strtotime($dia));

        if ($diaNorm < $hoy) {
            return "El día del ride no puede ser anterior a hoy.";
        }

        if ($diaNorm == $hoy && $hora < $ahora) {
            return "La hora no puede ser menor a la hora actual.";
        }

        return null;
    }

    private function validarSalidaLlegada($salida, $llegada)
    {
        return $salida === $llegada
            ? "El lugar de salida no puede ser igual al de llegada."
            : null;
    }
}
