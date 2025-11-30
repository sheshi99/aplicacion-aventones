@extends('layouts.pasajero')

@section('content')

<h1 class="mb-4 fw-bold text-primary">Mis Reservas</h1>

<h3>Reservas Activas</h3>
<div class="card shadow-sm mb-4">
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
                        <th>Chofer</th>
                        <th>Estado</th>
                        <th class="text-center">Acción</th>
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
                        <td>{{ $reserva->ride->chofer->name }} {{ $reserva->ride->chofer->apellido }}</td>
                        <td>{{ ucfirst($reserva->estado) }}</td>
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
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Salida</th>
                        <th>Llegada</th>
                        <th>Fecha y Hora</th>
                        <th>Vehículo</th>
                        <th>Costo</th>
                        <th>Chofer</th>
                        <th>Estado</th>
                        <th class="text-center">Acción</th>
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
                        <td>{{ $reserva->ride->chofer->name }} {{ $reserva->ride->chofer->apellido }}</td>
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
