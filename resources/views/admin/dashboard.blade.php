@extends('layouts.app')

@section('content')
<h1>Panel de Administrador</h1>
<p>Bienvenido, {{ auth()->user()->name }}!</p>
@endsection




