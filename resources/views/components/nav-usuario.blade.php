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
<nav class="navbar bg-white" id="navigator-usuario" style="position: relative">
    <div class="container-fluid" id="top-navigator">
        <div class="left flex">
            @guest
                <!-- Usuario no logueado -->
                <div class="w-32 mb-1 mr-3">
                    <img src="{{ asset('assets/img/sportivo-logo.svg') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div class="usuario-logueado false items-center">
                    <a href="{{ route('login') }}"
                        class="text-black font-custom-roboto text-base font-bold hover:scale-110 no-underline mx-2">Entrar</a>
                    <a href="{{ route('register') }}"
                        class="text-black font-custom-roboto text-base font-bold hover:scale-110 no-underline mx-2">Registrarse</a>
                    {{-- <div class="dropdown ">
                        <a href="#"style="color: #fff; text-decoration:none" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Usuarios
                            <i class="fa-solid fa-user"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('login') }}">Entrar</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Registrarse</a></li>
                        </ul>
                    </div> --}}



                </div>
            @else
                <!-- Usuario Logueado -->
                <div class="usuario-logueado items-center">

                    <!-- Usuario -->
                    <div class="w-32 mr-3">
                        <img src="{{ asset('assets/img/sportivo-logo.svg')}}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <div class="dropdown " id="contenedor-funciones-usuario">
                        <a href="#" class="dropdown-toggle username font-custom-roboto text-black p-1 text-base"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Usuario: {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu w-16" id="funciones">
                            <li><a class="dropdown-item" href=" {{ route('mi-perfil.index') }} "><i
                                        class="fa-solid fa-user mx-1"></i> Mi perfil</a></li>
                            <li><a class="dropdown-item" href="{{ asset('compras-realizadas') }} "><i class="fa-solid fa-bag-shopping"></i> Compras</a>
                            </li>
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
                        <a href="#" class="font-custom-roboto text-black flex items-center" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="notificacion" style="margin-left: 10px;">
                                <i class="fa-solid fa-bell text-xl hover:text-gray-500"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu absolute left-0 mt-1 w-96 h-64 hidden">
                            <div class="h-full" id="notificaciones-container">
                                <div class="top">
                                    <h1 class="text-lg text-center border-b uppercase py-1">No hay notificaciones nuevas
                                    </h1>
                                </div>
                                <div class="no-notificaciones flex content-center justify-center mt-5 opacity-30 scale-105">
                                    <img src="{{ asset('assets/img/sportivo-logo.svg') }}" alt="" draggable="false"
                                        class="max-w-[50%] h-auto" style="max-height: 50%;">
                                </div>
                            </div>
                        </ul>
                    </div>

                    {{-- <div class="dropdown">
                        <a href="#" class="font-custom-roboto text-black" data-bs-toggle="dropdown" aria-expanded="false">
                            <span style="margin-left: 10px;">
                                <i class="fa-solid fa-bell text-xl hover:text-gray-500" ></i>
                            </span>
                        </a>

                        
                    </div> --}}

                    <!-- Ayuda -->
                    <div class="dropdown">
                        <a href="#" style="color: black" data-bs-toggle="dropdown" aria-expanded="false">
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

        <div class="right d-flex">




            <div class=" p-0 mr-5 mt-1">


                <!-- Direccion -->
                <div class="direccion mt-1 text-black">
                    <span class="svg-home">
                        <i class="fa-solid fa-house"></i>
                    </span>
                    <span class="address">

                        Gutemberg 7 Bis, San nicolás
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
                    <ul class="dropdown-menu w-16 mt-0" id="dropdown-idiomas"
                        style="text-align:end; margin-left: -20px">
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
    <div
        class="bottom-nav d-flex text-black font-custom-roboto text-base font-bold absolute bg-transparent pb-4 md:text-xs md:relative md:m-2">

        <a class="nav-link mx-3 hover:scale-110 hover:underline hover:underline-offset-4" href="{{ route('home') }}">
            INICIO
        </a>
        <div class="nav-item dropdown">
            <a class="nav-link mx-3 hover:scale-110 hover:underline hover:underline-offset-4"
                href="{{ route('buscar', ['generos' => ['masculino', 'unisex'], 'publico_dirigido' => ['adultos']]) }}"
                id="navbarDropdown" role="button" {{-- data-bs-toggle="dropdown" 
                aria-expanded="false" --}}>
                HOMBRE
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item"
                        href="{{ route('buscar', ['generos' => ['masculino', 'unisex']]) }}">Hombre</a>
                </li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <div class="nav-item dropdown">
            <a class="nav-link mx-3 hover:scale-110 hover:underline hover:underline-offset-4"
                href="{{ route('buscar', ['generos[]' => ['femenino', 'unisex'], 'publico_dirigido' => ['adultos']]) }}"
                id="navbarDropdown" role="button" {{-- data-bs-toggle="dropdown" 
                aria-expanded="false" --}}>
                MUJER
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Mujer</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <div class="nav-item dropdown">
            <a class="nav-link mx-3 hover:scale-110 hover:underline hover:underline-offset-4"
                href="{{ route('buscar', ['generos' => ['niños', 'unisex'], 'publico_dirigido' => ['niños']]) }}"
                id="navbarDropdown" role="button" {{-- data-bs-toggle="dropdown" 
                aria-expanded="false" --}}>
                NIÑOS
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Niños</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <div class="nav-item dropdown">
            <a class="nav-link mx-3 hover:scale-110 hover:underline hover:underline-offset-4" href="#"
                id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                DEPORTE
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach ($allDeportes as $deporte)
                    <li>
                        <a class="dropdown-item"
                            href="{{ route('buscar', ['deportes' => $deporte]) }}">{{ $deporte }}</a>
                    </li>
                @endforeach
            </ul>
        </div>



        @guest
        @else
            @if (Auth::user()->administrator == true)
                <div class="">

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



    </div>
    <div class="bottom-bottom-nav bg-slate-200 p-2 mt-4">

        {{-- Invitado --}}
        @guest

            <div class="dropdown " id="carrito-de-compras">
                <button style="color: black;" data-bs-toggle="modal" data-bs-target="#miModal" type="button">
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
            <div class="dropdown " id="carrito-de-compras" >
                <a href="#" class="btn btn-secondary" style="margin-top: -4px;  text-decoration: none"
                    data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="modal" data-bs-target="#miModal">
                    <span style="">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </span>
                    Carrito

                    @php
                        $cantCarrito = 0;
                        foreach ($cartItems as $item) {
                            $cantCarrito = $cantCarrito + 1;
                        }
                    @endphp


                    <span class="badge bg-danger">

                        {{ $cantCarrito }}
                    </span>
                </a>

                <ul class="dropdown-menu   " style="min-width:500px">
                        <div class="">

                            <h1 class="text-lg text-center shadow-sm  uppercase bg-slate-500  text-white hover:bg-black-600">Carrito de compras</h1>
                        </div>
                        
                        <div class=" overflow-y-auto " style="max-height:500px">
                           

                            @foreach ($cartItems as $item)
                                <div class="flex h-fit m-1 mt-3 mx-3" >
                                    <div class="pb-2">
                                            {{-- Recuperar el artículo desde la base de datos usando el ID --}}
                                        @php
                                            $articulo = \App\Models\Articulo::find($item['id']);
                                        @endphp

                                        {{-- Verificar si el artículo existe y tiene fotos --}}
                                        @if ($articulo && $articulo->fotos)
    @php
        $firstFoto = $articulo->fotos->first(); // Obtiene la primera foto
    @endphp
    @if ($firstFoto)
        <img src="{{ url('productos/' . $firstFoto->ruta) }}" alt="" width="100px" height="100px">
    @endif
@endif

                                    </div>
                                    <div>
    
                                        <ul class="font-semibold">
                                            <li>{{ $item['name'] }}</li>
                                            <li >
                                                {{-- Precio: $ {{ number_format($item['price'], 0, ',', '.') }} AR --}}
                                                Precio: $ {{ number_format($item['price'], 0, ',', '.') }} AR
                                                {{-- <span class="bg-red-500 text-white"
                                                style="padding: 0px 3px ;font-size:13px; right:38px; top:106px; font-family:'Times New Roman', Times, serif">
                                                - 20%
                                                    OFF
                            
                            
                                                </span> --}}
                                            </li>
                                            <li>Total: ${{ number_format($item['total_price'], 0, ',', '.') }}</li>

                                            @if($item['calzadoTalle'] !== null)
                                                <li>
                                                    Talle: N° {{ $item['calzadoTalle'] }} 
                                                </li>
                                            @endif
                                            <li>
                                                Cantidad: {{ $item['quantity'] }} 
                                                <div class="mx-1 inline">

                                                    <!--
                                                     <button class="btn btn-success btn-sm" style="font-size: .67rem">+</button>
                                                    <button class="btn btn-danger btn-sm" style="font-size: .67rem">-</button> 
                                                   -->
                                                    <!-- Botón de Eliminar -->
                                                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-dark btn-sm" style="font-size: .67rem" type="submit" title="Quitar del carrito"> 

                                                            <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    
                                </div>
                                <hr>
                            @endforeach
                        </div>
                        <div class="flex justify-center"  >

                            <a href="{{ route('carrito.index') }}" class="shadow-sm border-t no-underline bg-rose-500  text-white hover:bg-rose-600 p-1 px-3 rounded text-lg" style=" display: block;  text-align: center;">Entrar al carrito</a>
                        </div>


                </ul>
            </div>
        @endguest

        <div class="busqueda col-6">
            <form class="d-flex" action="{{ route('buscar') }}" method="GET">
                <input class="form-control me-2 " type="search" required name="articulo-buscado"
                    placeholder="Buscá lo que necesitás acá" aria-label="Search">
                <button class="btn bg-black text-white" type="submit"> <span><i
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

    var notificaciones = 0;
    var notificacion = document.querySelector("button");
    var campana = document.querySelector(".notificacion");
    notificacion.onclick = function() {
        notificaciones++;
        campana.classList.add("show-count");
        campana.classList.add("notify");
        campana.setAttribute("data-count", notificaciones);
    }

    campana.addEventListener("animationend", function() {
        campana.classList.remove("notify");
    })
</script>
