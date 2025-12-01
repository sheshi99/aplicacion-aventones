<?php

namespace Database\Factories;

use App\Models\Vehiculo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehiculoFactory extends Factory
{
    protected $model = Vehiculo::class;

    public function definition()
    {
        return [
            'id_chofer' => User::factory()->create(['rol' => 'chofer'])->id,
            'numero_placa' => strtoupper($this->faker->unique()->bothify('???###')),
            'color' => $this->faker->safeColorName(),
            'marca' => $this->faker->company(),
            'modelo' => $this->faker->word(),
            'anno' => $this->faker->numberBetween(2000, date('Y')),
            'capacidad_asientos' => $this->faker->numberBetween(5, 7),
            'fotografia' => null, // No se sube imagen
        ];
    }
}
