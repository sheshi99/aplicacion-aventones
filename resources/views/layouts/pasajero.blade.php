<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Pasajero')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex min-vh-100">

    <!-- Sidebar Pasajero -->
    <div class="bg-warning text-dark p-4" style="width: 250px;">
        <h2>Pasajero Panel</h2>
        <nav class="nav flex-column">
            <a class="nav-link text-dark" href="{{ route('pasajero.panel') }}">Dashboard</a>
            <a class="nav-link text-dark" href="#">Mis Rides</a>
            <a class="nav-link text-dark" href="#">Mis Reservas</a>
            <a class="nav-link text-white" href="{{ route('profile.edit') }}">Perfil</a>
            <a class="nav-link text-dark" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               Cerrar sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
    </div>

    <!-- Contenido principal -->
    <main class="flex-grow-1 p-4 bg-light">
        <header class="mb-4">
            <h1>Bienvenido, {{ auth()->user()->name }}!</h1>
            <p>Rol: {{ ucfirst(auth()->user()->rol) }}</p>
        </header>
        <section>
            @yield('content')
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
