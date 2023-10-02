<nav class="navbar" id="navigator-admin">
    <div class="container-fluid">
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

                    TiendaFit, Casa central.
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

            <!-- Usuario Logueado -->
            <div class="usuario-logueado">
                <ul>
                    
                    <li class="nav-item dropdown  " style="color: #fff; list-style: none; margin-top: -5px;">
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
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Búsqueda" aria-label="Search" >
                    <button class="btn btn-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>


        <!-- Sale por la izquierda -->
        <div class="offcanvas offcanvas-start" style="width: 300px;" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Navegacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">

                <ul>
                    <li><a href="{{ route('pagina_inicio') }}">Inicio</a></li>
                    <li><a href="{{ route('ir_admin') }}">Admin</a></li>
                </ul>

            </div>
        </div>
        <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('pagina_inicio') }}">INICIO</a>
                </li>
    

                    <li class="nav-item">
                        <a class="nav-link active" href=" {{ route('ir_admin') }} ">CRUD</a>
                    </li>
    
    
            </ul> -->
            <!-- <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
        </div>

    </div>
</nav>