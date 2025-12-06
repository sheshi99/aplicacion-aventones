@php
    $layout = auth()->check() ? 'layouts.pasajero' : 'layouts.ridesPublicos';
@endphp

@extends($layout)

@section('content')
<div class="container mt-4">

    <h1 class="mb-4 text-center text-primary fw-bold">Rides disponibles</h1>

    <x-mensaje />

    {{-- FORMULARIO DE FILTRO --}}
    <form method="GET" action="{{ route('rides.publicos') }}" class="mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <input type="text" 
                       name="salida" 
                       class="form-control" 
                       placeholder="Lugar de salida"
                       value="{{ request('salida') }}">
            </div>

            <div class="col-md-4">
                <input type="text" 
                       name="llegada" 
                       class="form-control" 
                       placeholder="Lugar de llegada"
                       value="{{ request('llegada') }}">
            </div>

            <div class="col-md-3">
                <select name="campo" class="form-select">
                    <option value="">Ordenar por...</option>
                    <option value="dia"     {{ request('campo')=='dia' ? 'selected' : '' }}>Fecha</option>
                    <option value="salida"  {{ request('campo')=='salida' ? 'selected' : '' }}>Salida</option>
                    <option value="llegada" {{ request('campo')=='llegada' ? 'selected' : '' }}>Llegada</option>
                </select>
            </div>

            <div class="col-md-3">
                <select name="direccion" class="form-select">
                    <option value="asc"  {{ request('direccion')=='asc' ? 'selected' : '' }}>Ascendente</option>
                    <option value="desc" {{ request('direccion')=='desc' ? 'selected' : '' }}>Descendente</option>
                </select>
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-sm px-3">
                    Aplicar
                </button>
            </div>

            <div class="col-auto">
                <a href="{{ route('rides.publicos') }}" class="btn btn-outline-secondary btn-sm px-3">
                    Limpiar
                </a>
            </div>
        </div>
    </form>

    {{-- TABLA DE RESULTADOS --}}
    @if($rides->count() > 0)
        <x-table>
            <x-slot:head>
                <tr class="text-white text-center" style="background-color: #0077B6;">
                    <th>Nombre</th>
                    <th>Salida</th>
                    <th>Llegada</th>
                    <th>Día</th>
                    <th>Hora</th>
                    <th>Espacios</th>
                    <th>Costo</th>
                    <th>Vehículo</th>
                    <th>Acciones</th>
                </tr>
            </x-slot:head>

            <x-slot:body>
                @foreach ($rides as $ride)
                <tr class="text-center align-middle">
                    <td>{{ $ride->nombre }}</td>
                    <td>{{ $ride->salida }}</td>
                    <td>{{ $ride->llegada }}</td>
                    <td>{{ $ride->dia }}</td>
                    <td>{{ $ride->hora }}</td>
                    <td>{{ $ride->espacios }}</td>
                    <td>₡{{ number_format($ride->costo, 0) }}</td>
                    <td>
                        {{ $ride->vehiculo_placa }}<br>
                        {{ $ride->vehiculo_marca }} {{ $ride->vehiculo_modelo }}
                        ({{ $ride->vehiculo_anio }})
                    </td>
                    <td>
                        @if ($ride->espacios <= 0)
                            <span class="text-muted">Completado</span>
                        @else
                            <div class="d-flex justify-content-center gap-2 align-items-center">
                                @auth
                                    @if(auth()->user()->rol == 'pasajero')
                                        <form action="{{ route('reservas.store', $ride->id_ride) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm 
                                                    rounded-pill px-3 shadow-sm">
                                                Reservar
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                                @guest
                                    <form action="{{ route('reservas.intento', $ride->id_ride) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm 
                                                rounded-pill px-3 shadow-sm">
                                            Reservar
                                        </button>
                                    </form>
                                @endguest
                            </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </x-slot:body>
        </x-table>
    @else
        <p class="text-center">
            No se encontraron rides disponibles.
        </p>

    @endif

</div>
@endsection
