@extends('layouts.chofer')

@section('content')
<div class="container mt-4">

    <!-- Bienvenida -->
    <div class="jumbotron bg-primary text-white p-5 rounded shadow-sm mb-4">
        <h1 class="display-5 fw-bold">¡Bienvenido, {{ auth()->user()->name }}!</h1>
        <p class="lead">Este es tu panel de chofer, aquí puedes ver tus rides y gestionar tus reservas.</p>
        <hr class="my-4" style="border-color: rgba(255,255,255,0.5);">
        <p class="mb-0">Mantente al tanto de tus rides pendientes y completados.</p>
    </div>
</div>
@endsection
