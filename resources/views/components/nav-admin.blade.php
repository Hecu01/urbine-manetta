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


                    <li class="nav-item dropdown  " style="color: #fff; list-style: none; margin-top: -5px;">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                            style="color: #fff; height:20px; padding:3px;" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            <span>
                                <i class="fa-solid fa-user"></i>
                            </span>
                            Usuario: {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" style="margin-top: 15px;"
                            aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}"method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <!-- Notificaciones -->
                    <div class="dropdown">
                        <a href="#" style="color: #fff" data-bs-toggle="dropdown" aria-expanded="false">
                            <span style="margin-left: 10px;margin-top: 5px;">
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


                </div>
            @endguest
            <!-- Ayuda -->
            <div class=" " style="margin-left:10px;">


                <div class="dropdown ">
                    <a href="#" style="color: currentcolor; text-decoration:none" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        
                        <i class="fa-regular fa-circle-question"></i>
                    </a>

                    <ul class="dropdown-menu">
                        <li class="hover:bg-cyan-500"><a class="dropdown-item" href="#">¿Cómo comprar?</a></li>
                        <li><a class="dropdown-item" href="#">¿Cómo canjear puntos?</a></li>
                        <li><a class="dropdown-item" href="#">Manual de usuario</a></li>
                    </ul>
                </div>



            </div>

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


        <div class="" >

            <a href="{{ route('home') }}" class="btn btn-success btn-sm">TIENDA</a>
            <a href="{{ route('ir_admin') }}" class="btn btn-danger btn-sm">ADMINISTRACIÓN</a>
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
