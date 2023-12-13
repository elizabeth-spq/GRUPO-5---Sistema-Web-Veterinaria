<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    @vite(['resources/sass/auth.scss'])
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .rounded {
            width: auto;
            height: 80px;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <div id="auth">
            <div class="overlay">
                <div class="container">
                    <div class="row bg-body">
                        <div class="col-6 p-0">
                            <img src="{{ URL('images/vet.jpg') }}" class="img-fluid">
                        </div>
                        <div class="col-6 p-5">

                            <form id="login" action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="d-flex flex-column mb-3">
                                    <div class="py-2"><h5>¡Bienvenido!</h5> </div>
                                    <div class="py-2 mb-4"><span>Inicia sesión para continuar... </span></div>
                                    <div class="mb-3">
                                        <label for="form2Example17" class="form-label">Usuario</label>
                                        <input type="email" name="email" class="form-control" id="form2Example17"
                                            placeholder="name@example.com">
                                    </div>
                                    <div class="mb-3">
                                        <label for="form2Example27" class="form-label d-flex justify-content-between">
                                            Contraseña
                                            <span> <a class="small text-muted" href="{{ route('password.request') }}">Olvidate tu
                                                contraseña?</a></span>
                                        </label>
                                        <input type="password" name="password" class="form-control" id="form2Example27">
                                    </div>
                                    <div class="my-3 text-center">
                                        <button class="btn btn-primary w-100" type="submit">Iniciar Sesión</button>
                                    </div>
                                    @if ($errors->has('isDeactivated'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ $errors->first('isDeactivated') }}
                                        </div>
                                    @endif

                                    @if ($errors->has('invalidCredentials'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ $errors->first('invalidCredentials') }}
                                        </div>
                                    @endif
                                    <hr>
                                    <div>
                                        <p class="mb-2 text-center" >
                                            <span>
                                                ¿No tiene una cuenta?
                                            <a href="{{ route('register') }}" > Regístrate</a>
                                            </span>

                                        </p>
                                    </div>
                                    <div class="text-center mt-3">
                                        <span>
                                            <a href="http://127.0.0.1:8000" id="inicio" >
                                                <i class="bi bi-arrow-left-circle-fill"></i>
                                                Volver al inicio
                                            </a>
                                        </span>

                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
