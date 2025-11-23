@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Editar Vehículo</h2>

    <form method="POST" action="{{ route('vehiculos.update', $vehiculo->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card p-4 shadow-sm">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Número de Placa</label>
                    <input type="text" name="numero_placa" class="form-control" value="{{ old('numero_placa', $vehiculo->numero_placa) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Color</label>
                    <input type="text" name="color" class="form-control" value="{{ $vehiculo->color }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Marca</label>
                    <input type="text" name="marca" class="form-control" value="{{ $vehiculo->marca }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Modelo</label>
                    <input type="text" name="modelo" class="form-control" value="{{ $vehiculo->modelo }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Año</label>
                    <input type="number" name="anno" class="form-control" value="{{ $vehiculo->anno }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Capacidad Asientos</label>
                    <input type="number" name="capacidad_asientos" class="form-control" value="{{ $vehiculo->capacidad_asientos }}">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Fotografía (opcional)</label>
                    <input type="file" name="fotografia" class="form-control">

                    @if($vehiculo->fotografia)
                        <p class="mt-2">Foto actual:</p>
                        <img src="{{ asset('storage/'.$vehiculo->fotografia) }}" width="200" class="rounded">
                    @endif
                </div>
            </div>

            <button class="btn btn-warning">Actualizar</button>
            <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>

        </div>
    </form>

</div>
@endsection
