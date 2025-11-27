<div class="row">

    <div class="col-md-6 mb-3">
        <label>Nombre del ride</label>
        <input type="text" name="nombre" class="form-control"
               value="{{ old('nombre', $ride->nombre ?? '') }}">
        @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label>Vehículo</label>
        <select name="id_vehiculo" class="form-select">
            <option value="">Seleccione un vehículo</option>

            @foreach($vehiculos as $v)
                <option value="{{ $v->id_vehiculo }}"
                    {{ old('id_vehiculo', $ride->id_vehiculo ?? '') == $v->id_vehiculo ? 'selected' : '' }}>
                    {{ $v->numero_placa }} - {{ $v->marca }} - {{ $v->modelo }}
                </option>
            @endforeach
        </select>
        @error('id_vehiculo') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label>Salida</label>
        <input type="text" name="salida" class="form-control"
               value="{{ old('salida', $ride->salida ?? '') }}">
        @error('salida') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label>Llegada</label>
        <input type="text" name="llegada" class="form-control"
               value="{{ old('llegada', $ride->llegada ?? '') }}">
        @error('llegada') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label>Día</label>
        <input type="date" name="dia" class="form-control"
               value="{{ old('dia', $ride->dia ?? '') }}">
        @error('dia') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label>Hora</label>
        <input type="time" name="hora" class="form-control"
               value="{{ old('hora', $ride->hora ?? '') }}">
        @error('hora') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label>Costo por espacio</label>
        <input type="number" step="0.01" name="costo" class="form-control"
               value="{{ old('costo', $ride->costo ?? '') }}">
        @error('costo') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label>Cantidad de espacios</label>
        <input type="number" name="espacios" class="form-control"
               value="{{ old('espacios', $ride->espacios ?? '') }}">
        @error('espacios') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

</div>
