<x-guest-layout>
    <!-- Mensaje introductorio -->
    <div class="mb-3 text-muted">
        ¿Olvidaste tu contraseña? No hay problema.
        Solo ingresa tu correo electrónico y te enviaremos un enlace para restablecerla.
    </div>

    <!-- Mensaje de estado (enviado correctamente) -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Correo -->
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input 
                type="email" 
                class="form-control @error('email') is-invalid @enderror"
                id="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus
            >

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Botón -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Enviar enlace de restablecimiento
            </button>
        </div>
    </form>
</x-guest-layout>
