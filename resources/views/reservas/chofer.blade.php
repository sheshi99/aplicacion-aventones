@extends('layouts.chofer')

@section('content')

<h2 class="mb-4 text-primary fw-bold text-center">Mis Reservas</h2>
<x-mensaje />

<h3>Activas</h3>
<x-table>
    <x-slot:head>
        <tr>
            <th>Salida</th>
            <th>Llegada</th>
            <th>Fecha y Hora</th>
            <th>Vehículo</th>
            <th>Costo</th>
            <th>Pasajero</th>
            <th>Estado</th>
            <th class="text-center">Acciones</th>
        </tr>
    </x-slot:head>

    <x-slot:body>
        @foreach ($activas as $reserva)
            <tr>
                <td>{{ $reserva->ride->salida }}</td>
                <td>{{ $reserva->ride->llegada }}</td>
                <td>{{ $reserva->ride->dia }} {{ $reserva->ride->hora }}</td>
                <td>
                    {{ $reserva->ride->vehiculo_placa }}<br>
                    {{ $reserva->ride->vehiculo_marca }}
                    {{ $reserva->ride->vehiculo_modelo }}
                    ({{ $reserva->ride->vehiculo_anio }})
                </td>
                <td>₡{{ number_format($reserva->ride->costo, 0) }}</td>
                <td>{{ $reserva->pasajero->name }} {{ $reserva->pasajero->apellido }}</td>
                <td>{{ ucfirst($reserva->estado) }}</td>
                <td class="text-center">
                    @if ($reserva->estado == 'pendiente')
                        <form action="{{ route('reservas.aceptar', $reserva->id_reserva) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Aceptar</button>
                        </form>
                        <form action="{{ route('reservas.rechazar', $reserva->id_reserva) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">Rechazar</button>
                        </form>
                    @elseif ($reserva->estado == 'aceptada')
                        <form action="{{ route('reservas.rechazar', $reserva->id_reserva) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">Rechazar</button>
                        </form>
                    @elseif ($reserva->estado == 'rechazada')
                        <form action="{{ route('reservas.aceptar', $reserva->id_reserva) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Aceptar</button>
                        </form>
                    @elseif ($reserva->estado == 'cancelada')
                        <span class="text-muted">---</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </x-slot:body>
</x-table>

<h3>Historial</h3>
<x-table>
    <x-slot:head>
        <tr>
            <th>Salida</th>
            <th>Llegada</th>
            <th>Fecha y Hora</th>
            <th>Vehículo</th>
            <th>Costo</th>
            <th>Pasajero</th>
            <th>Estado</th>
        </tr>
    </x-slot:head>

    <x-slot:body>
        @foreach ($pasadas as $reserva)
            <tr>
                <td>{{ $reserva->ride->salida }}</td>
                <td>{{ $reserva->ride->llegada }}</td>
                <td>{{ $reserva->ride->dia }} {{ $reserva->ride->hora }}</td>
                <td>
                    {{ $reserva->ride->vehiculo_placa }}<br>
                    {{ $reserva->ride->vehiculo_marca }}
                    {{ $reserva->ride->vehiculo_modelo }}
                    ({{ $reserva->ride->vehiculo_anio }})
                </td>
                <td>₡{{ number_format($reserva->ride->costo, 0) }}</td>
                <td>{{ $reserva->pasajero->name }} {{ $reserva->pasajero->apellido }}</td>
                <td>{{ ucfirst($reserva->estado) }}</td>
            </tr>
        @endforeach
    </x-slot:body>
</x-table>

@endsection
