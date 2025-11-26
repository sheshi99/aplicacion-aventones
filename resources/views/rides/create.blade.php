@extends('layouts.chofer')

@section('content')
<div class="container">

    <h2 class="mb-4">Crear Ride</h2>

    <form action="{{ route('rides.store') }}" method="POST">
        @csrf

        @include('rides.form')

        <button class="btn btn-success mt-3">Guardar Ride</button>
    </form>

</div>
@endsection
