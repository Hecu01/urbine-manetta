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
                                Destruír sesión
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
                <div class="imagen-logo">
                    <img src="{{ asset('assets/img/logo.png')}}" alt="" draggable="false">
                </div>
                <span>
                    Sportivo
                </span>
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
                    <a href="#" class="dropdown-toggle"  style="color: #fff; text-decoration: none" data-bs-toggle="dropdown" aria-expanded="false">
                        ES / <span style=""><img src="{{ asset('assets/img/español.jpg')}}" alt="" height="15px"></span>
                    </a>
                    <ul class="dropdown-menu " id="dropdown-idiomas" style="text-align:end">
                        <li><a class="dropdown-item" style="color:#fff" href="#">Español <span class="mx-1"><img src="{{ asset('assets/img/español.jpg')}}" alt="" height="15px"></span></a></li>
                        <li><a class="dropdown-item" style="color:#fff" href="#">Portugués <span class="mx-1"><img src="{{ asset('assets/img/portugues.jpg')}}" alt="" height="15px"></span></a></li>
                        <li><a class="dropdown-item" style="color: #fff" href="#">Inglés <span class="mx-1"><img src="{{ asset('assets/img/ingles.jpg')}}" alt="" height="15px"></span></a></li>
                    </ul>
                </div>
        
            </div>
        </div>


        
    </div>
    <div class="bottom-nav d-flex" style="flex-wrap: wrap;">

        <a href="">Inicio</a></li>
        

        <div id="li-hombres">
            <a href="#">
                Hombres
            </a>
            <div class="sub-li-hombres">
                <ul>
                    <li>
                        <a href=" {{ route ('hombres') }}">
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
        <div class="dropdown " id="carrito-de-compras">
            <a href="#"style="color: #fff" data-bs-toggle="dropdown" aria-expanded="false">
                <span style="margin-left: 10px;margin-top: 5px;">
                    <i class="fa-solid fa-cart-shopping"></i>
                </span>
            </a>

            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item dropdown" href="#">Español</a>                
                </li>
                <li><a class="dropdown-item" href="#">Inglés</a></li>
                <li><a class="dropdown-item" href="#">Portugués</a></li>
            </ul>
        </div>      
        <div class="busqueda col-6">
            <form class="d-flex">
                <input class="form-control me-2 " type="search" placeholder="Búsqueda" aria-label="Search" >
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