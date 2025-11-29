<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="w-100" style="max-width: 480px;">
        @csrf

        <!-- Token oculto -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Correo -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Correo') }}</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   class="form-control" 
                   value="{{ old('email', $request->email) }}" 
                   required autofocus autocomplete="username">

            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Contraseña -->
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   class="form-control" 
                   required autocomplete="new-password">

            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirmar contraseña -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirmar Contraseña') }}</label>
            <input id="password_confirmation" 
                   type="password" 
                   name="password_confirmation" 
                   class="form-control" 
                   required autocomplete="new-password">

            @error('password_confirmation')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botón -->
        <div class="d-flex justify-content-end mt-4">
            <button class="btn btn-primary">
                {{ __('Restablecer Contraseña') }}
            </button>
        </div>
    </form>
</x-guest-layout>
