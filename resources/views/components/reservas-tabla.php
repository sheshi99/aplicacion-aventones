<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        @if($rol === 'pasajero')
                            <th>Chofer</th>
                        @endif
                        <th>Salida</th>
                        <th>Llegada</th>
                        <th>Fecha y Hora</th>
                        <th>Vehículo</th>
                        <th>Costo</th>
                        <th>Estado</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservas as $reserva)
                        <tr>
                            @if($rol === 'pasajero')
                                <td>{{ $reserva->ride->chofer->name }} {{ $reserva->ride->chofer->apellido }}</td>
                            @endif
                            <td>{{ $reserva->ride->salida }}</td>
                            <td>{{ $reserva->ride->llegada }}</td>
                            <td>{{ $reserva->ride->dia }} {{ $reserva->ride->hora }}</td>
                            <td>
                                {{ $reserva->ride->vehiculo_placa }}<br>
                                {{ $reserva->ride->vehiculo_marca }} {{ $reserva->ride->vehiculo_modelo }} ({{ $reserva->ride->vehiculo_anio }})
                            </td>
                            <td>₡{{ number_format($reserva->ride->costo, 0) }}</td>
                            <td>{{ ucfirst($reserva->estado) }}</td>
                            <td class="text-center">
                                @if($rol === 'chofer')
                                    @if($reserva->estado == 'pendiente')
                                        <form action="{{ route('reservas.aceptar', $reserva->id_reserva) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-success btn-sm">Aceptar</button>
                                        </form>
                                        <form action="{{ route('reservas.rechazar', $reserva->id_reserva) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">Rechazar</button>
                                        </form>
                                    @elseif($reserva->estado == 'aceptada')
                                        <form action="{{ route('reservas.rechazar', $reserva->id_reserva) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">Rechazar</button>
                                        </form>
                                    @else
                                        <span class="text-muted">---</span>
                                    @endif
                                @elseif($rol === 'pasajero')
                                    @if(in_array($reserva->estado, ['pendiente','aceptada']))
                                        <form action="{{ route('reservas.cancelar', $reserva->id_reserva) }}" method="POST" onsubmit="return confirm('¿Cancelar esta reserva?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Cancelar</button>
                                        </form>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
