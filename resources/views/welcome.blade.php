<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Veterinaria</title>
    @vite(['resources/sass/auth.scss', 'resources/js/app.js'])
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Styles -->
    <style>

    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <div id="auth">
            <div class="overlay">
                <div class="container">
                    <main>
                        <div class="d-flex justify-content-center">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ URL('images/logo.png') }}" height="300" width="300">
                                    <div>
                                        @if (Route::has('login'))
                                            <div id="buttons-ini">
                                                @auth
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-primary">
                                                            <a href="{{ url('/home') }}">Home</a>
                                                        </button>

                                                    </div>
                                                @else
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-primary">
                                                            <a href="{{ route('login') }}">Iniciar Sesión</a>
                                                        </button>
                                                    </div>
                                                    @if (Route::has('register'))
                                                    <div class="text-center">
                                                        <a  class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                                        href="{{ route('register') }}">Registrar un nuevo usuario</a>
                                                    </div>

                                                    @endif
                                                @endauth
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>

                </div>

            </div>
        </div>
    </div>


</body>

</html>
