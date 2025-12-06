<section>
    <header class="mb-4">
        <h2 class="h5 text-dark">
            {{ __('Información de perfil') }}
        </h2>

        <p class="text-muted">
            {{ __("Actualice la información del perfil de su cuenta.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <x-mensaje />

        {{-- Nombre --}}
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" id="name" name="name" 
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}" required autofocus>

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Apellido --}}
        <div class="mb-3">
            <label for="apellido" class="form-label">{{ __('Apellido') }}</label>
            <input type="text" id="apellido" name="apellido"
                class="form-control @error('apellido') is-invalid @enderror"
                value="{{ old('apellido', $user->apellido) }}" required>

            @error('apellido')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Correo --}}
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Correo') }}</label>
            <input type="email" id="email" name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}" required>

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Cédula --}}
        <div class="mb-3">
            <label for="cedula" class="form-label">{{ __('Cédula') }}</label>
            <input type="text" id="cedula" name="cedula"
                class="form-control @error('cedula') is-invalid @enderror"
                value="{{ old('cedula', $user->cedula) }}" required>

            @error('cedula')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Teléfono --}}
        <div class="mb-3">
            <label for="telefono" class="form-label">{{ __('Teléfono') }}</label>
            <input type="text" id="telefono" name="telefono"
                class="form-control @error('telefono') is-invalid @enderror"
                value="{{ old('telefono', $user->telefono) }}" required>

            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Fecha nacimiento --}}
        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">{{ __('Fecha de nacimiento') }}</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                value="{{ old('fecha_nacimiento', $user->fecha_nacimiento) }}" required>

            @error('fecha_nacimiento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Fotografía --}}
        <div class="mb-3">
            <label for="fotografia" class="form-label">{{ __('Fotografía (JPG, PNG, max 2MB)') }}</label>
            
            {{-- Imagen actual --}}
            @if(!empty($user->fotografia))
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $user->fotografia) }}" 
                         alt="Foto de {{ $user->name }}" 
                         width="120" 
                         height="120" 
                         class="rounded-circle">
                </div>
            @endif

            {{-- Input para cambiar foto --}}
            <input type="file" id="fotografia" name="fotografia"
                   accept=".jpg,.jpeg,.png"
                   class="form-control @error('fotografia') is-invalid @enderror">

            @error('fotografia')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Botón --}}
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">
                {{ __('Actualizar Perfil') }}
            </button>
        </div>

    </form>
</section>
