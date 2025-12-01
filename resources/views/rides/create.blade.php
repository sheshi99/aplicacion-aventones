@extends('layouts.chofer')

@section('content')
<div class="card p-4 shadow-sm">

    <h2 class="mb-4">Crear Ride</h2>

    <form action="{{ route('rides.store') }}" method="POST">
        @csrf

        @include('rides.form')

        <div class="d-flex justify-content-end gap-2 mt-30">
            <button class="btn btn-success">Guardar Ride</button>
            <a href="{{ route('rides.index') }}" class="btn btn-danger">Cancelar</a>
        </div>

    </form>
    

</div>
@endsection
