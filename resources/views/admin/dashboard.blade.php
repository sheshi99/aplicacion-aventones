@extends('layouts.admin')

@section('title', 'Dashboard Administrador')

@section('content')

<div class="row g-3">
    <div class="col-md-12">
        <h3 class="mb-4">Lista de Usuarios Registrados</h3>

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
                        @if($user->estado === 'activo')
                        <!-- Botón de desactivar -->
                        <form action="{{ route('admin.usuarios.estado', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-danger btn-sm">
                                Desactivar
                            </button>
                        </form>

                        @elseif($user->estado === 'pendiente')
                        <button class="btn btn-secondary btn-sm" disabled>Pendiente</button>

                        @else
                        <button class="btn btn-secondary btn-sm" disabled>Inactivo</button>

                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
