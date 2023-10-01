{{-- <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #86cdff;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Tienda</a>
        @guest
        @else
            <li class="nav-item dropdown  btn btn-success btn-sm" style="color: #fff">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" style="color: #fff; height:25px; padding:3px;" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Usuario: {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('pagina_inicio') }}">INICIO</a>
            </li>
            @guest

                <li class="nav-item dropdown d-block">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Usuario
                    </a>
                    <!-- Iniciar o Cerrar Sesión-->
                    <ul class="dropdown-menu d-block" aria-labelledby="navbarDropdown">
                        @if (Route::has('login'))
                            <li class="dropdown-item">
                                <a class="dropdown-item" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="dropdown-item">
                                <a class="dropdown-item" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                            </li>
                        @endif
                        
                        
                    </ul>
                </li>
            @else


            @endguest

        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
</nav> --}}


<!-- Si es usuarioooo (no accedera al crud) -->
<nav class="navbar   " id="navigator-usuario">
    <div class="container-fluid">
        <div class="left">
            <!-- Usuario Logueado -->
            <div class="usuario-logueado mt-1" >

                @guest
                    <span class="mx-1">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    </div>

                    <span class="mx-1">
                        <i class="fa-solid fa-sun"></i>
                    </span>

                    {{-- <li class="nav-item dropdown d-block mx-2">
                        <a class="nav-link " href="{{ route('login') }}" id="navbarDropdown">
                            Iniciar sesión 
                        </a>
                    </li>
                    <li class="nav-item dropdown d-block mx-2">
                        <a class="nav-link " href="{{ route('register') }}" id="navbarDropdown" >
                            Registrarme
                        </a>
                    </li> --}}
                @else 
                @endguest



            </div>

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
        <div class="right d-flex">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" style="color: #fff" data-bs-toggle="dropdown" aria-expanded="false">
                    ES /
                </a>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>

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
            <li><a href="{{ route('pagina_inicio') }}">Inicio</a></li>
            <li><a href="#">Hombres</a></li>
            <li><a href="#">Mujeres</a></li>
            <li><a href="#">Niños/as</a></li>
            <li><a href="#">Fútbol</a></li>
            <li><a href="#">Rugby</a></li>
            <li><a href="#">Handball</a></li>
            <li><a href="#">Natación</a></li>
            <li><a href="#">Voley</a></li>
            <li><a href="#">Running</a></li>
            <li><a href="#">Hockey</a></li>
        </ul>
    </div>
    
</nav>