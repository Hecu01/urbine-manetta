<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        
        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Style CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/nav-admin.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/nav-usuario.css') }}">
        
        
        
        {{-- Tailwind local --}}
        @vite('resources/css/app.css')
        <!-- Scrollreveal -->
        <script src="https://unpkg.com/scrollreveal"></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        
        <!-- Font awesoma -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- Scripts -->
        @vite(['resources/sass/app.scss'])

        {{-- Notificaciones Toastr --}}
        <link rel="stylesheet" href="{{ asset('plugins\toastr\toastr.min.css') }}">

        <title>{{ isset($title) ? $title : 'Sitio Web' }}</title>
    </head>
    <body >

        <!-- Navigator admin -->
        <x-nav-admin/>
        
        <!-- Sección principal -->
        <div class="section-principal " id="seccion-recontraprincipal">
            <section class="flex" style="padding-top: 5px; justify-content:space-between" >
                @yield('section-principal')
            </section>
        </div>

        <!--Footer-->
        <x-footer/>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            // mostrar imagen en el form
            function previewImage(event, querySelector){
        
                //Recuperamos el input que desencadeno la acción
                const input = event.target;
            
                //Recuperamos la etiqueta img donde cargaremos la imagen
                $imgPreview = document.querySelector(querySelector);
            
                // Verificamos si existe una imagen seleccionada
                if(!input.files.length) return
            
                //Recuperamos el archivo subido
                file = input.files[0];
            
                //Creamos la url
                objectURL = URL.createObjectURL(file);
            
                //Modificamos el atributo src de la etiqueta img
                $imgPreview.src = objectURL;
                    
            }
    
     
        </script>

        <script src="{{ asset('assets/js/scrollreveal.js')}}"></script>
        <script src="{{ asset('assets/js/admin.js') }}" ></script>
        <script src="{{ asset('assets/js/Descuentos.js') }}" ></script>
        <script src="{{ asset('assets/js/ArticulosDeportivos.js') }}" ></script>
        <script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    
</html>
