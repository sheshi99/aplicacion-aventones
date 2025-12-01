<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Ride;
use App\Models\Vehiculo;
use App\Models\User;
use App\Models\Reserva;

class RideModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ride_pertenece_a_un_vehiculo()
    {
        $vehiculo = Vehiculo::factory()->create();
        $ride = Ride::factory()->create(['id_vehiculo' => $vehiculo->id_vehiculo]);

        $this->assertInstanceOf(Vehiculo::class, $ride->vehiculo);
        $this->assertEquals($vehiculo->id_vehiculo, $ride->vehiculo->id_vehiculo);
    }

    /** @test */
    public function ride_tiene_reservas_asociadas()
    {
        $ride = Ride::factory()->create();
        $pasajero = User::factory()->create(['rol' => 'pasajero']);
        $reserva = Reserva::factory()->create([
            'id_ride' => $ride->id_ride,
            'id_pasajero' => $pasajero->id
        ]);

        $this->assertTrue($ride->reservas->contains($reserva));
    }
}
