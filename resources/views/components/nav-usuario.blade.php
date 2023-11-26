<!-- Si es usuarioooo (no accedera al crud) -->
<nav class="navbar   " id="navigator-usuario" style="position: relative">
    <div class="container-fluid" id="top-navigator">
        <div class="left">
            @guest
                <!-- Usuario no logueado -->
                <div class="usuario-logueado false " >

        
                    <div class="dropdown " >
                        <a href="#"style="color: #fff; text-decoration:none" data-bs-toggle="dropdown" aria-expanded="false">
                            Usuarios
                            <i class="fa-solid fa-user"></i>
                        </a>
            
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('login')}}">Entrar</a></li>
                            <li><a class="dropdown-item" href="{{route('register')}}">Registrarse</a></li>
                        </ul>
                    </div>    



                </div>
            @else
                <!-- Usuario Logueado -->
                <div class="usuario-logueado " >

                    
                    <li class="nav-item dropdown  " style="color: #fff; list-style: none; margin-top: -5px;">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" style="color: #fff; height:20px; padding:3px;" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span>
                                <i class="fa-solid fa-user"></i>
                            </span>
                            Usuario: {{ Auth::user()->name }}
                        </a>
        
                        <div class="dropdown-menu dropdown-menu-end" style="margin-top: 15px;"  aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>
        
                            <form id="logout-form" action="{{ route('logout') }}"method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li> 
                    <!-- Notificaciones -->
                    <div class="dropdown">
                        <a href="#"  style="color: #fff" data-bs-toggle="dropdown" aria-expanded="false">
                            <span style="margin-left: 10px;margin-top: 5px;">
                                <i class="fa-regular fa-bell"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Español</a></li>
                            <li><a class="dropdown-item" href="#">Inglés</a></li>
                            <li><a class="dropdown-item" href="#">Portugués</a></li>
                        </ul>
                    </div>

                    <!-- Ayuda -->
                    <div class="dropdown">
                        <a href="#"  style="color: #fff" data-bs-toggle="dropdown" aria-expanded="false">
                            <span style="margin-left: 10px;margin-top: 5px;">
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
        <div class="center">

            <!-- Logo y nombre -->
            <div class="logo-y-nombre">
                <a href="{{ route('home')}}" class="flex items-center text-white decoration-none text-2xl hover:text-3xl">

                    <div class="imagen-logo mx-1">
                        <img src="{{ asset('assets/img/logo.png')}}" alt="" draggable="false">
                    </div>

                    Sportivo
                </a>
            </div>
        </div>
        <div class="right d-flex" >

            
            {{-- <!-- Búsqueda -->
            <div class="busqueda">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Búsqueda" aria-label="Search" >
                    <button class="btn btn-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div> --}}
            <div class="d-flex mx-3" id="contenedor-switch-cambio-tema" style="">
                <span class="">
                    <i class="fa-solid fa-sun"></i>
                </span>
                <div class="form-check form-switch" id="form-switch" style="">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                </div>
                <span class="">
                    <i class="fa-solid fa-moon"></i>
                </span>
            </div>
        
            <div class="d-flex " id="contenedor-dropdown-idiomas" style="">
                <div class="dropdown" id="display-dropdown">
                    <a href="#" class="dropdown-toggle flex items-center pt-1"  style="color: #fff; text-decoration: none" data-bs-toggle="dropdown" aria-expanded="false">
                        ES / 
                        <span style="">
                            <img src="{{ asset('assets/img/español.jpg')}}" alt="" class="w-8 mx-1">
                        </span>
                    </a>
                    <ul class="dropdown-menu w-16" id="dropdown-idiomas" style="text-align:end; margin-left: -20px">
                        <li >
                            <a class="dropdown-item h-8 flex items-center" style="color:#fff" href="#">Español 
                                <span class="mx-1  " >
                                    <img src="{{ asset('assets/img/español.jpg')}}" alt="" class="w-8 mx-1" style="margin-top:-20px">
                                </span>
                            </a>
                        </li>

                        <li >
                            <a class="dropdown-item h-8 flex items-center" style="color:#fff" href="#">Portugués 
                                <span class="mx-1  " >
                                    <img src="{{ asset('assets/img/portugues.jpg')}}" alt="" class="w-8 mx-1" style="margin-top:-20px">
                                </span>
                            </a>
                        </li>

                        <li >
                            <a class="dropdown-item h-8 flex items-center" style="color:#fff" href="#">Inglés 
                                <span class="mx-1  " >
                                    <img src="{{ asset('assets/img/ingles.jpg')}}" alt="" class="w-8 mx-1" style="margin-top:-20px">
                                </span>
                            </a>
                        </li>
                        {{-- <li>
                            <a class="dropdown-item h-8 flex items-center" style="color:#fff" href="#">Portugués
                                <span class="mx-1 ">
                                    <img src="{{ asset('assets/img/portugues.jpg')}}" alt="" class="w-8" >
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item h-8 flex items-center" style="color: #fff" href="#">Inglés 
                                <span class="mx-1 mt-6">
                                    <img src="{{ asset('assets/img/ingles.jpg')}}" alt="" class="w-8">
                                </span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
        
            </div>
        </div>


        
    </div>
    <div class="bottom-nav d-flex text-cyan-700"  style="flex-wrap: wrap;">

        <a href="{{ route('home') }}" class="hover:text-cyan-500">Inicio</a></li>
        

        <div id="li-hombres">
            <a href="#">
                Hombres
            </a>
            <div class="sub-li-hombres">
                <ul>
                    <li>
                        <a href=" #">
                            Hombres
                        </a>
                    </li>
                    <li>
                        Zapatillas
                        <div class="sub-li-zapatillas">
                            <ul>
                                <li>Running</li>
                                <li>Botines</li>
                                <li>Remeras</li>
                                <li>Pantalones</li>
                                <li>Calzas</li>
                            </ul>
                        </div> 
                    </li>
                    <li>
                        Botines
                        <div class="sub-li-zapatillas botines">
                            <ul>
                                <li>Talle 36-37</li>
                                <li>Talle 37-38</li>
                                <li>Talle 38-39</li>
                                <li>Talle 39-40</li>
                                <li>Talle 40-41</li>
                                <li>Talle 41-42</li>
                                <li>Talle 42-43</li>
                                <li>Talle 43-44</li>
                                <li>Talle 44-45</li>

                            </ul>
                        </div> 
                    </li>
                    <li>Remeras
                        <div class="sub-li-zapatillas remeras">
                            <ul>
                                <li>Talle L</li>
                                <li>Talle M</li>
                                <li>Talle XL</li>
                                <li>Talle XXL</li>
                                <li>Talle XXXL</li>

                            </ul>
                        </div> 

                    </li>
                    <li>Pantalones</li>
                    <li>Calzas</li>
                </ul>
            </div> 
        </div>
    
    
        <a href="">Mujeres</a>
        <a href="">Niños</a>
        <a href="">Niñas</a>
        <!-- {{-- <li><a href="">Deportes de campo</a></li>
        <li><a href="">Deportes de Gimnasio</a></li>
        <li><a href="">Deportes Cerrados</a></li> --}} -->
        <a href="">Artes Marciales y combate</a>
        <a href="">Fútbol</a>
        <a href="">Rugby</a>
        <a href="">Handball</a>
        <a href="">Natación</a>
        <a href="">Voley</a>
        <a href="">Running</a>
        <a href="">Hockey</a>
         <a href="">Basketball</a>
        <!-- {{-- <li><a href="">Boxeo</a></li>
        <li><a href="">Kingboxing</a></li>
        <li><a href="">Tae Kwondo</a></li> --}} -->

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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
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
                <a href="#"style="color: #fff" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="modal" data-bs-target="#miModal">
                    <span style="margin-left: 10px;margin-top: 5px;">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </span>
                </a>

                <ul class="dropdown-menu w-96 h-96 ">
                    <h1 class="text-lg text-center ">El carrito está vacío</h1>
                    {{-- <li>
                        <a class="dropdown-item dropdown" href="#">Español</a>                
                    </li> --}}

                </ul>
            </div>   
        @endguest
        
        <div class="busqueda col-6">
            <form class="d-flex" action="{{ route('buscar')  }}" method="GET">
                <input class="form-control me-2 " type="search" name="articulo-buscado" placeholder="Buscá lo que necesitás acá" aria-label="Search" >
                <button class="btn btn-danger" type="submit"> <span ><i class="fa-solid fa-magnifying-glass"></i></span></button>
            </form>
            
        </div>
        
        
    </div>

    
      
      
{{-- 
    <div class="d-flex mx-3" id="contenedor-switch-cambio-tema" style="">
        <span class="">
            <i class="fa-solid fa-sun"></i>
        </span>
        <div class="form-check form-switch" id="form-switch" style="">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
        </div>
        <span class="">
            <i class="fa-solid fa-moon"></i>
        </span>
    </div>

    <div class="d-flex mx-3" id="contenedor-dropdown-idiomas" style="">
        <div class="dropdown">
            <a href="#"  style="color: #fff; text-decoration: none" data-bs-toggle="dropdown" aria-expanded="false">
                ES / <span style=""><img src="{{ asset('assets/img/español.jpg')}}" alt="" height="15px"></span>
            </a>
            <ul class="dropdown-menu" id="dropdown-idiomas" style="">
                <li><a class="dropdown-item" style="color:#fff" href="#">Español</a></li>
                <li><a class="dropdown-item" style="color:#fff" href="#">Inglés</a></li>
                <li><a class="dropdown-item" style="color:#fff" href="#">Portugués</a></li>
            </ul>
        </div>

    </div>
     --}}
</nav>