@extends('layouts.app')
@section('section-principal')
    <section class="section-bienvenida" >
        <div class="contenedor">
            <div class="mensaje-bienvenida font-">
                <h1>
                    Sportivo<br>
                    Tu tienda deportiva
                </h1>
                <h2>Compras online y en el local</h2>
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
            <div class="">
            </div>

        @else
        @endguest
        
   

    </section>


      

  
@endsection