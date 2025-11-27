<x-guest-layout>

    @php
        // TRUE si un admin está usando la vista
        $modoAdmin = Auth::check() && Auth::user()->rol === 'admin';
    @endphp

    <form method="POST"
          action="{{ $modoAdmin ? route('admin.usuarios.store') : route('register') }}"
          enctype="multipart/form-data">

        @csrf

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text"
                          name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Apellido -->
        <div class="mt-4">
            <x-input-label for="apellido" :value="__('Apellido')" />
            <x-text-input id="apellido" class="block mt-1 w-full" type="text"
                          name="apellido" :value="old('apellido')" required />
            <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
        </div>

        <!-- Correo -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email"
                          name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password"
                          name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar contraseña -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                          name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Cédula -->
        <div class="mt-4">
            <x-input-label for="cedula" :value="__('Cédula')" />
            <x-text-input id="cedula" class="block mt-1 w-full" type="text"
                          name="cedula" :value="old('cedula')" />
            <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
        </div>

        <!-- Fecha -->
        <div class="mt-4">
            <x-input-label for="fecha_nacimiento" :value="__('Fecha de nacimiento')" />
            <x-text-input id="fecha_nacimiento" class="block mt-1 w-full"
                          type="date" name="fecha_nacimiento"
                          :value="old('fecha_nacimiento')" />
            <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
        </div>

        <!-- Teléfono -->
        <div class="mt-4">
            <x-input-label for="telefono" :value="__('Teléfono')" />
            <x-text-input id="telefono" class="block mt-1 w-full" type="text"
                          name="telefono" :value="old('telefono')" />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <!-- Fotografía -->
        <div class="mt-4">
            <x-input-label for="fotografia" :value="__('Fotografía')" />
            <x-text-input id="fotografia" class="block mt-1 w-full" type="file"
                          name="fotografia" />
            <x-input-error :messages="$errors->get('fotografia')" class="mt-2" />
        </div>

        <!-- Rol -->
        <div class="mt-4">
            <x-input-label for="rol" :value="__('Rol')" />

            <select id="rol" name="rol" class="block mt-1 w-full">

                @if($modoAdmin)
                    <!-- El administrador puede crear administradores -->
                    <option value="admin">Administrador</option>
                @else
                    <!-- Registro público -->
                    <option value="chofer">Chofer</option>
                    <option value="pasajero">Pasajero</option>
                @endif

            </select>

            <x-input-error :messages="$errors->get('rol')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>
