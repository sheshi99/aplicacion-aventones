@extends('layouts.admin')

@section('title', 'Usuarios Registrados')

@section('content')

<div class="row g-3">
    <div class="col-md-12">

        @if(session('success'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
            <div class="mb-4 font-medium text-sm text-red-600">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary mb-3">
            Agregar Administrador
        </a>


        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($usuarios as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->apellido }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->rol) }}</td>
                    <td>{{ ucfirst($user->estado) }}</td>

                    {{-- Botones de acción --}}
                    <td>
                        <form action="{{ route('admin.usuarios.estado', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            @if($user->estado === 'inactivo')
                                <button class="btn btn-success btn-sm">
                                    Activar
                                </button>
                            @else
                                <button class="btn btn-warning btn-sm">
                                    Desactivar
                                </button>
                            @endif
                        </form>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
