<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Información de perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Actualice la información del perfil de su cuenta.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        @if(session('success'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 font-medium text-sm text-red-600">
                {{ session('error') }}
            </div>
        @endif
        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Apellido -->
        <div>
            <x-input-label for="apellido" :value="__('Apellido')" />
            <x-text-input id="apellido" name="apellido" type="text" class="mt-1 block w-full" :value="old('apellido', $user->apellido)" required autocomplete="apellido" />
            <x-input-error class="mt-2" :messages="$errors->get('apellido')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Correo')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Cédula -->
        <div>
            <x-input-label for="cedula" :value="__('Cédula')" />
            <x-text-input id="cedula" name="cedula" type="text" class="mt-1 block w-full" :value="old('cedula', $user->cedula)" required autocomplete="cedula" />
            <x-input-error class="mt-2" :messages="$errors->get('cedula')" />
        </div>

        <!-- Teléfono -->
        <div>
            <x-input-label for="telefono" :value="__('Teléfono')" />
            <x-text-input id="telefono" name="telefono" type="text" class="mt-1 block w-full" :value="old('telefono', $user->telefono)" required autocomplete="telefono" />
            <x-input-error class="mt-2" :messages="$errors->get('telefono')" />
        </div>

        <!-- Fecha de nacimiento -->
        <div>
            <x-input-label for="fecha_nacimiento" :value="__('Fecha de nacimiento')" />
            <x-text-input id="fecha_nacimiento" name="fecha_nacimiento" type="date" class="mt-1 block w-full" :value="old('fecha_nacimiento', $user->fecha_nacimiento)" required />
            <x-input-error class="mt-2" :messages="$errors->get('fecha_nacimiento')" />
        </div>

        <!-- Fotografía -->
        <div>
            <x-input-label for="fotografia" :value="__('Fotografía (JPG, PNG, max 2MB)')" />
            <input id="fotografia" name="fotografia" type="file" class="mt-1 block w-full" accept=".jpg,.jpeg,.png" />
            <x-input-error class="mt-2" :messages="$errors->get('fotografia')" />
        </div>

        <!-- Botón Guardar -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Actualizar Perfil') }}</x-primary-button>
        </div>
    </form>
</section>
