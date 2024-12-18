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
        <div class="center-index flex justify-center ">

            <div class="">
                <a href="{{ route('ropa-deportiva.formulario') }}" class="text-white no-underline">
                    <article class="article0 bg-slate-600   px-2 hover:scale-105">
                        <div class="top">
                            <span>
                            <i class="fa-solid fa-plus" ></i>
            
            
                            </span>
                            <span class="recuento">
                                <i class="fa-solid fa-up-long" style="font-size: 1em"></i>
                            </span>
                        </div>
                        <div class="bottom " style="font-size: 1.055em">
                            <p>Crear nueva ropa</p>
                        </div>
                    </article>
                </a>
            </div>
              
          
            <div class="">
                <a href="{{ route('ropa-deportiva.tabla') }}" class="text-white no-underline">
                    <article class="article0 bg-rose-600   px-2 hover:scale-105">
                        <div class="top">
                            <span>
                            <i class="fa-solid fa-table"></i>
            
                            </span>
                            <span class="recuento">
                                <i class="fa-solid fa-up-long" style="font-size: 1em"></i>
                            </span>
                        </div>
                        <div class="bottom " style="font-size: 1.055em">
                            <p>Tabla de Ropas</p>
                        </div>
                    </article>
                </a>
            </div>
        </div>
    </section>
    
    <div class=""style="border-left: 1px solid rgba(0, 0, 0, 0.315)">
        <!-- Artículos deportivos -->
        <article class="article0 px-2 bg-blue-500 hover:scale-105" >
            <a href="{{ route('ropa-deportiva.index') }}" class="text-white no-underline">
            <div class="top">
                <span>
                    <i class="fa-solid fa-shirt"></i>
                </span>
                <span class="recuento">
                    {{ $ropaDeportivas }}
                </span>
            </div>
            <div class="bottom">
                <p>Ropas deportivas <br> disponibles</p>
            </div>
            </a>
        </article>

    </div>

  





@endsection

