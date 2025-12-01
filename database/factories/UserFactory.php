<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'cedula' => $this->faker->numerify('#########'),
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->numerify('########'),
            'fecha_nacimiento' => $this->faker->date('Y-m-d'),

            // ENUM válido
            'estado' => 'activo',

            'token_activacion' => Str::random(40),
            'email_verified_at' => now(),

            // Se asigna dentro de cada test (admin/chofer/pasajero)
            'rol' => 'pasajero',

            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
