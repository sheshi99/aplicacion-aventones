@extends('layouts.pasajero')

@section('content')
<div class="container mt-4">

    <x-mensaje />

    <h1 class="mb-4">Rides disponibles</h1>

    <form method="GET" action="{{ route('rides.publicos') }}" class="mb-4">

        <div class="row g-3">

            {{-- FILTROS EXISTENTES --}}
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

            {{-- NUEVO: ORDENAR POR --}}
            <div class="col-md-3">
                <select name="campo" class="form-select">
                    <option value="">Ordenar por...</option>
                    <option value="dia"     {{ request('campo')=='dia' ? 'selected' : '' }}>Fecha</option>
                    <option value="salida"  {{ request('campo')=='salida' ? 'selected' : '' }}>Salida</option>
                    <option value="llegada" {{ request('campo')=='llegada' ? 'selected' : '' }}>Llegada</option>
                </select>
            </div>

            {{-- ASC / DESC --}}
            <div class="col-md-3">
                <select name="direccion" class="form-select">
                    <option value="asc"  {{ request('direccion')=='asc' ? 'selected' : '' }}>Ascendente</option>
                    <option value="desc" {{ request('direccion')=='desc' ? 'selected' : '' }}>Descendente</option>
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    Aplicar
                </button>
            </div>

        </div>
    </form>


    {{-- TABLA DE RESULTADOS --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Salida</th>
                <th>Llegada</th>
                <th>Día</th>
                <th>Hora</th>
                <th>Cupo</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
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
                                <button type="submit" class="btn btn-success btn-sm">
                                    Reservar
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-warning btn-sm">
                            Inicia sesión
                        </a>
                    @endauth
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
@endsection

