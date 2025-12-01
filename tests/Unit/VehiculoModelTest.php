<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Vehiculo;
use App\Models\Ride;
use App\Models\User;

class VehiculoModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function vehiculo_pertenece_a_un_chofer()
    {
        $chofer = User::factory()->create(['rol' => 'chofer']);
        $vehiculo = Vehiculo::factory()->create(['id_chofer' => $chofer->id]);

        $this->assertInstanceOf(User::class, $vehiculo->chofer);
    }

    /** @test */
    public function vehiculo_tiene_rides_asociadas()
    {
        $vehiculo = Vehiculo::factory()->create();
        $ride = Ride::factory()->create(['id_vehiculo' => $vehiculo->id_vehiculo]);

        $this->assertTrue($vehiculo->rides->contains($ride));
    }
}
