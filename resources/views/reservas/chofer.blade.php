@extends('layouts.chofer')

@section('content')

<h2 class="h5 m-0">Reservas</h2>

<x-mensaje />

<h3>Reservas Activas</h3>
<div class="card shadow-sm mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
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
                </thead>
                <tbody>
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
                </tbody>
            </table>
        </div>
    </div>
</div>

<h3>Reservas Pasadas</h3>
<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
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
                </thead>
                <tbody>
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
                        <td class="text-center">
                           
                            <span class="text-muted">---</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection