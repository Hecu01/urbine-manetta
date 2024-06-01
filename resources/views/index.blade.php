@extends('layouts.app')
@section('section-principal')
    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
            <strong>Atención!</strong> {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif 
    <section class="section-bienvenida" >
        <div class="contenedor d-flex">
            <div class="mensaje-bienvenida font-">
                <h1>
                    Sportivo<br>
                    Tu tienda deportiva
                </h1>
                <h2>Compras online y en el local</h2>
                {{-- <img src="{{ url('usuario/' . Auth::user()->foto) }}" alt=""> --}}
            </div>

        </div>
        @guest        
            <div class="container-fluid banner bg-blue-600 py-5 px-2 my-2 flex justify-between items-center">

                <div class="div-left ml-3" >
                    <div class="text-white  ">
                        <h5 class="uppercase mb-2">
                            <strong>
                                EN SPORTIVO ESTÁ TODO LO QUE NECESITÁS
                            </strong>
                        </h5>
                        <h4 class="">Inicia sesión o registrate  así podés  comprar <br>   y agregar comentarios a nuestros productos</h4>
                        <div class=" mt-3 flex">
    
                            <a href=" {{ route('login') }} " class="block text-white no-underline rounded-lg py-2 text-center px-3 bg-red-500 hover:scale-105">Entrar</a>
                            <a href="{{ route('register') }}" class="block text-white no-underline rounded-lg py-2 mx-2  text-center px-3 bg-red-500 hover:scale-105">Registrarse</a>
                        </div>
    
    
                    </div>
    
                </div>
                <div class="right-banner">
                    <h1 class="title-right-banner">SPORTIVO E-COMMERCE</h1>
                </div>

            </div>

            {{-- BANNER LOGUEADO --}}
        @else
            <div class="container-fluid bg-blue-600 py-5 px-2 my-2 flex justify-between ">

                <div class="div-left" >
                    <div class="text-white  ">
                        <h5 class="uppercase mb-2">
                            <strong>
                                EN SPORTIVO ESTÁ TODO LO QUE NECESITÁS
                            </strong>
                        </h5>
                        <h4 class="">Ya iniciaste sesión. Ahora podés comprar <br>   y agregar comentarios a nuestros productos</h4>
                        <div class=" mt-3 flex">

                            <a href=" {{ route('login') }} " class="block text-white no-underline rounded-lg py-2 text-center px-3 bg-red-500 hover:scale-105">Entraste</a>
                            <a href="{{ route('register') }}" class="block text-white no-underline rounded-lg py-2 mx-2  text-center px-3 bg-red-500 hover:scale-105">Registrado</a>
                        </div>


                    </div>

                </div>

                

            </div>
        @endguest
        <div class="" style="height: 550px">

        </div>
        

    </section>


      

  
@endsection

