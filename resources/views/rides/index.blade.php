@extends('layouts.chofer')

@section('content')
<div class="container">

    <h2 class="mb-4">Listado de Rides</h2>

    <x-mensaje />

    <a href="{{ route('rides.create') }}" class="btn btn-primary mb-3">Crear Ride</a>

       <!-- Mensaje explicativo menos llamativo -->
    <p class="text-muted small mb-3">
        Nota: Los rides con reservas aceptadas no pueden ser editados ni eliminados.
    </p>

    <table class="table table-bordered table-striped">
        <thead class= "table-light">
            <tr>
                <th>Nombre</th>
                <th>Salida</th>
                <th>Llegada</th>
                <th>Día</th>
                <th>Hora</th>
                <th>Costo</th>
                <th>Espacios</th>
                <th>Vehículo</th>
                <th>Opciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($rides as $ride)
                <tr>
                    <td>{{ $ride->nombre }}</td>
                    <td>{{ $ride->salida }}</td>
                    <td>{{ $ride->llegada }}</td>
                    <td>{{ $ride->dia }}</td>
                    <td>{{ $ride->hora }}</td>
                    <td>₡{{ $ride->costo }}</td>
                    <td>{{ $ride->espacios }}</td>
                    <td>{{ $ride->vehiculo_placa }}</td>

                    <td class="d-flex gap-2">
                        @if($ride->reservas()->where('estado', 'aceptada')->count() == 0)
                            <!-- Mostrar botones solo si no hay reservas aceptadas -->
                            <a href="{{ route('rides.edit', $ride->id_ride) }}" class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('rides.destroy', $ride->id_ride) }}" method="POST" onsubmit="return confirm('¿Eliminar este vehículo?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">🗑 Eliminar</button>
                            </form>
                        @else
                            <!-- Ride con reservas aceptadas -->
                            <span class="text-muted">---</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
