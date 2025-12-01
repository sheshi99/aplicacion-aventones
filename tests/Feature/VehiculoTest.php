<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile; // 👈 CORRECTO

class VehiculoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function chofer_puede_ver_lista_de_vehiculos()
    {
        $chofer = User::factory()->create(['rol' => 'chofer']);

        $this->actingAs($chofer)
            ->get('/vehiculos')
            ->assertStatus(200);
    }

    /** @test */
    public function chofer_puede_crear_vehiculo()
    {
        $chofer = User::factory()->create(['rol' => 'chofer']);

        $data = [
            'numero_placa' => 'ABC123',
            'color' => 'Rojo',
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            'anno' => 2020,
            'capacidad_asientos' => 5,
            'fotografia' => UploadedFile::fake()->create('vehiculo.jpg'),
        ];

        $response = $this->actingAs($chofer)
                         ->post('/vehiculos', $data);

        $response->assertRedirect(route('vehiculos.index'));

        $this->assertDatabaseHas('vehiculos', [
            'id_chofer' => $chofer->id,
            'numero_placa' => 'ABC123',
            'color' => 'Rojo',
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            'anno' => 2020,
            'capacidad_asientos' => 5,
        ]);
    }
}
