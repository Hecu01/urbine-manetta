<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap 5 -->


    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}


    {{-- Tailwind local --}}

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
    <link rel="stylesheet" href="{{ asset('assets/css/principal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/filter.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/errores.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/VerProducto.css') }}">

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
    <title>{{ isset($title) ? $title : 'Sportivo' }}</title>


</head>

<body class="theme-light">

    <!-- Navegación -->
    <x-nav-usuario :allDeportes="$allDeportes ?? []" />


    <!-- Sección principal -->
    <div class="">
        <section>
            @yield('section-principal') 
        </section>
    </div>

    <!--Footer-->
    <x-footer />

    <!-- Scripts -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Incluir JS de Bootstrap y jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="{{ asset('assets/js/scrollreveal.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/Nav-Usuario.js') }}"></script>
    <script src="{{ asset('assets/js/VerProducto.js') }}"></script>
    <script src="{{ asset('assets/js/OnlyNumbers.js') }}"></script>
</body>

</html>
