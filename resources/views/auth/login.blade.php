<!DOCTYPE html>
<html lang="en">

<head>
    @vite('resources/css/app.css')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">



    <!-- Style CSS -->
    <link rel="stylesheet" href="path/to/tailwind.css">
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nav-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nav-usuario.css') }}">

    <!-- Scrollreveal -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Font awesoma -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- Notificaciones Toastr --}}
    <link rel="stylesheet" href="{{ asset('plugins\toastr\toastr.min.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sportivo - login</title>
</head>

<body>
    <div class="flex justify-content-center  my-5">
        <div class="w-fit ">
            <div class="card shadow-2xl ">
                <div class=" flex items-center border pr-2">

                    <img src="{{ asset('assets/img/sportivo-logo.svg') }}" style="width:130px" class="m-2"
                        alt="" draggable="false">
                    <h1 class="mt-3 px-2 underline" style="text-underline-offset: 6px; font-size: 24pt">Inicio de sesión</h1>
                </div>


                <div class="card-body pb-0">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">

                            <div class="flex justify-center">


                                <div class="col-md-9 ">

                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" placeholder="name@example.com" required autocomplete="email"
                                            autofocus name="email" value="{{ old('email') }}">
                                        <label for="email">Correo electrónico</label>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                El correo o la contraseña están mal
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="flex justify-center">
                                <div class="col-md-9 ">

                                    <div class="form-floating">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autofocus autocomplete="current-password" id="password"
                                            placeholder="Password">
                                        <label for="password">Contraseña</label>
                                        @error('password')
                                            <div class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center mb-3">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Recordame') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <div class="">

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste la contraseña?') }}
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="flex justify-center mb-0">
                            <div class="col-md-5 grid">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Entrar') }}
                                </button>
                            </div>
                        </div>

                        <div class="mt-4">

                            <p class="text-center">
                                ¿No tenés cuenta? <br>
                                <a href="{{ route('register') }}">
                                    Registrate
                                </a>
                            </p>
                        </div>


                    </form>
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <a class="btn btn-secondary hover:scale-105" href="{{ route('home') }}">PÁG. INICIO</a>
            </div>
        </div>
    </div>

</body>

</html>
