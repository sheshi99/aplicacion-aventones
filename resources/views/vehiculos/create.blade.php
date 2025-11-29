@extends('layouts.chofer')

@section('content')
<div class="container mt-4">

    <h2>Registrar Vehículo</h2>

    <form method="POST" action="{{ route('vehiculos.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="card p-4 shadow-sm">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Número de Placa</label>
                    <input type="text" name="numero_placa" class="form-control" value="{{ old('numero_placa') }}">
                    @error('numero_placa') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Color</label>
                    <input type="text" name="color" class="form-control" value="{{ old('color') }}">
                    @error('color') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Marca</label>
                    <input type="text" name="marca" class="form-control" value="{{ old('marca') }}">
                    @error('marca') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Modelo</label>
                    <input type="text" name="modelo" class="form-control" value="{{ old('modelo') }}">
                    @error('modelo') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Año</label>
                    <input type="number" name="anno" class="form-control" value="{{ old('anno') }}">
                    @error('anno') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label>Capacidad Asientos</label>
                    <input type="number" name="capacidad_asientos" class="form-control" value="{{ old('capacidad_asientos') }}">
                    @error('capacidad_asientos') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label>Fotografía</label>
                    <input type="file" name="fotografia" class="form-control">
                    @error('fotografia') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-30">
                <button type="submit" class="btn btn-success">Guardar Vehículo</button>
                <a href="{{ route('vehiculos.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>

</div>
@endsection
