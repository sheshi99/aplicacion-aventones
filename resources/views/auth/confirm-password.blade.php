<x-guest-layout>
    <!-- Mensaje principal -->
    <div class="mb-3 text-muted">
        Esta es un área segura de la aplicación. Por favor confirma tu contraseña antes de continuar.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Contraseña -->
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>

            <input 
                type="password"
                id="password"
                name="password"
                required
                autocomplete="current-password"
                class="form-control @error('password') is-invalid @enderror"
            >

            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Botón -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Confirmar
            </button>
        </div>
    </form>
</x-guest-layout>
