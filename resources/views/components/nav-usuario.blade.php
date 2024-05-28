@php
    use App\Models\Deporte;
    $carrito = session()->get('carrito', []);
    // Convierte el carrito en una colección para ser compatible con darryldecode/cart
    $cartItems = collect($carrito);
    $contarItems = collect($carrito)->count();

    // Obtener categorías únicas
    $categorias = Deporte::distinct()->pluck('categoria_deporte');
    $deportes = Deporte::orderBy('deporte', 'asc')->get();
    // Cargar los deportes por categoría
    $deportesPorCategoria = [];
    foreach ($categorias as $categoria) {
        $deportesPorCategoria[$categoria] = Deporte::where('categoria_deporte', $categoria)
            ->orderBy('deporte', 'asc')
            ->get();
    }

@endphp
<!-- Si es usuarioooo (no accedera al crud) -->
<nav class="navbar   " id="navigator-usuario" style="position: relative">
    <div class="container-fluid" id="top-navigator">
        <div class="left flex">
            @guest
                <!-- Usuario no logueado -->
                <div class="usuario-logueado false hover:scale-105 ">


                    <div class="dropdown ">
                        <a href="#"style="color: #fff; text-decoration:none" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Usuarios
                            <i class="fa-solid fa-user"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('login') }}">Entrar</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Registrarse</a></li>
                        </ul>
                    </div>



                </div>
            @else

                <!-- Usuario Logueado -->
                <div class="usuario-logueado ">

                    <!-- Usuario -->
                    <div class="dropdown" id="contenedor-funciones-usuario">
                        <a href="#" class="dropdown-toggle username pt-1" data-bs-toggle="dropdown" aria-expanded="false">
                            Usuario: {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu w-16 " id="funciones">
                            <li><a class="dropdown-item" href=" {{ route('mi-perfil.index') }} "><i class="fa-solid fa-user mx-1"></i> Mi perfil</a></li>
                            <li> 
                                <a class="dropdown-item" href="#" 
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-power-off mx-1"></i>
                                    Cerrar sesión
                                </a>
    
                                <form id="logout-form" action="{{ route('logout') }}"method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
    

                    <!-- Notificaciones -->
                    <div class="dropdown">
                        <a href="#" style="color: #fff" data-bs-toggle="dropdown" aria-expanded="false">
                            <span style="margin-left: 10px;">
                                <i class="fa-regular fa-bell"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu w-96 h-64">
                            <div class="h-100 " id="notificaciones-container">
                                <div class="top">
                                    <h1 class="text-lg text-center border-b uppercase py-1">No hay notificaciones nuevas
                                    </h1>
                                </div>
                                <div class="no-notificaciones flex content-center justify-center mt-5 opacity-50 scale-105">
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="" draggable="false">
                                </div>
                            </div>

                        </ul>
                    </div>

                    <!-- Ayuda -->
                    <div class="dropdown">
                        <a href="#" style="color: #fff" data-bs-toggle="dropdown" aria-expanded="false">
                            <span style="margin-left: 10px;">
                                <i class="fa-regular fa-circle-question"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">¿Cómo comprar?</a></li>
                            <li><a class="dropdown-item" href="#">¿Cómo canjear puntos?</a></li>
                            <li><a class="dropdown-item" href="#">Manual de usuario</a></li>
                        </ul>
                    </div>


                </div>
            @endguest


        </div>
        {{-- <div class="center pl-5">

            <!-- Logo y nombre -->
            <div class="logo-y-nombre ">
                <a href="{{ route('home') }}"
                    class="flex items-center text-white decoration-none text-2xl hover:text-3xl">

                    <div class="imagen-logo mx-1">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" draggable="false">
                    </div>

                    Sportivo
                </a>
            </div>
        </div> --}}
        <div class="right d-flex">




            <div class=" p-0 mr-5 mt-1">


                <!-- Direccion -->
                <div class="direccion mt-1">
                    <span class="svg-home">
                        <i class="fa-solid fa-house"></i>
                    </span>
                    <span class="address">

                        De la nación 356, San nicolás
                    </span>

                </div>
            </div>
            <div class="d-flex " id="contenedor-dropdown-idiomas" style="">
                <div class="dropdown" id="display-dropdown">
                    <a href="#" class="dropdown-toggle flex items-center pt-1"
                        style="color: #fff; text-decoration: none" data-bs-toggle="dropdown" aria-expanded="false">
                        ES /
                        <span style="">
                            <img src="{{ asset('assets/img/español.jpg') }}" alt="" class="w-8 mx-1">
                        </span>
                    </a>
                    <ul class="dropdown-menu w-16" id="dropdown-idiomas" style="text-align:end; margin-left: -20px">
                        <li>
                            <a class="dropdown-item h-8 flex items-center" style="color:#fff" href="#">Español
                                <span class="mx-1  ">
                                    <img src="{{ asset('assets/img/español.jpg') }}" alt="" class="w-8 mx-1"
                                        style="margin-top:-20px">
                                </span>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item h-8 flex items-center" style="color:#fff"
                                href="#">Portugués
                                <span class="mx-1  ">
                                    <img src="{{ asset('assets/img/portugues.jpg') }}" alt=""
                                        class="w-8 mx-1" style="margin-top:-20px">
                                </span>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item h-8 flex items-center" style="color:#fff" href="#">Inglés
                                <span class="mx-1  ">
                                    <img src="{{ asset('assets/img/ingles.jpg') }}" alt="" class="w-8 mx-1"
                                        style="margin-top:-20px">
                                </span>
                            </a>
                        </li>

                    </ul>
                </div>

            </div>
        </div>



    </div>
    <div class="bottom-nav d-flex text-cyan-700 " >

        <a class="nav-link text-cyan-700 font-serif text-lg mx-2" style="font-family:sans-serif; text-decoration:underline"  href="{{ route('home') }}" >
            Inicio
        </a>
        <div class="nav-item dropdown">
            <a class="nav-link text-cyan-700 font-serif text-lg mx-2" style="font-family:sans-serif; text-decoration:underline"  href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Hombre
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Hombre</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <div class="nav-item dropdown">
            <a class="nav-link text-cyan-700 font-serif text-lg mx-2" style="font-family:sans-serif; text-decoration:underline"  href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Mujer
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Mujer</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <div class="nav-item dropdown">
            <a class="nav-link text-cyan-700 font-serif text-lg mx-2" style="font-family:sans-serif; text-decoration:underline"  href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Niños
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Niños</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <div class="nav-item dropdown">
            <a class="nav-link text-cyan-700 font-serif text-lg mx-2" style="font-family:sans-serif; text-decoration:underline"  href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Deporte
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Deporte</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        @guest 
        @else    
            @if (Auth::user()->administrator == true)
                <div class="" >
    
                    <a href="{{ route('ir_admin') }}" class="btn btn-danger btn-sm">ADMINISTRACIÓN</a>
                </div>
            @endif
        @endguest 


        <div>
            <a href="#" class="boton-categoria">
                {{-- Hombres --}}
            </a>

            <div class="absolute bg-blue-500 text-white boton-categoria" id="contenedor-hombres"
                style="left: 0; width:100%; z-index:2; display:none; min-height:200px; height:auto;">
                <div class="flex">
                    <div class="">
                        <h2>Ropa</h2>
                        <ul>
                            @foreach ($deportes as $deporteee)
                                <li>
                                    <a href="#" class="text-white avl" onclick="buscarArticulo(this)">
                                        {{ trim($deporteee->deporte) }}
                                    </a>
                                </li>
                            @endforeach

                            {{-- <li><a href=""class="text-white avl">Zapatillas</a></li>
                                <li><a href="" class="text-white avl">Botines</a></li>
                                <li><a href="" class="text-white avl">Zapatillas para correr</a></li>
                                <li><a href="" class="text-white avl">Botas de fútbol</a></li>
                                <li><a href="" class="text-white avl">Zapatos de baloncesto</a></li>
                                <li><a href="" class="text-white avl">Zapatillas de tenis</a></li> --}}
                            <style>
                                .avl {
                                    text-decoration: none
                                }
                            </style>



                        </ul>

                    </div>
                    <div class="">
                        <h2>Ropa</h2>
                        <ul>
                            <li><a href="" class="text-white avl">Canilleras</a></li>
                            <li><a href=""class="text-white avl">Zapatillas</a></li>
                            <li><a href="" class="text-white avl">Botines</a></li>
                            <li><a href="" class="text-white avl">Zapatillas para correr</a></li>
                            <li><a href="" class="text-white avl">Botas de fútbol</a></li>
                            <li><a href="" class="text-white avl">Zapatos de baloncesto</a></li>
                            <li><a href="" class="text-white avl">Zapatillas de tenis</a></li>
                            <style>
                                .avl {
                                    text-decoration: none
                                }
                            </style>



                        </ul>

                    </div>
                    <div class="">
                        <h2>Ropa</h2>
                        <ul>
                            <li><a href="" class="text-white avl">Canilleras</a></li>
                            <li><a href=""class="text-white avl">Zapatillas</a></li>
                            <li><a href="" class="text-white avl">Botines</a></li>
                            <li><a href="" class="text-white avl">Zapatillas para correr</a></li>
                            <li><a href="" class="text-white avl">Botas de fútbol</a></li>
                            <li><a href="" class="text-white avl">Zapatos de baloncesto</a></li>
                            <li><a href="" class="text-white avl">Zapatillas de tenis</a></li>
                            <style>
                                .avl {
                                    text-decoration: none
                                }
                            </style>



                        </ul>

                    </div>
                </div>
            </div>
        </div>


        {{-- @foreach ($deportesPorCategoria as $categoria => $deportes)
                {{-- <a href="" >
                    {{ $categoria }}       
                </a> 
                <ul >
                    @foreach ($deportes as $deporte)
                        <li>{{ $deporte->nombre }}</li>
                    @endforeach
                </ul>
            @endforeach --}}


    </div>
    <div class="bottom-bottom-nav">

        {{-- Invitado --}}
        @guest

            <div class="dropdown " id="carrito-de-compras">
                <button style="color: #fff" data-bs-toggle="modal" data-bs-target="#miModal" type="button">
                    <span style="margin-left: 10px;margin-top: 5px;">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </span>
                </button>



            </div>
            <!-- Modal -->
            <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content text-black">
                        <div class="modal-header">
                            <h5 class="modal-title text-xl" id="miModalLabel">Atención!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body text-center">
                            <!-- Contenido del modal -->

                            <p class="text-xl  ">Inicia sesión o regístrate para poder comprar o agregar al carrito</p>
                            <a class="btn btn-primary" href="{{ route('login') }}">Entrar</a>
                            <a class="btn btn-primary" href="{{ route('register') }}">Registrarse</a>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Logueado --}}
        @else
            <div class="dropdown " id="carrito-de-compras">
                <a href="#"style="color: #fff" data-bs-toggle="dropdown" aria-expanded="false"
                    data-bs-toggle="modal" data-bs-target="#miModal">
                    <span style="margin-left: 10px;margin-top: 5px;">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </span>
                </a>

                <ul class="dropdown-menu w-96 h-96 ">
                    @if ($contarItems > 0)
                        <h1 class="text-lg text-center ">Carrito de compras</h1>
                        @foreach ($cartItems as $item)
                            <div class="flex">
                                <div class="">
                                    <img src="{{ $item['imagen'] }}" alt="">

                                </div>
                                <div>
                                    <img src="{{ url('producto/' . $item['imagen']) }}" alt="" width="70px"
                                        height="70px">
                                    <p>ID: {{ $item['id'] }}</p>
                                    <p>Nombre: {{ $item['name'] }}</p>
                                    <p>Precio: {{ $item['price'] }}</p>
                                    <p>Cantidad: {{ $item['quantity'] }}</p>
                                    <hr>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h1 class="text-lg text-center ">El carrito está vacío</h1>
                    @endif

                    {{-- <li>
                        <a class="dropdown-item dropdown" href="#">Español</a>                
                    </li> --}}

                </ul>
            </div>
        @endguest

        <div class="busqueda col-6">
            <form class="d-flex" action="{{ route('buscar') }}" method="GET">
                <input class="form-control me-2 " type="search" required name="articulo-buscado"
                    placeholder="Buscá lo que necesitás acá" aria-label="Search">
                <button class="btn btn-danger" type="submit"> <span><i
                            class="fa-solid fa-magnifying-glass"></i></span></button>
            </form>
        </div>
    </div>

</nav>


<script>
    function buscarArticulo(elemento) {
        var texto = elemento.textContent || elemento.innerText;
        var url = 'http://127.0.0.1:8000/buscar?articulo-buscado=' + encodeURIComponent(texto);
        window.location.href = url;
    }
</script>
