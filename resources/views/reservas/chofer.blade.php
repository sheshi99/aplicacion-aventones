@extends('layouts.chofer')

@section('content')
<h1>Reservas recibidas</h1>

<x-mensaje />

<table>
    <tr>
        <th>Pasajero</th>
        <th>Ride</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>

    @foreach ($reservas as $reserva)
    <tr>
        <td>{{ $reserva->pasajero->name }}</td>
        <td>{{ $reserva->ride->nombre }}</td>
        <td>{{ $reserva->fecha_reserva }}</td>
        <td>{{ $reserva->estado }}</td>

        <td>
            @if ($reserva->estado == 'pendiente')
                <form action="{{ route('reservas.aceptar', $reserva->id_reserva) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Aceptar</button>
                </form>

                <form action="{{ route('reservas.rechazar', $reserva->id_reserva) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Rechazar</button>
                </form>
            @endif
        </td>
    </tr>
    @endforeach
</table>

@endsection
