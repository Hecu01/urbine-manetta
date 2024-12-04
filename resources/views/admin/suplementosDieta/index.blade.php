@extends('admin.layouts.plantilla_admin')

@section('section-principal')
  <main class="principal-main-ropa-deportiva">

    <div class="w-fit">
      @include('admin.layouts.aside-left')
      <div class="flex justify-center mt-3">
        <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class="bg-blue-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
          <i class="fa-solid fa-circle-arrow-left"></i> Atrás
        </a>
  
      </div>
   
    </div>

    @if (session('mensaje'))
        @include('admin.partials.MsjDelSistema.ArtAgregConExito') 
    @endif 
    @if (session('eliminado'))
        @include('admin.partials.MsjDelSistema.ProductoEliminado') 
    @endif 

    
    <section class="center-actions">
        <div class=""style="min-width:800px; max-width:800px;">
            <h1 class="uppercase text-center">Suplementos deportivos y alimentos dietéticos</h1>
            <div class="flex justify-center">

                <div class="">
                    <article class="article0 bg-blue-500   px-2 hover:scale-105"  >
                        <a href="{{ route('suplementos-dieta.create') }}" class="text-white no-underline">
                        <div class="top">
                            <span>
                                <i class="fa-solid fa-football"></i>
                            </span>
                            <span class="recuento">
                                <i class="fa-solid fa-up-long" style="font-size: 1em"></i>
                            </span>
                        </div>
                        <div class="bottom " style="font-size: 1.055em">
                            <p>Formulario</p>
                        </div>
                        </a>
                    </article>
                </div>
                    
                <div class="">
                    <article class="article0 bg-cyan-500   px-2 hover:scale-105"  >
                        <a href="{{ route('suplementos-dieta.tabla') }}" class="text-white no-underline">
                        <div class="top">
                            <span>
                                <i class="fa-solid fa-align-justify"></i>
    
                            </span>
                            <span class="recuento">
                                <i class="fa-solid fa-up-long" style="font-size: 1em"></i>
                            </span>
                        </div>
                        <div class="bottom " style="font-size: 1.055em">
                            <p>Tabla</p>
                        </div>
                        </a>
                    </article>
                </div>
                {{-- <div class="">
                    <article class="article0 bg-green-500   px-2 hover:scale-105">
                        <a href="{{ route('solicitar-sup-diet-index') }}" class="text-white no-underline">
                        <div class="top">
                            <span>
                                <i class="fa-solid fa-heart"></i> 
    
                            </span>
                            <span class="recuento">
                                <i class="fa-solid fa-up-long" style="font-size: 1em"></i>
                            </span>
                        </div>
                        <div class="bottom " style="font-size: 1.055em">
                            <p>Solicitar mercadería <br> Suplementos y dieta</p>
                        </div>
                        </a>
                    </article>
                </div> --}}
            </div>
        </div>
    </section>
    <hr>
    <!-- Sumplementos y dieta -->
    <a href="{{ route('suplementos-dieta.index') }}" class="text-white no-underline article0 article3 px-1">
        <div class="top">
            <span>
                <i class="fa-solid fa-heart"></i>
            </span>
            <span class="recuento">
                {{ $suplementos }}
            </span>
        </div>
        <div class="bottom">
            <p>Sumplementos y dieta</p>
        </div>
    </a>
    
  </main>
  



  <script>
    function formatNumber(input) {
      // Eliminar caracteres no numéricos
      var num = input.value.replace(/[^0-9]/g, '');
      // Formatear con separadores de miles
      input.value = num.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    function preventScroll(event) {
      event.preventDefault();
    }

    // Remover puntos
    function removeDots() {
      var input = document.getElementById('precio');
      input.value = input.value.replace(/\./g, '');
    }
      // Remover puntos
      function removeDots2() {
      var input = document.getElementById('stock');
      input.value = input.value.replace(/\./g, '');
    }
  </script>
@endsection

