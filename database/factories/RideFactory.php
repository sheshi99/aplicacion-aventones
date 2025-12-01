<?php

namespace Database\Factories;

use App\Models\Ride;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Database\Eloquent\Factories\Factory;

class RideFactory extends Factory
{
    protected $model = Ride::class;

    public function definition()
    {
        $vehiculo = Vehiculo::factory()->create();

        return [
            'id_chofer' => $vehiculo->id_chofer,
            'id_vehiculo' => $vehiculo->id_vehiculo,
            'nombre' => $this->faker->sentence(3),
            'salida' => $this->faker->city(),
            'llegada' => $this->faker->city(),
            'dia' => $this->faker->dayOfWeek(),
            'hora' => $this->faker->time(),
            'costo' => $this->faker->numberBetween(1000, 5000),
            'espacios' => $vehiculo->capacidad_asientos,
            'vehiculo_placa' => $vehiculo->numero_placa,
            'vehiculo_marca' => $vehiculo->marca,
            'vehiculo_modelo' => $vehiculo->modelo,
            'vehiculo_anio' => $vehiculo->anno,
        ];
    }
}
