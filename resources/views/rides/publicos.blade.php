@extends('pasajero.app')

@section('content')
<h1>Rides disponibles</h1>

<form method="GET" action="{{ route('rides.publicos') }}">
    <input type="text" name="salida" placeholder="Lugar de salida" value="{{ request('salida') }}">
    <input type="text" name="llegada" placeholder="Lugar de llegada" value="{{ request('llegada') }}">
    <button type="submit">Filtrar</button>
</form>

<table>
    <tr>
        <th>Nombre</th>
        <th>Salida</th>
        <th>Llegada</th>
        <th>Día</th>
        <th>Hora</th>
        <th>Cupo</th>
        <th>Acciones</th>
    </tr>

    @foreach ($rides as $ride)
    <tr>
        <td>{{ $ride->nombre }}</td>
        <td>{{ $ride->salida }}</td>
        <td>{{ $ride->llegada }}</td>
        <td>{{ $ride->dia }}</td>
        <td>{{ $ride->hora }}</td>
        <td>{{ $ride->espacios }}</td>
        <td>
            @auth
                @if(auth()->user()->rol == 'pasajero')
                    <form action="{{ route('reservas.store', $ride->id_ride) }}" method="POST">
                        @csrf
                        <button type="submit">Reservar</button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}">Inicia sesión para reservar</a>
            @endauth
        </td>
    </tr>
    @endforeach
</table>

@endsection
