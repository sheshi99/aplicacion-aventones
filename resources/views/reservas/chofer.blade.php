@extends('layouts.chofer')

@section('content')

<h1 class="mb-4 text-primary fw-bold">Reservas recibidas</h1>

<x-mensaje />

<div class="card shadow-sm">
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
                @foreach ($reservas as $reserva)
                    <tr>

                        {{-- Datos del Ride --}}
                        <td>{{ $reserva->ride->salida }}</td>
                        <td>{{ $reserva->ride->llegada }}</td>
                        <td>{{ $reserva->ride->dia }} {{ $reserva->ride->hora }}</td>

                        {{-- Vehículo --}}
                        <td>
                            {{ $reserva->ride->vehiculo_placa }}<br>
                            {{ $reserva->ride->vehiculo_marca }}
                            {{ $reserva->ride->vehiculo_modelo }}
                            ({{ $reserva->ride->vehiculo_anio }})
                        </td>

                        <td>₡{{ number_format($reserva->ride->costo, 0) }}</td>
                       
                        <td>{{ $reserva->pasajero->name }} {{ $reserva->pasajero->apellido }}</td>
                       
                        <td>{{ ucfirst($reserva->estado) }}</td>

                        {{-- Botones --}}
                        <td class="text-center">

                            @if ($reserva->estado == 'pendiente')
                                {{-- Pendiente → Aceptar / Rechazar --}}
                                <form action="{{ route('reservas.aceptar', $reserva->id_reserva) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Aceptar</button>
                                </form>

                                <form action="{{ route('reservas.rechazar', $reserva->id_reserva) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Rechazar</button>
                                </form>
                            @endif

                            @if ($reserva->estado == 'aceptada')
                                {{-- Aceptada → solo Rechazar --}}
                                <form action="{{ route('reservas.rechazar', $reserva->id_reserva) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Rechazar</button>
                                </form>
                            @endif

                            @if ($reserva->estado == 'rechazada')
                                {{-- Rechazada → solo Aceptar --}}
                                <form action="{{ route('reservas.aceptar', $reserva->id_reserva) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Aceptar</button>
                                </form>
                            @endif

                            @if ($reserva->estado == 'cancelada')
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

@endsection
