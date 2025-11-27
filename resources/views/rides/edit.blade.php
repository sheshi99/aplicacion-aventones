@extends('layouts.chofer')

@section('content')
<div class="container">

    <h2 class="mb-4">Editar Ride</h2>

    <form action="{{ route('rides.update', $ride->id_ride) }}" method="POST">
        @csrf
        @method('PUT')

        @include('rides.form')

        <button class="btn btn-primary mt-3">Actualizar Ride</button>
    </form>

</div>
@endsection
