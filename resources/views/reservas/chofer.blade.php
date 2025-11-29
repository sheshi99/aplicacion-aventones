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
                        <th>Pasajero</th>
                        <th>Ride</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($reservas as $reserva)
                    <tr>
                        <td>{{ $reserva->pasajero->name }}</td>
                        <td>{{ $reserva->ride->nombre }}</td>
                        <td>{{ $reserva->fecha_reserva }}</td>

                        <td>
                            @if($reserva->estado == 'pendiente')
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            @elseif($reserva->estado == 'aceptada')
                                <span class="badge bg-success">Aceptada</span>
                            @else
                                <span class="badge bg-danger">Rechazada</span>
                            @endif
                        </td>

                        <td class="text-center">
                            @if ($reserva->estado == 'pendiente')

                                <form action="{{ route('reservas.aceptar', $reserva->id_reserva) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="bi bi-check-circle"></i> Aceptar
                                    </button>
                                </form>

                                <form action="{{ route('reservas.rechazar', $reserva->id_reserva) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-x-circle"></i> Rechazar
                                    </button>
                                </form>

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
