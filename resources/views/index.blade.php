@extends('layouts.app')
@section('section-principal')
    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
            <strong>Atención!</strong> {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif 
    <section class="section-bienvenida" >
        <div class="contenedor">
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
            <div class="brand" >
                <div class="">
                    <span>Si ves esto, es porque está en etapa de desarollo</span>
                    <h4>Inicia sesión y registrate, así podés comprar y agregar comentarios sobre nuestros productos</h4>
                    <button class="btn btn-secondary">
                        Entrar
                    </button>
                    <button class="btn btn-secondary">
                        Registrarse
                    </button>
                </div>

            </div>


        @else
        @endguest
        
   

    </section>


      

  
@endsection

