<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Reserva;
use App\Models\User;
use App\Models\Ride;

class ReservaModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function reserva_pertenece_a_un_ride()
    {
        $ride = Ride::factory()->create();
        $reserva = Reserva::factory()->create(['id_ride' => $ride->id_ride]);

        $this->assertInstanceOf(Ride::class, $reserva->ride);
    }

    /** @test */
    public function reserva_pertenece_a_un_pasajero()
    {
        $pasajero = User::factory()->create(['rol' => 'pasajero']);
        $reserva = Reserva::factory()->create(['id_pasajero' => $pasajero->id]);

        $this->assertInstanceOf(User::class, $reserva->pasajero);
    }
}
