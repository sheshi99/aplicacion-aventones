@extends('layouts.admin')

@section('content')

<div class="container mt-4" style="max-width: 600px;">

    <h2 class="mb-3 text-primary fw-bold text-center">
        Notificar Choferes
    </h2>

    <p class="text-muted text-center">
        Ingrese los minutos para buscar reservas pendientes y enviar las notificaciones.
    </p>

    <form method="POST" 
          action="{{ route('admin.notificar.ejecutar') }}" 
          class="card shadow-sm p-4"
          style="max-width: 350px; margin: auto;">

        @csrf

        <div class="mb-2 text-center">
            <label class="form-label fw-semibold">Minutos:</label>

            <input 
                type="number" 
                name="minutos" 
                class="form-control mx-auto @error('minutos') is-invalid @enderror"
                style="width:120px;"
                placeholder="Ej: 30"
                required>
        </div>

       
        @error('minutos')
            <div class="text-center mb-2">
                <small class="text-danger fw-semibold">{{ $message }}</small>
            </div>
        @enderror

        <div class="text-center mt-2">
            <button class="btn btn-primary btn-sm px-3 py-1">
                📤 Enviar
            </button>
        </div>

    </form>

    @if (session('resultado'))
        <div class="mt-4 p-3 rounded shadow-sm border" 
             style="background: #ffffff;">
            <h6 class="fw-bold text-primary mb-2">Resultado:</h6>

            <div class="small" style="white-space: pre-wrap; color:#0a1a2b;">
                {{ session('resultado') }}
            </div>
        </div>
    @endif

</div>

@endsection
