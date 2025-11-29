<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Chofer')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex min-vh-100 bg-light">

    <!-- SIDEBAR (igual diseño que admin, solo cambia color) -->
    <aside class="d-flex flex-column p-4 bg-success text-white" style="width: 250px;">
        
        <h2 class="fs-4 mb-4">Panel Chofer</h2>

        <nav class="nav flex-column">

            <a href="{{ route('chofer.panel') }}"
               class="nav-link text-white mb-2 {{ request()->routeIs('chofer.panel') ? 'fw-bold text-success rounded px-2' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('vehiculos.index') }}"
               class="nav-link text-white mb-2 {{ request()->routeIs('vehiculos.index') ? 'fw-bold text-success rounded px-2' : '' }}">
                Mis Vehículos
            </a>

            <a href="{{ route('rides.index') }}"
               class="nav-link text-white mb-2 {{ request()->routeIs('rides.index') ? 'fw-bold text-success rounded px-2' : '' }}">
                Mis Rides
            </a>

            <a href="#"
               class="nav-link text-white mb-2">
                Mis Reservas
            </a>

            <a href="{{ route('profile.edit') }}"
               class="nav-link text-white mb-2 {{ request()->routeIs('profile.edit') ? 'fw-bold text-success rounded px-2' : '' }}">
                Perfil
            </a>

            <a class="nav-link text-white"
               href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               Cerrar sesión
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </nav>
    </aside>

    <!-- CONTENIDO -->
    <main class="flex-grow-1 p-4">

        <!-- Encabezado igual al del admin -->
        <h1 class="h3 border-bottom pb-2 mb-4">
            @yield('title', 'Panel Chofer')
        </h1>

        @yield('content')

    </main>

</body>
</html>
