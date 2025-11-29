<section>
    <header class="mb-4">
        <h2 class="h5 text-dark">{{ __('Editar Contraseña') }}</h2>

        <p class="text-muted">
            {{ __('Asegúrese de que su cuenta utilice una contraseña larga y aleatoria para mantener su seguridad.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        {{-- Contraseña actual --}}
        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">
                {{ __('Contraseña actual') }}
            </label>

            <input type="password"
                   id="update_password_current_password"
                   name="current_password"
                   class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                   autocomplete="current-password">

            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nueva contraseña --}}
        <div class="mb-3">
            <label for="update_password_password" class="form-label">
                {{ __('Nueva Contraseña') }}
            </label>

            <input type="password"
                   id="update_password_password"
                   name="password"
                   class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                   autocomplete="new-password">

            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirmar contraseña --}}
        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">
                {{ __('Confirmar Contraseña') }}
            </label>

            <input type="password"
                   id="update_password_password_confirmation"
                   name="password_confirmation"
                   class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                   autocomplete="new-password">

            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Botón --}}
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                {{ __('Guardar') }}
            </button>

            {{-- Mensaje de Guardado --}}
            @if (session('status') === 'password-updated')
                <div class="alert alert-success py-1 px-3 mb-0">
                    {{ __('Guardado.') }}
                </div>
            @endif
        </div>
    </form>
</section>
