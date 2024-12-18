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
    <title>Sportivo - Registro</title>
</head>
<body>
    <div class="flex justify-content-center  my-2">
        <div class="w-fit ">

            <div class="card shadow-2xl ">
                <div class=" flex items-center border pr-2">

                    <img class="m-2 opacity-90" src="{{asset('assets/img/sportivo-logo.svg')}}" style="width:130px" alt="" draggable="false">
                    <h1 class="mx-2 mt-1 underline" style="text-underline-offset: 6px; font-size: 28pt">Registrarse</h1>
                </div>


                <div class="card-body pb-0" style="max-width: 400px">
                    <form method="POST"  action="{{ route('register') }}" enctype="multipart/form-data" id="register-user-form">
                        @csrf

                        <div class="row ">
                            <div class="flex justify-center">
                                <div class="col-md-9 ">
                                    <h3 class="text-center">Tu foto de perfil</h3>
                                    <div class="container d-flex justify-content-center shadow-sm border-2 " style="height: 250px;width:250px;  display:flex; justify-content: center;align-items:center;  background:#fff; ">
                                        <!-- Carrusel para previsualizar imágenes -->
                                        <div id="imagePreviewCarousel" class="carousel slide" data-bs-ride="carousel"  data-bs-interval="3000">
                                            <div class="carousel-inner " id="imagePreviewInner"  style="height: auto; ">
                                                <!-- Las imágenes previsualizadas se mostrarán aquí -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 grid justify-center my-3 ">
                                        <label class=" btn text-white hover:scale-105 " for="imageInput" style="background-color: rgb(16, 153, 163);text-align:center; width:100% ">
                                            <input type="file" name="foto" id="imageInput" multiple accept="image/*" required>
                                            Cargar foto
                                        </label>
                                        <div id="errorMessage" style="color: red; font-size: 14px; margin-top: 5px; display: none;">
                                            Falta cargar la foto
                                        </div>
                                        @if ($errors->has('foto'))
                                            <div class="error-message" style="color: red">La foto es necesaria.</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row flex justify-center">
                            <div class="flex justify-center col-md-4">
                                <div class="col-md-12 ">

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
                            <div class="flex justify-center col-md-5" >
                                <div class="col-md-12">

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control   @error('apellido') is-invalid @enderror" id="apellido" placeholder="name@example.com"  name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                                        <label for="apellido">Apellido</label>
                                        @if ($errors->has('lastname'))
                                            <div class="error-message" style="color: red; margin-bottom:10px" >El Apellido es necesario</div>
                                        @endif
                                    </div>
    
    
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="flex justify-center">
                                <div class="col-md-9 ">

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('dni') is-invalid @enderror" 
                                        id="dni" placeholder="Ingrese su DNI" name="dni" 
                                        value="{{ old('dni') }}" required autocomplete="dni" autofocus 
                                        pattern="\d*" title="Solo se permiten números">
                                        <label for="dni">DNI (sin puntos)</label>
                                    </div>
    
                                    @if ($errors->has('dni'))
                                        <div class="error-message" style="color: red">El dni es absurdamente alto.</div>
                                    @endif
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
                                    @if ($errors->has('email'))
                                        <div class="error-message" style="color: red">El usuario ya existe</div>
                                    @endif

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
                                        <label for="password-confirm">Confirmar contraseña</label>
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
                                <button type="submit" class="btn btn-primary" id="registrar-usuario">
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
            <div class="flex justify-center  mt-4">
                <a class="btn btn-secondary hover:scale-105" href="{{ route('home') }}">PÁG. INICIO</a>
            </div>
        </div>
    </div>
    <script>
        // Validamos la imagen
        function validateImage() {
            const imageInput = document.getElementById('imageInput');
            const errorMessage = document.getElementById('errorMessage');

            // Check if any file is selected
            if (imageInput.files.length === 0) {
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
        }

        document.getElementById('registrar-usuario').addEventListener('click', function () {
            const imageInput = document.getElementById('imageInput');
            const errorMessage = document.getElementById('errorMessage');

            // Verifica si hay imágenes cargadas
            if (imageInput.files.length === 0) {
                errorMessage.style.display = 'block'; // Muestra el mensaje
            } else {
                errorMessage.style.display = 'none'; // Oculta el mensaje
                document.getElementById('register-user-form').submit(); // Envía el formulario
            }
        });
        
        document.addEventListener('DOMContentLoaded', function () {
            // Manejar cambios en el campo de entrada de imágenes
            document.getElementById('imageInput').addEventListener('change', handleImagePreview);
        });
    
        function handleImagePreview(event) {
            // Limpiar el carrusel de previsualización
            document.getElementById('imagePreviewInner').innerHTML = '';
    
            // Obtener archivos seleccionados
            const files = event.target.files;
    
            // Mostrar previsualización de imágenes
            for (const file of files) {
                const reader = new FileReader();
    
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('d-block');
                    img.style.height= '250px';
    
                    const item = document.createElement('div');
                    item.classList.add('carousel-item');
    
                    // Marcar el primer elemento como activo
                    if (document.getElementById('imagePreviewInner').childElementCount === 0) {
                        item.classList.add('active');
                    }
    
                    item.appendChild(img);
                    document.getElementById('imagePreviewInner').appendChild(item);
                };
    
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>



