<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">

        {{-- LOGO --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <x-application-logo class="h-9 w-auto text-dark" />
        </a>

        {{-- BOTÓN HAMBURGER --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar" aria-controls="mainNavbar"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- CONTENIDO DEL MENÚ --}}
        <div class="collapse navbar-collapse" id="mainNavbar">

            {{-- LINKS PRINCIPALES --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}"
                       href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>

            </ul>

            {{-- DROPDOWN USUARIO --}}
            <ul class="navbar-nav ms-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#" id="userDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="userDropdown">

                        {{-- PERFIL --}}
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                Perfil
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        {{-- LOGOUT --}}
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    Salir
                                </button>
                            </form>
                        </li>

                    </ul>
                </li>

            </ul>

        </div>
    </div>
</nav>
