@extends('layouts.admin')
@section('content')
<div class="row g-3">
    <div class="col-md-12">

        <x-mensaje />

        <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary mb-3">
            Agregar Administrador
        </a>

        <x-table>
            <x-slot:head>
                <tr class="text-center text-white" style="background-color: #0077B6;">
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Fotografía</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </x-slot:head>

            <x-slot:body>
                @foreach($usuarios as $user)
                <tr class="text-center align-middle">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->apellido }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if(!empty($user->fotografia))
                            <img src="{{ asset('storage/' . $user->fotografia) }}" 
                                alt="{{ $user->name }}" 
                                width="80" 
                                height="80" 
                                class="rounded-circle object-fit-cover">
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
            </x-slot:body>
        </x-table>

    </div>
</div>
@endsection

