@extends('layouts.chofer')

@section('content')
<div class="container">

    <h2 class="mb-4">Listado de Rides</h2>

    <a href="{{ route('rides.create') }}" class="btn btn-primary mb-3">Crear Ride</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Salida</th>
                <th>Llegada</th>
                <th>Día</th>
                <th>Hora</th>
                <th>Costo</th>
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
                    <td>{{ $ride->vehiculo_placa }}</td>

                    <td class="d-flex gap-2">
                        <a href="{{ route('rides.edit', $ride->id_ride) }}" class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <form action="{{ route('rides.destroy', $ride->id_ride) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Eliminar ride?')">
                                Eliminar
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
