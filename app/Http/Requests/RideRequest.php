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
            'costo' => 'required|numeric|min:1500',
            'espacios'    => 'required|integer|min:1',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $vehiculo = Vehiculo::find($this->id_vehiculo);
            $idRide = $this->route('ride')->id_ride ?? null;

            // Validaciones extra
            if ($mensaje = $this->validarCapacidad($vehiculo, $this->espacios)) {
                $validator->errors()->add('espacios', $mensaje);
            }

            if ($mensaje = $this->validarChoqueHorario(
                $this->id_vehiculo, $this->dia, $this->hora, $idRide
            )) {
                $validator->errors()->add('hora', $mensaje);
            }

            if ($errorDia = $this->validarDia($this->dia)) {
                $validator->errors()->add('dia', $errorDia);
            }

            if ($errorHora = $this->validarHora($this->dia, $this->hora)) {
                $validator->errors()->add('hora', $errorHora);
            }

            if ($mensaje = $this->validarSalidaLlegada($this->salida, $this->llegada)) {
                $validator->errors()->add('llegada', $mensaje);
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


    private function validarDia($dia)
    {
        $hoy = date('Y-m-d');
        $diaNormalizado = date('Y-m-d', strtotime($dia));

        return $diaNormalizado < $hoy
            ? "El día del ride no puede ser anterior a hoy."
            : null;
    }
    
    private function validarHora($dia, $hora)
    {
        $hoy = date('Y-m-d');
        $ahora = date('H:i');

        $diaNormalizado = date('Y-m-d', strtotime($dia));

        if ($diaNormalizado == $hoy && $hora < $ahora) {
            return "La hora no puede ser menor a la hora actual.";
        }

        return null;
    }

    private function validarSalidaLlegada($lugarSalida, $lugarLlegada)
    {
        // Quitar espacios al inicio y final y pasar a minúsculas
        $salidaNormalizada = trim(mb_strtolower($lugarSalida));
        $llegadaNormalizada = trim(mb_strtolower($lugarLlegada));

        // Comparar
        return $salidaNormalizada === $llegadaNormalizada
            ? "El lugar de salida no puede ser igual al de llegada."
            : null;
    }

}
