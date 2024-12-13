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
            @else
                <!-- Usuario Logueado -->
                <div class="usuario-logueado mt-1">


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
                                    <img src="{{asset('assets/img/sportivo-logo.svg')}}" alt="" draggable="false" class="max-w-[50%] h-auto" style="max-height: 50%;">
                                </div>
                            </div>

                        </ul>
                    </div>


                </div>
            @endguest
            <!-- Ayuda -->
            <div class=" mt-1 " style="margin-left:10px;">


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

        <div class="flex center ml-5">
            <div class="">
                <div class="mx-2" style="">
                    <a href="{{ route('ir_admin') }}" class="">
                        <img src="{{asset('assets/img/sportivo-logo.svg')}} " alt="logo sportivo" draggable="false" class="p-1 hover:scale-105" style="background-color: white; width: 58px; height:49.5px; border-radius: 100%;  box-shadow: 0px 0px 4px #fff">
                    </a>
                </div>

            </div>
            
            <div class="">
                <a href="{{ route('home') }}" class="btn btn-danger animated-btn" style="box-shadow: 0px 0px 1px #000000">IR A TIENDA SPORTIVO</a>
            </div>
        </div>

        <div class="right d-flex">




            <div class=" p-0 mr-5 mt-1">


                <!-- Direccion -->
                <div class="direccion mt-1">
                    <span class="svg-home">
                        <i class="fa-solid fa-house"></i>
                    </span>
                    <span class="address">

                        Gutemberg 7 bis, San nicolás
                    </span>

                </div>
            </div>
            {{-- <div class="d-flex " id="contenedor-dropdown-idiomas" style="">
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

            </div> --}}
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

<style>
    .animated-btn {
        position: relative;
        box-shadow: 0px 0px 1px #000000;
        color: #fff;
        text-decoration: none;
        padding: 10px 20px;
        font-size: 16px;
        display: inline-block;
        overflow: hidden;
    }

    .animated-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.4);
        box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.7);
        transition: transform 0.5s ease;
    }

    .animated-btn {
        animation: shadow-move 2s infinite linear;
    }

    @keyframes shadow-move {
        0% {
            box-shadow: 0px 0px 5px #ffffff;
        }
        50% {
            box-shadow: 0px 0px 20px #ffffff;
        }
        100% {
            box-shadow: 0px 0px 5px #ffffff;
        }
    }
</style>