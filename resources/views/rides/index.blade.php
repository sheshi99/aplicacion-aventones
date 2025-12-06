@extends('layouts.chofer')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4 text-primary fw-bold text-center">Listado de Rides</h2>

    {{-- Mensajes de alerta --}}
    <x-mensaje />

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('rides.create') }}" class="btn btn-primary shadow-sm">
            Crear Ride
        </a>
        <p class="text-muted small mb-0">
            Nota: Los rides con reservas aceptadas no pueden ser editados ni eliminados.
        </p>
    </div>

    {{-- Tabla usando componente --}}
    <x-table>

        {{-- Encabezado de la tabla --}}
        <x-slot:head>
            <tr class="bg-primary text-white text-center">
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
        </x-slot:head>

        {{-- Cuerpo de la tabla --}}
        <x-slot:body>
            @foreach($rides as $ride)
                <tr class="text-center align-middle">
                    <td>{{ $ride->nombre }}</td>
                    <td>{{ $ride->salida }}</td>
                    <td>{{ $ride->llegada }}</td>
                    <td>{{ $ride->dia }}</td>
                    <td>{{ $ride->hora }}</td>
                    <td>₡{{ $ride->costo }}</td>
                    <td>{{ $ride->espacios }}</td>
                    <td>{{ $ride->vehiculo_placa }}</td>
                    <td class="text-center align-middle">
                        @if($ride->reservas()->where('estado', 'aceptada')->count() == 0)
                            <div class="d-flex justify-content-center gap-2 align-items-center">
                                <a href="{{ route('rides.edit', $ride->id_ride) }}" 
                                   class="btn btn-outline-primary btn-sm rounded-pill px-3 shadow-sm">
                                   ✏ Editar
                                </a>

                                <form action="{{ route('rides.destroy', $ride->id_ride) }}" method="POST"
                                      onsubmit="return confirm('¿Está seguro de eliminar este ride?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm">
                                        🗑 Eliminar
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="text-muted">---</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-slot:body>

    </x-table>

</div>
@endsection
