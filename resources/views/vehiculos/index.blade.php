@extends('layouts.chofer')

@section('content')
<div class="container mt-4">
    

    <h2 class="mb-3">Mis Vehículos</h2>

    <x-mensaje />

    <a href="{{ route('vehiculos.create') }}" class="btn btn-primary mb-3">Registrar Vehículo</a>

    <div class="row">
        @forelse($vehiculos as $vehiculo)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">

                    @if($vehiculo->fotografia)
                        <img src="{{ asset('storage/'.$vehiculo->fotografia) }}" class="card-img-top" style="height:180px; object-fit:cover;">
                    @else
                        <img src="https://via.placeholder.com/300x180?text=Vehículo" class="card-img-top">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $vehiculo->marca }} - {{ $vehiculo->modelo }}</h5>
                        <p class="mb-1"><strong>Placa:</strong> {{ $vehiculo->numero_placa }}</p>
                        <p class="mb-1"><strong>Año:</strong> {{ $vehiculo->anno }}</p>
                         <p class="mb-1"><strong>Asientos:</strong> {{ $vehiculo->capacidad_asientos }}</p>
                        <p class="mb-1"><strong>Color:</strong> {{ $vehiculo->color }}</p>

                        <div class="mt-3 d-flex justify-content-between">

                            <!-- Editar usando Route Model Binding -->
                            <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-warning btn-sm">
                                ✏ Editar
                            </a>

                            <!-- Eliminar usando Route Model Binding -->
                            <form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST" onsubmit="return confirm('¿Eliminar este vehículo?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">🗑 Eliminar</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No tienes vehículos registrados.</p>
        @endforelse
    </div>

</div>
@endsection
