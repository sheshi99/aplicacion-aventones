<x-guest-layout>

    <x-mensaje />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- EMAIL --}}
        <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   class="form-control @error('email') is-invalid @enderror">

            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- PASSWORD --}}
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input id="password"
                   type="password"
                   name="password"
                   required
                   class="form-control @error('password') is-invalid @enderror">

            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- REMEMBER --}}
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
            <label class="form-check-label" for="remember_me">
                Recordar
            </label>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">

        <div class="d-flex align-items-center gap-3">
                @if (Route::has('password.request'))
                    <a class="btn btn-link p-0 text-decoration-none small" href="{{ route('password.request') }}">
                        ¿Olvidó su contraseña?
                    </a>
                @endif

                <a class="btn btn-link p-0 text-decoration-none small" href="{{ route('register') }}">
                    ¿No tienes una cuenta?
                </a>
            </div>

            <button type="submit" class="btn btn-primary">
                Ingresar
            </button>

        </div>
    </form>

</x-guest-layout>
