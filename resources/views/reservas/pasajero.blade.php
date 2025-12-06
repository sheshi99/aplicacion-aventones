@extends('layouts.pasajero')

@section('content')

<h2 class="mb-4 text-primary fw-bold text-center">Mis Reservas</h2>

<x-mensaje />

{{-- Reservas Activas --}}
<h3>Activas</h3>
<x-table>
    <x-slot:head>
        <tr class="text-center">
            <th>Salida</th>
            <th>Llegada</th>
            <th>Fecha y Hora</th>
            <th>Vehículo</th>
            <th>Costo</th>
            <th>Chofer</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </x-slot:head>

    <x-slot:body>
        @foreach ($activas as $reserva)
            <tr class="text-center">
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
                <td>{{ $reserva->ride->chofer->name }} {{ $reserva->ride->chofer->apellido }}</td>
                <td>{{ ucfirst($reserva->estado) }}</td>
                <td>
                    @if(in_array($reserva->estado, ['pendiente','aceptada']))
                        <form action="{{ route('reservas.cancelar', $reserva->id_reserva) }}" method="POST"
                              onsubmit="return confirm('¿Está seguro que desea cancelar esta reserva?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Cancelar</button>
                        </form>
                    @else
                        <span class="text-muted">---</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </x-slot:body>
</x-table>

{{-- Reservas Pasadas --}}
<h3>Historial</h3>
<x-table>
    <x-slot:head>
        <tr class="text-center">
            <th>Salida</th>
            <th>Llegada</th>
            <th>Fecha y Hora</th>
            <th>Vehículo</th>
            <th>Costo</th>
            <th>Chofer</th>
            <th>Estado</th>
        </tr>
    </x-slot:head>

    <x-slot:body>
        @foreach ($pasadas as $reserva)
            <tr class="text-center">
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
                <td>{{ $reserva->ride->chofer->name }} {{ $reserva->ride->chofer->apellido }}</td>
                <td>{{ ucfirst($reserva->estado) }}</td>
            </tr>
        @endforeach
    </x-slot:body>
</x-table>

@endsection
