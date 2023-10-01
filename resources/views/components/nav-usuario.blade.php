<!-- Si es usuarioooo (no accedera al crud) -->
<nav class="navbar   " id="navigator-usuario">
    <div class="container-fluid">
        <div class="left">
            <!-- Usuario Logueado -->
            <div class="usuario-logueado mt-1" >

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

                <span class="ayuda mt-1" title="Ayuda" type="button"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="fa-regular fa-circle-question"></i>
                </span>

            </div>

        </div>
        <div class="center">

            <!-- Logo y nombre -->
            <div class="logo-y-nombre">
                <div class="imagen-logo">
                    <img src="{{ asset('assets/img/logo.png')}}" alt="" draggable="false">
                </div>
                <span>
                    TiendaFit
                </span>
            </div>
        </div>
        <div class="right d-flex">

            <!-- Búsqueda -->
            <div class="busqueda">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" >
                    <button class="btn btn-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>


        
    </div>
    <div class="bottom-nav">
        <ul>
            <li><a href="">Inicio</a></li>
            <li><a href="">Hombres</a></li>
            <li><a href="">Mujeres</a></li>
            <li><a href="">Niños/as</a></li>
            <li><a href="">Fútbol</a></li>
            <li><a href="">Rugby</a></li>
            <li><a href="">Handball</a></li>
            <li><a href="">Natación</a></li>
            <li><a href="">Voley</a></li>
            <li><a href="">Running</a></li>
            <li><a href="">Hockey</a></li>
        </ul>
    </div>
    
</nav>