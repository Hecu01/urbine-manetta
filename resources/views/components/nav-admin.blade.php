<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #86cdff;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Tienda</a>
        @guest
        @else
            <li class="nav-item dropdown  btn btn-success btn-sm" style="color: #fff">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" style="color: #fff; height:25px; padding:3px;" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Admin: {{ Auth::user()->name }}
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

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Usuario
                    </a>
                    <!-- Iniciar o Cerrar Sesión-->
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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
                <li class="nav-item">
                    <a class="nav-link active" href=" {{ route('ir_admin') }} ">CRUD</a>
                </li>

            @endguest

        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
</nav>