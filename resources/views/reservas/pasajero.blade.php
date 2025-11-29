@extends('layouts.pasajero')

@section('content')
<h1>Mis reservas</h1>

<x-mensaje />

<table>
    <tr>
        <th>Ride</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>

    @foreach ($reservas as $reserva)
    <tr>
        <td>{{ $reserva->ride->nombre }}</td>
        <td>{{ $reserva->fecha_reserva }}</td>
        <td>{{ $reserva->estado }}</td>

        <td>
            @if ($reserva->estado == 'pendiente')
                <form action="{{ route('reservas.cancel', $reserva->id_reserva) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Cancelar</button>
                </form>
            @endif
        </td>
    </tr>
    @endforeach
</table>

@endsection
