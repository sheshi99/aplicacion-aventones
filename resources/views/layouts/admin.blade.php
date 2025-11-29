<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex min-vh-100 bg-light">

    <!-- SIDEBAR -->
    <aside class="d-flex flex-column p-4 bg-primary text-white" style="width: 250px;">
        
        <h2 class="fs-4 mb-4">Panel Administrador</h2>

        <nav class="nav flex-column">

            <a href="{{ route('admin.panel') }}"
               class="nav-link text-white mb-2 {{ request()->routeIs('admin.panel') ? 'fw-bold text-primary rounded px-2' : '' }}">
                Usuarios
            </a>

            <a href="{{ route('profile.edit') }}"
               class="nav-link text-white mb-2 {{ request()->routeIs('profile.edit') ? 'fw-bold text-primary rounded px-2' : '' }}">
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

        <!-- Encabezado bonito sin estilos -->
        <h1 class="h3 border-bottom pb-2 mb-4">
            @yield('title')
        </h1>

        @yield('content')

    </main>

</body>
</html>
