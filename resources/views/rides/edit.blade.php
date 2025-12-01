@extends('layouts.chofer')

@section('content')
<div class="container">

    <h2 class="mb-4">Editar Ride</h2>

    <form action="{{ route('rides.update', $ride->id_ride) }}" method="POST">
        @csrf
        @method('PUT')

        @include('rides.form')

        <div class="d-flex justify-content-end gap-2 mt-30">
            <button class="btn btn-success">Actualizar Ride</button>
            <a href="{{ route('rides.index') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>

</div>
@endsection
