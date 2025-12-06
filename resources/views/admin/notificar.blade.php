@extends('layouts.admin')

@section('content')

<div class="container">

    <h2>Notificar Choferes</h2>

    <form method="POST" action="{{ route('admin.notificar.ejecutar') }}">
        @csrf

        <label>Ingrese los minutos:</label>
        <input type="number" name="minutos" class="form-control" required>

        <button class="btn btn-primary mt-3">Enviar Notificaciones</button>
    </form>

    @if (session('resultado'))
        <div class="mt-4 p-3 bg-dark text-white rounded">
            <h4>Resultado de la ejecución:</h4>
            <pre>{{ session('resultado') }}</pre>
        </div>
    @endif

</div>

@endsection
