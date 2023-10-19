<nav class="navbar pb-1" id="navigator-admin">
    <div class="container-fluid mb-1">
        <div class="left d-flex">
            <!-- Botón barra -->
            <button class="button-left " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="fa-solid fa-bars"></i>
                
            </button>

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
        <div class="right d-flex">

            <!-- Usuario Logueado -->
            <div class="usuario-logueado ">
                <ul class="">
                    
                    <li class="nav-item dropdown  capitalize" style="">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" style="color: #fff; height:20px; padding:3px;" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span>
                            <i class="fa-solid fa-user"></i>
                        </span>
                        {{ Auth::user()->name }} (admin)
                        </a>
        

                        <div class="dropdown-menu dropdown-menu-end " style="margin-top: 15px" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Destruír sesión') }}
                            </a>
        
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li> 
                </ul>
                <span class="ayuda" title="Ayuda" type="button"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="fa-regular fa-circle-question"></i>
                </span>
                <span class="ayuda mx-2" title="Notificaciones" type="button"  data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                    <i class="fa-solid fa-bell"></i>
                </span>
            </div>

            <!-- Búsqueda -->
            <div class="busqueda">
                <form class="d-flex" action="{{ route('buscar')  }}" method="GET">
                    <input class="form-control me-2" type="search" name="articulo-buscado" placeholder="Búsqueda" aria-label="Search" >
                    <button class="btn btn-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>

    </div>
    <div class="m-auto bg-white text-cyan-700 ">
        <ul class="flex flex-wrap w-auto">
            <a href="{{ route('home') }}" class="mx-1.5">Inicio</a></li>
            <a href="{{ route('ir_admin') }}" class="mx-1.5">Administrador</a></li>
        


            <a href="#"class="mx-1.5">
                Hombres
            </a>
     
        
        
            <a href="" class="mx-1.5">Mujeres</a>
            <a href="" class="mx-1.5">Niños</a>
            <a href="" class="mx-1.5">Niñas</a>        
            <a href="" class="mx-1.5">Mujeres</a>
            <a href="" class="mx-1.5">Niños</a>
            <a href="" class="mx-1.5">Niñas</a>        
            <a href="" class="mx-1.5">Mujeres</a>
            <a href="" class="mx-1.5">Niños</a>
            <a href="" class="mx-1.5">Niñas</a>
            <!-- {{-- <li><a href="" class="mx-1.5">Deportes de campo</a></li>
            <li><a href="" class="mx-1.5">Deportes de Gimnasio</a></li>
            <li><a href="" class="mx-1.5">Deportes Cerrados</a></li> --}} -->
            <a href="" class="mx-1.5">Artes Marciales y combate</a>
            <a href="" class="mx-1.5">Fútbol</a>
            <a href="" class="mx-1.5">Rugby</a>
            <a href="" class="mx-1.5">Handball</a>
            <a href="" class="mx-1.5">Natación</a>
            <a href="" class="mx-1.5">Voley</a>
            <a href="" class="mx-1.5">Running</a>
            <a href="" class="mx-1.5">Hockey</a>
             <a href="" class="mx-1.5">Basketball</a>
            <!-- {{-- <li><a href="" class="mx-1.5">Boxeo</a></li>
            <li><a href="" class="mx-1.5">Kingboxing</a></li>
            <li><a href="" class="mx-1.5">Tae Kwondo</a></li> --}} -->


        </ul>
    </div>
</nav>