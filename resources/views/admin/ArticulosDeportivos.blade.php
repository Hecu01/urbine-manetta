@extends('admin.layouts.plantilla_admin')
@section('section-principal')

  <div class="w-fit">
    @include('admin.layouts.aside-left')
    <div class="flex justify-center mt-3">
      <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
        <i class="fa-solid fa-circle-arrow-left"></i> Atrás
      </a>

    </div>
  </div>
 

  @if (session('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Atención!</strong> {{ session('mensaje') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif 
  <div class="estilos-crear-articulos-ropa">
      <ul class="nav nav-tabs" id="myTab" role="tablist" style="display: flex; justify-content:space-between">
        <div class="d-flex">

          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Tabla <i class="fa-solid fa-table"></i></button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Crear articulo deportivo <i class="fa-solid fa-circle-plus"></i></button>
            </li>

          </ul>

        </div>
        <div class="mx-1">
          <li>
            <form class="d-flex mt-1" role="search">
                <input class="form-control me-2 form-control-sm" type="search" placeholder="Buscar" aria-label="Search">
                <button class="btn btn-primary btn-sm" type="submit">Buscar</button>
            </form>
          </li>
        </div>
          
      </ul>
      <div class="estilos-crear-articulos-ropa2">
          <div class="tab-content" id="myTabContent">
              
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0" style="min-height:500px;overflow-x:visible">
              @include('admin.partials.NuevoArtDeport_tabla')
            </div>
            <div class="tab-pane fade " id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
              @include('admin.partials.NuevoArtDeport_formulario')
            </div>
          </div>


            
      </div>

  </div>

            
  <!-- Artículos deportivos -->
  <article class="article0 article4   px-2"  id="redirigirBoton">
    <a href="{{ route('nuevo_articulo') }}" class="text-white no-underline">
      <div class="top">
        <span>
          <i class="fa-solid fa-football"></i>
        </span>
        <span class="recuento">
          {{ $artDeportivos }}
        </span>
      </div>
      <div class="bottom">
        <p>Artículos deportivos <br> disponibles</p>
      </div>
    </a>
  </article>




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

