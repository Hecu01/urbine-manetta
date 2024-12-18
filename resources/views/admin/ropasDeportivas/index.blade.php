@extends('admin.layouts.plantilla_admin')

@section('section-principal')
    @if (session('mensaje'))
        @include('admin.partials.MsjDelSistema.ArtAgregConExito') 
    @endif 
    @if (session('eliminado'))
        @include('admin.partials.MsjDelSistema.ProductoEliminado') 
    @endif 

    <div class="w-fit mb-5">
        @include('admin.layouts.aside-left')
        <div class="flex justify-center mt-3">
            <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class="bg-blue-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
            <i class="fa-solid fa-circle-arrow-left"></i> Atrás
            </a>
    
        </div>

    </div>


    <section class="">
        {{-- <h1>Novedades!</h1> --}}
        <div class="center-index  mt-5">

            <article class="" style="width: 15rem;">

                @include('admin.ropasDeportivas.partials.right')
                {{-- <img src="{{ url('producto/apolo.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">El elegido de la semana</h5>
                    <p class="card-text">Cantidad: 16 unidades</p>
                </div>
            </article>
            <article class="card" style="width: 15rem;">
                <img src="{{ url('producto/apolo.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">El elegido de la semana</h5>
                    <p class="card-text">Cantidad: 16 unidades</p>
                </div>
            </article>
            <article class="card" style="width: 15rem;">
                <img src="{{ url('producto/apolo.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">El elegido de la semana</h5>
                    <p class="card-text">Cantidad: 16 unidades</p>
                </div> --}}
            </article>
        </div>
    </section>

    <div class="aside" style="visibility: hidden; pointer-events: none;">
        @include('admin.ropasDeportivas.partials.right')
    </div>

  





@endsection

