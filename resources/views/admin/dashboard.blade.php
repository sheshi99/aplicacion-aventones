@extends('layouts.admin')

@section('title', 'Usuarios Registrados')
<div class="row g-3">
    <div class="col-md-12">

    <x-mensaje />
    
        <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary mb-3">
            Agregar Administrador
        </a>


        <table class="table table-bordered table-striped">
            <thead class= "table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Fotografía</th>
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
                    <td>
                        @if(!empty($user->fotografia))
                            <img src="{{ asset('storage/' . $user->fotografia) }}" 
                                alt="{{ $user->name }}" 
                                width="50" 
                                height="50" 
                                class="rounded-circle">
                        @else
                            <span>No hay foto</span>
                        @endif
                    </td>

                    <td>{{ ucfirst($user->rol) }}</td>
                    <td>{{ ucfirst($user->estado) }}</td>

                    {{-- Botones de acción --}}
                    <td>
                        <form action="{{ route('admin.usuarios.estado', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            @if($user->estado === 'inactivo' || $user->estado === 'pendiente')
                                <button class="btn btn-success btn-sm">
                                    Activar
                                </button>
                            @else
                                <button class="btn btn-danger btn-sm">
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
