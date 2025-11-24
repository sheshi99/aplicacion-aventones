<?php

return [

    'accepted'             => 'El campo :attribute debe ser aceptado.',
    'accepted_if'          => 'El campo :attribute debe ser aceptado cuando :other sea :value.',
    'active_url'           => 'El campo :attribute no es una URL válida.',
    'after'                => 'El campo :attribute debe ser una fecha posterior a :date.',
    'after_or_equal'       => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
    'alpha'                => 'El campo :attribute solo debe contener letras.',
    'alpha_dash'           => 'El campo :attribute solo debe contener letras, números, guiones y guiones bajos.',
    'alpha_num'            => 'El campo :attribute solo debe contener letras y números.',
    'array'                => 'El campo :attribute debe ser un arreglo.',
    'ascii'                => 'El campo :attribute solo debe contener caracteres alfanuméricos y símbolos de un solo byte.',
    'before'               => 'El campo :attribute debe ser una fecha anterior a :date.',
    'before_or_equal'      => 'El campo :attribute debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'array'   => 'El campo :attribute debe tener entre :min y :max elementos.',
        'file'    => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
        'numeric' => 'El campo :attribute debe estar entre :min y :max.',
        'string'  => 'El campo :attribute debe contener entre :min y :max caracteres.',
    ],
    'boolean'              => 'El campo :attribute debe ser verdadero o falso.',
    'can'                  => 'El campo :attribute tiene un valor no autorizado.',
    'confirmed'            => 'La confirmación de :attribute no coincide.',
    'current_password'     => 'La contraseña actual es incorrecta.',
    'date'                 => 'El campo :attribute no es una fecha válida.',
    'date_equals'          => 'El campo :attribute debe ser una fecha igual a :date.',
    'date_format'          => 'El campo :attribute no coincide con el formato :format.',
    'decimal'              => 'El campo :attribute debe tener :decimal lugares decimales.',
    'declined'             => 'El campo :attribute debe ser rechazado.',
    'declined_if'          => 'El campo :attribute debe ser rechazado cuando :other sea :value.',
    'different'            => 'El campo :attribute y :other deben ser diferentes.',
    'digits'               => 'El campo :attribute debe tener :digits dígitos.',
    'digits_between'       => 'El campo :attribute debe tener entre :min y :max dígitos.',
    'dimensions'           => 'El campo :attribute tiene dimensiones de imagen inválidas.',
    'distinct'             => 'El campo :attribute tiene un valor duplicado.',
    'doesnt_end_with'      => 'El campo :attribute no debe terminar con: :values.',
    'doesnt_start_with'    => 'El campo :attribute no debe comenzar con: :values.',
    'email'                => 'El campo :attribute debe ser un correo electrónico válido.',
    'ends_with'            => 'El campo :attribute debe finalizar con uno de los siguientes valores: :values.',
    'enum'                 => 'El :attribute seleccionado es inválido.',
    'exists'               => 'El :attribute seleccionado es inválido.',
    'file'                 => 'El campo :attribute debe ser un archivo.',
    'filled'               => 'El campo :attribute debe tener un valor.',
    'gt'                   => [
        'array'   => 'El campo :attribute debe tener más de :value elementos.',
        'file'    => 'El archivo :attribute debe pesar más de :value kilobytes.',
        'numeric' => 'El campo :attribute debe ser mayor a :value.',
        'string'  => 'El campo :attribute debe contener más de :value caracteres.',
    ],
    'gte'                  => [
        'array'   => 'El campo :attribute debe tener :value elementos o más.',
        'file'    => 'El archivo :attribute debe pesar :value kilobytes o más.',
        'numeric' => 'El campo :attribute debe ser mayor o igual a :value.',
        'string'  => 'El campo :attribute debe contener :value caracteres o más.',
    ],
    'image'                => 'El campo :attribute debe ser una imagen.',
    'in'                   => 'El :attribute seleccionado es inválido.',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => 'El campo :attribute debe ser un número entero.',
    'ip'                   => 'El campo :attribute debe ser una dirección IP válida.',
    'ipv4'                 => 'El campo :attribute debe ser una dirección IPv4 válida.',
    'ipv6'                 => 'El campo :attribute debe ser una dirección IPv6 válida.',
    'json'                 => 'El campo :attribute debe ser una cadena JSON válida.',

        'required' => 'El campo :attribute es obligatorio.',
    'unique' => 'El campo :attribute ya está registrado.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'max' => [
        'string'  => 'El campo :attribute no debe tener más de :max caracteres.',
        'numeric' => 'El campo :attribute no puede ser mayor a :max.',  // para año y capacidad
    ],

    'min' => [
        'string'  => 'El campo :attribute debe tener al menos :min caracteres.',
        'numeric' => 'El campo :attribute no puede ser menor a :min.',  // para año y capacidad
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom validation attributes
    |--------------------------------------------------------------------------
    | Aquí puedes renombrar los campos para que el error no diga "email",
    | sino "correo", etc.
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'name' => 'nombre',
        'apellido' => 'apellido',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'password_confirmation' => 'confirmación de contraseña',
        'cedula' => 'cédula',
        'fecha_nacimiento' => 'fecha de nacimiento',
        'telefono' => 'teléfono',
        'fotografia' => 'fotografía',
        'rol' => 'rol',
        'anno' => 'año',
    ],
];
