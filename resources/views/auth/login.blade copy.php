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
                    <main>
                        <div class="d-flex justify-content-center">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="row align-items-center">
                                        <div class="col-5">
                                            <img src="https://i.pinimg.com/474x/75/b8/59/75b8594198d0fb111afc7778cbd20fb6.jpg"
                                                alt="login form" class="img-fluid" />
                                        </div>
                                        <div class="col-7">
                                            <form action="{{ route('login') }}" method="post">
                                                @csrf
                                                <div class="row text-center p-4">
                                                    <div class="col-12 d-flex justify-content-center">
                                                        <img src="{{ URL('images/vet.PNG') }}"
                                                            class="rounded float-start p-0">
                                                    </div>
                                                    <div class="col-12">
                                                        <h1>Iniciar Sesion</h1>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="email" name="email" id="form2Example17"
                                                            class="form-control form-control-lg" />
                                                        <label class="form-label" for="form2Example17">Ingresa tu
                                                            correo electronico
                                                            o usuario</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="password" name="password" id="form2Example27"
                                                            class="form-control form-control-lg" />
                                                        <label class="form-label" for="form2Example27">Ingrese su
                                                            contraseña</label>
                                                    </div>
                                                    <div class="pt-1 mb-4">
                                                        <button class="btn btn-dark btn-lg btn-block"
                                                            type="submit">Ingresar</button>
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


                                                    <a class="small text-muted"
                                                        href="{{ route('password.request') }}">Olvidate tu
                                                        contraseña?</a>
                                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Desea crear una
                                                        cuenta? <a href="{{ route('register') }}"
                                                            style="color: #393f81;">Registrarse</a>
                                                    </p>

                                                    <a href="http://127.0.0.1:8000"
                                                        class="btn btn-dark btn-lg btn-block" type="button">Ventana
                                                        inicio -></a>
                                                    <!--<a href="#!" class="small text-muted">Privacy policy</a>-->

                                                </div>


                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </main>
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
