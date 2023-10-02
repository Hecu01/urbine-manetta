<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        
        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <!-- Style CSS -->
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
        <title>{{ isset($title) ? $title : 'Sitio Web' }}</title>
    </head>
    <body >

        
        <!-- Si es admin, podrá acceder al crud, sino, no. -->
        @guest 
            <x-nav-public/>
        @else    
            @if (Auth::user()->administrator == false)
                <x-nav-usuario/>
            @else
                <x-nav-admin/>
            @endif
        @endguest 

        <!-- Sección principal -->
        <div class="">
            <section>
                @yield('section-principal')
            </section>
        </div>

        <!--Footer-->
        <x-footer/>






        <script src="{{ asset('assets/js/scrollreveal.js')}}"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
    
</html>
