<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rides')</title>

    <!-- BOSSTRAP / BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-primary-subtle">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">

            <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
                Aventones App 🚗
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarPublic" aria-controls="navbarPublic"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarPublic">
                <ul class="navbar-nav">

                    <li class="nav-item me-2">
                        <a class="btn btn-outline-primary" href="{{ route('login') }}">
                            Iniciar sesión
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('register') }}">
                            Registrarse
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    <main class="flex-grow-1 p-4">
    <h1 class="h3 border-bottom pb-2 mb-4">@yield('title')</h1>
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
