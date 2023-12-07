{{-- @extends('layouts.app')
@section('section-principal')    
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6" id="registro">
                <div class="card esteform">
                    <div class="card-header">{{ __('Registrarse') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
    
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar contraseñas') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
    
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrarse') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection --}}




<!DOCTYPE html>
<html lang="en">
<head>
    @vite('resources/css/app.css')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">



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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- Notificaciones Toastr --}}
    <link rel="stylesheet" href="{{ asset('plugins\toastr\toastr.min.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sportivo - Register</title>
</head>
<body>
    <div class="flex justify-content-center  my-2">
        <div class="w-fit ">
            <div class="card shadow-2xl ">
                <div class=" flex items-center border pr-2">

                    <img class="ml-3" src="{{ asset('assets/img/logo.png') }}" alt="" draggable="false">
                    <h1 class=" ml-2 px-4  underline">Registrarse</h1>
                </div>


                <div class="card-body pb-0">
                    <form method="POST" action="{{ route('register') }}" >
                        @csrf

                        <div class="row ">
                            <div class="flex justify-center">
                                <div class="col-md-9 ">

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control   @error('nombre') is-invalid @enderror" id="floatingInput" placeholder="name@example.com"  name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        <label for="floatingInput">Nombre</label>
                                    </div>
    
    
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Las credenciales están incorrectas</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="flex justify-center">
                                <div class="col-md-9 ">

                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <label for="email">Correo Electrónico</label>
                                    </div>
    
                                    @error('correo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Las credenciales están incorrectas</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="flex justify-center">
                                <div class="col-md-9 ">

                                    <div class="form-floating">
                                        <input type="password"  class="form-control @error('password') is-invalid @enderror" name="password" required id="password" placeholder="Password" autocomplete="new-password">
                                        <label for="password">Contraseña</label>
                                    </div>



                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Las credenciales están incorrectas</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="flex justify-center">
                                <div class="col-md-9 ">

                                    <div class="form-floating">
                                        <input type="password" class="form-control"  name="password_confirmation" required id="password-confirm" placeholder="Password" autocomplete="new-password">
                                        <label for="password-confirm">Confirmar contrasñea</label>
                                    </div>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Las credenciales están incorrectas</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Nombre - correo - contraseña - confirmar contraseña --}}

                        <div class="flex justify-center mb-0">
                            <div class="col-md-5 grid">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrarse') }}
                                </button>

                            </div>
                        </div>
                        
                        <div class="mt-4">

                            <p class="text-center">
                                ¿Estás registrado? <br>
                                <a  href="{{ route('login') }}">
                                    Ingresar
                                </a>
                            </p>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>



