<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Permitimos que el usuario autenticado pueda actualizar su perfil
    }

    public function rules(): array
    {
        $userId = $this->user()->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'cedula' => ['required', 'regex:/^[0-9]{9,}$/'],
            'telefono' => ['required', 'regex:/^[0-9]{8,}$/'],
            'fecha_nacimiento' => ['required', 'date', 'before:today'],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'fotografia' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'cedula.regex' => 'La cédula debe contener al menos 5 números.',
            'telefono.regex' => 'El teléfono debe contener al menos 8 números.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento no puede ser futura.',
            'fotografia.max' => 'La fotografía no debe superar los 2MB.',
            'fotografia.mimes' => 'Solo se permiten imágenes JPG, JPEG, PNG o GIF.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $fechaNacimiento = new \DateTime($this->fecha_nacimiento);
            $edad = (new \DateTime())->diff($fechaNacimiento)->y;
            $rol = strtolower($this->user()->rol);

            if (in_array($rol, ['chofer', 'administrador']) && $edad < 18) {
                $validator->errors()->add('fecha_nacimiento', "Debe tener al menos 18 años para registrarse como $rol.");
            }

            if ($rol === 'pasajero' && $edad < 15) {
                $validator->errors()->add('fecha_nacimiento', "Debe tener al menos 15 años para registrarse como pasajero.");
            }
        });
    }
}
