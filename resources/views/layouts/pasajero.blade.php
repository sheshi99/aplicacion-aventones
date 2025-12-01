<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Pasajero')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

    <!-- HEADER / MENÚ SUPERIOR -->
    <header class="bg-warning text-dark py-3">
        <div class="container d-flex justify-content-between align-items-center">

            <!-- Logo o Título -->
            <h2 class="h5 m-0">Panel Pasajero</h2>

            <!-- Menú -->
            <nav class="d-flex gap-5">
                <a href="{{ route('pasajero.panel') }}" 
                   class="text-dark text-decoration-none {{ request()->routeIs('pasajero.panel') ? 'fw-bold text-primary' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('rides.publicos') }}" 
                   class="text-dark text-decoration-none {{ request()->routeIs('rides.publicos') ? 'fw-bold text-primary' : '' }}">
                    Buscar Rides
                </a>
                <a href="{{ route('reservas.mias') }}" 
                   class="text-dark text-decoration-none {{ request()->routeIs('reservas.mias') ? 'fw-bold text-primary' : '' }}">
                    Mis Reservas
                </a>
                <a href="{{ route('profile.edit') }}" 
                   class="text-dark text-decoration-none {{ request()->routeIs('profile.edit') ? 'fw-bold text-primary' : '' }}">
                    Perfil
                </a>
                <a href="{{ route('logout') }}" 
                   class="text-dark text-decoration-none"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>

        </div>
    </header>

    <!-- CONTENIDO -->
    <main class="flex-grow-1 p-4">
        <h1 class="h3 border-bottom pb-2 mb-4">
            @yield('title', 'Panel Pasajero')
        </h1>

        @yield('content')
    </main>

</body>
</html>
