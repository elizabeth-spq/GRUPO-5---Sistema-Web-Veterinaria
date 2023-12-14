<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Veterinaria') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Styles -->
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Scripts -->
    @vite(['resources/sass/admin.scss', 'resources/js/app.js'])
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="d-flex flex-column mb-3 w-100">
                    <div id="primer-menu" class="d-flex">
                        <div class="flex-grow-1">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ URL('images/vetlogo.PNG') }}" class="img-fluid">
                            </a>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <img src="{{ URL('images/man.png') }}" height="35">
                            </div>
                            <div class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('changePassword') }}">
                                        {{ __('Cambiar Contraseña') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div id="segundo-menu" class="collapse navbar-collapse" id="navbarSupportedContent">

                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
                            <!-- Authentication Links -->

                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('changePassword'))
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('changePassword') }}">{{ __('ChangePassword') }}</a>
                                    </li>
                                @endif
                            @else
                                @can('administrador')
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-person"></i> Autenticación
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ url('/admin/roles') }}">Roles</a></li>
                                            <li><a class="dropdown-item" href="{{ url('/admin/users') }}">Usuarios</a></li>

                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/admin/veterinarios') }}" class="nav-link">
                                            <i class="bi bi-people"></i>
                                            Veterinarios
                                        </a>
                                    </li>
                                @endcan
                                <li class="nav-item">
                                    <a href="{{ url('/admin/clientes') }}" class="nav-link">
                                        <i class="bi bi-person-standing"></i>
                                        Clientes
                                    </a>
                                </li>
                                <li class="nav-item"><a href="{{ url('/admin/mascotas') }}" class="nav-link">
                                        <i class="bi bi-heart-pulse"></i>
                                        Mascotas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/citas') }}" class="nav-link">
                                        <i class="bi bi-bookmark-check"></i>
                                        Citas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/historias') }}" class="nav-link">
                                        <i class="bi bi-clipboard2-pulse"></i>
                                        Historial Medico
                                    </a>
                                </li>

                            @endguest
                        </ul>
                    </div>
                </div>

            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
