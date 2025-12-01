@php
    $rol = auth()->user()->rol;

    $layout = match ($rol) {
        'admin' => 'layouts.admin',
        'chofer' => 'layouts.chofer',
        'pasajero' => 'layouts.pasajero',
        default => 'layouts.admin',
    };
@endphp

@extends($layout)

@section('content')

<div class="container">

    {{-- FORMULARIO DE PERFIL --}}
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>
    </div>

    {{-- FORMULARIO DE PASSWORD --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
