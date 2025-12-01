<?php

namespace Database\Factories;

use App\Models\Reserva;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservaFactory extends Factory
{
    protected $model = Reserva::class;

    public function definition()
    {
        $ride = Ride::factory()->create();
        $pasajero = User::factory()->create(['rol' => 'pasajero']);

        return [
            'id_ride' => $ride->id_ride,
            'id_pasajero' => $pasajero->id,
            'estado' => 'pendiente', // o aceptada / rechazada según necesites
        ];
    }
}
