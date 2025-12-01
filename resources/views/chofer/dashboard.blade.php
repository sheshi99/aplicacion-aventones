@extends('layouts.chofer')

@section('title', 'Dashboard Chofer')

@section('content')
<div class="row g-3">
    <div class="col-md-4">
        <div class="card p-3">
            <h5>Rides Pendientes</h5>
            <p>0 rides pendientes</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h5>Rides Completados</h5>
            <p>0 rides completados</p>
        </div>
    </div>
</div>
@endsection