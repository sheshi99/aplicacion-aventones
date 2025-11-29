<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Pasajero')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex min-vh-100 bg-light">

    <!-- SIDEBAR (mismo diseño, color amarillo) -->
    <aside class="d-flex flex-column p-4 bg-warning text-dark" style="width: 250px;">
        
        <h2 class="fs-4 mb-4">Panel Pasajero</h2>

        <nav class="nav flex-column">

            <a href="{{ route('pasajero.panel') }}"
               class="nav-link text-dark mb-2 {{ request()->routeIs('pasajero.panel') ? 'fw-bold rounded px-2' : '' }}">
                Dashboard
            </a>

            <a href="#"
               class="nav-link text-dark mb-2">
                Mis Rides
            </a>

            <a href="#"
               class="nav-link text-dark mb-2">
                Mis Reservas
            </a>

            <a href="{{ route('profile.edit') }}"
               class="nav-link text-dark mb-2 {{ request()->routeIs('profile.edit') ? 'fw-bold rounded px-2' : '' }}">
                Perfil
            </a>

            <a class="nav-link text-dark"
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

        <!-- Encabezado igual a los demás -->
        <h1 class="h3 border-bottom pb-2 mb-4">
            @yield('title', 'Panel Pasajero')
        </h1>

        @yield('content')

    </main>

</body>
</html>
