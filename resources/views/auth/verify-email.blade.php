<x-guest-layout>

    {{-- Mensaje principal --}}
    <div class="mb-3 text-muted">
        {{ __('Gracias por registrarte. Antes de comenzar, 
            por favor verifica tu correo electrónico haciendo clic en el enlace que te enviamos. 
            Si no recibiste el correo, con gusto te enviaremos otro.') }}
    </div>

    {{-- Mensaje de "correo enviado" --}}
    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success py-2">
            {{ __('Se ha enviado un nuevo enlace de verificación al correo electrónico que proporcionaste durante el registro.') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mt-4">

        {{-- Botón para reenviar correo --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">
                {{ __('Enviar correo de verificación') }}
            </button>
        </form>

        {{-- Botón salir --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-decoration-none">
                {{ __('Salir') }}
            </button>
        </form>

    </div>

</x-guest-layout>
