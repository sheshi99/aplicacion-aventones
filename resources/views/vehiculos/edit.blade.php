@extends('layouts.chofer')

@section('content')
<div class="container mt-4">

    <h2>Editar Vehículo</h2>

    <form method="POST" action="{{ route('vehiculos.update', $vehiculo) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card p-4 shadow-sm">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Número de Placa</label>
                    <input type="text" name="numero_placa" class="form-control" value="{{ old('numero_placa', $vehiculo->numero_placa) }}">
                    @error('numero_placa') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Color</label>
                    <input type="text" name="color" class="form-control" value="{{ old('color', $vehiculo->color) }}">
                    @error('color') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Marca</label>
                    <input type="text" name="marca" class="form-control" value="{{ old('marca', $vehiculo->marca) }}">
                    @error('marca') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Modelo</label>
                    <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $vehiculo->modelo) }}">
                    @error('modelo') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Año</label>
                    <input type="number" name="anno" class="form-control" value="{{ old('anno', $vehiculo->anno) }}">
                    @error('anno') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Capacidad Asientos</label>
                    <input type="number" name="capacidad_asientos" class="form-control" value="{{ old('capacidad_asientos', $vehiculo->capacidad_asientos) }}">
                    @error('capacidad_asientos') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label>Fotografía (opcional)</label>
                    <input type="file" name="fotografia" class="form-control">
                    @error('fotografia') <small class="text-danger">{{ $message }}</small> @enderror

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
