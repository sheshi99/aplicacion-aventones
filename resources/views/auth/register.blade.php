<x-guest-layout>

    @php
        $modoAdmin = Auth::check() && Auth::user()->rol === 'admin';
    @endphp

    {{-- MENSAJES DE VALIDACIÓN GLOBAL --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Por favor revise los campos marcados.</strong>
        </div>
    @endif

    <form method="POST"
        action="{{ $modoAdmin ? route('admin.usuarios.store') : route('register') }}"
        enctype="multipart/form-data"
        class="mt-3">

        @csrf

        {{-- NOMBRE --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   id="name"
                   name="name"
                   value="{{ old('name') }}"
                   required>

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- APELLIDO --}}
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text"
                   class="form-control @error('apellido') is-invalid @enderror"
                   id="apellido"
                   name="apellido"
                   value="{{ old('apellido') }}"
                   required>

            @error('apellido')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- CORREO --}}
        <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   id="email"
                   name="email"
                   value="{{ old('email') }}"
                   required>

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- CONTRASEÑA --}}
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   id="password"
                   name="password"
                   required>

            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- CONFIRMAR CONTRASEÑA --}}
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   id="password_confirmation"
                   name="password_confirmation"
                   required>

            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- CÉDULA --}}
        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text"
                   class="form-control @error('cedula') is-invalid @enderror"
                   id="cedula"
                   name="cedula"
                   value="{{ old('cedula') }}">

            @error('cedula')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- FECHA NACIMIENTO --}}
        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
            <input type="date"
                   class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                   id="fecha_nacimiento"
                   name="fecha_nacimiento"
                   value="{{ old('fecha_nacimiento') }}">

            @error('fecha_nacimiento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- TELÉFONO --}}
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text"
                   class="form-control @error('telefono') is-invalid @enderror"
                   id="telefono"
                   name="telefono"
                   value="{{ old('telefono') }}">

            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- FOTOGRAFÍA --}}
        <div class="mb-3">
            <label for="fotografia" class="form-label">Fotografía</label>
            <input type="file"
                   class="form-control @error('fotografia') is-invalid @enderror"
                   id="fotografia"
                   name="fotografia">

            @error('fotografia')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- ROL --}}
        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>

            <select class="form-select @error('rol') is-invalid @enderror"
                    id="rol"
                    name="rol">

                @if($modoAdmin)
                    <option value="admin">Administrador</option>
                @endif

                <option value="chofer">Chofer</option>
                <option value="pasajero">Pasajero</option>

            </select>

            @error('rol')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- BOTÓN REGISTRAR --}}
        <button type="submit" class="btn btn-primary w-100 mt-3">
            Registrar
        </button>

    </form>

</x-guest-layout>
