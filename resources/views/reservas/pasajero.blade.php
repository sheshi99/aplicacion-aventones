@extends('layouts.pasajero')

@section('content')

<h1 class="mb-4 fw-bold text-primary">Mis Reservas</h1>

<x-mensaje />

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Chofer</th>
                        <th>Salida</th>
                        <th>Llegada</th>
                        <th>Fecha</th>
                        <th>Vehículo</th>
                        <th>Costo</th>
                        <th>Estado</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($reservas as $reserva)
                    <tr>

                        {{-- Chofer --}}
                        <td>
                            {{ $reserva->ride->chofer->name }}
                            {{ $reserva->ride->chofer->apellido }}
                        </td>

                        {{-- Rutas --}}
                        <td>{{ $reserva->ride->salida }}</td>
                        <td>{{ $reserva->ride->llegada }}</td>

                        {{-- Fecha --}}
                        <td>{{ $reserva->ride->dia }} {{ $reserva->ride->hora }}</td>

                        {{-- Vehículo --}}
                        <td>
                            {{ $reserva->ride->vehiculo_placa }}<br>
                            {{ $reserva->ride->vehiculo_marca }}
                            {{ $reserva->ride->vehiculo_modelo }}
                            ({{ $reserva->ride->vehiculo_anio }})
                        </td>

                        {{-- Costo --}}
                        <td>₡{{ number_format($reserva->ride->costo, 0) }}</td>

                        {{-- Estado (sin colores) --}}
                        <td>{{ ucfirst($reserva->estado) }}</td>

                        {{-- Acción: solo cancelar si está pendiente o aceptada --}}
                        <td class="text-center">

                            @if(in_array($reserva->estado, ['pendiente','aceptada']))
                                <form action="{{ route('reservas.cancelar', $reserva->id_reserva) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Cancelar esta reserva?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Cancelar
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">N/A</span>
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
