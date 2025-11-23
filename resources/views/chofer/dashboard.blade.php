@extends('layouts.app')

@section('content')
<h1>Panel de Chofer</h1>
<p>Bienvenido, {{ auth()->user()->name }}!</p>
@endsection


