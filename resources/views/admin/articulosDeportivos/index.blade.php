
{{-- Index artículos deportivos --}}

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
    @include('admin.partials.MsjDelSistema.ArtAgregConExito') 
  @endif 
  @if (session('eliminado'))
    @include('admin.partials.MsjDelSistema.ProductoEliminado') 
  @endif 

  <div class="estilos-crear-articulos-ropa">
    <ul class="nav nav-tabs" id="myTab" role="tablist" style="display: flex; justify-content:space-between">
      <div class="d-flex">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="accesorios" data-bs-toggle="tab" data-bs-target="#accesorios-pane" type="button" role="tab" aria-controls="accesorios-pane" aria-selected="true">Articulos <i class="fa-solid fa-table"></i></button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="calzados" data-bs-toggle="tab" data-bs-target="#calzados-pane" type="button" role="tab" aria-controls="calzados-pane" aria-selected="true">Calzados <i class="fa-solid fa-table"></i></button>
          </li>

          <li class="nav-item" role="presentation">
            <button class="nav-link" id="formulario" data-bs-toggle="tab" data-bs-target="#formulario-pane" type="button" role="tab" aria-controls="formulario-pane" aria-selected="false">Nuevo Producto <i class="fa-solid fa-circle-plus"></i></button>
          </li>

        </ul>

      </div>
      <!-- Búsqueda articulos deportivos accesorios -->
      <div class="mx-1 " id="busqueda-accesorios">
        <form class="d-flex mt-1" role="search">
          <input class="form-control me-2 form-control-sm" type="search" placeholder="Buscar" aria-label="Search" id="searchInput" >
          {{-- <button class="btn btn-primary btn-sm" type="submit">Buscar</button> --}}
          @csrf
        </form>
      </div>
      <!-- Búsqueda articulos deportivos calzados -->
      <div class="mx-1 " style="display: none" id="busqueda-calzados">
        <form class="d-flex mt-1" role="search">
          <input class="form-control me-2 form-control-sm" type="search" placeholder="Buscar" aria-label="Search" id="searchInput2" >
          {{-- <button class="btn btn-primary btn-sm" type="submit">Buscar</button> --}}
          @csrf
        </form>
      </div>
        
    </ul>
    <div class="estilos-crear-articulos-ropa2">
      <div class="tab-content" id="myTabContent">
          
        <div class="tab-pane fade show active" id="accesorios-pane" role="tabpanel" aria-labelledby="accesorios" tabindex="0" style="min-height:500px;overflow-x:visible">
          @include('admin.articulosDeportivos.partials.TablaAccesorios_ArtDeport')
          <div class="flex justify-center">
            {{ $articulos->links('pagination::bootstrap-4') }}
          </div>
        </div>

        <div class="tab-pane fade " id="calzados-pane" role="tabpanel" aria-labelledby="calzado" tabindex="0" style="min-height:500px;overflow-x:visible">
          @include('admin.articulosDeportivos.partials.TablaCalzados_ArtDeport')
          <div class="flex justify-center">
            {{ $articulos->links('pagination::bootstrap-4') }}
          </div>
          
        </div>
        <div class="tab-pane fade " id="formulario-pane" role="tabpanel" aria-labelledby="formulario" tabindex="0">
          @include('admin.articulosDeportivos.partials.Formulario_ArtDeport')

          
        </div>
      </div>


          
    </div>

  </div>

            
  <!-- Artículos deportivos -->
  <article class="article0 article4   px-2"  id="redirigirBoton">
    <a href="{{ route('articulos-deportivos.index') }}" class="text-white no-underline">
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


<!-- Modal -->
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEliminarLabel">Eliminar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro que deseas eliminar el producto?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="formEliminar" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" id="btnConfirmarEliminar">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Obtener todas las pestañas
  var tabs = document.querySelectorAll('.nav-link');

  // Iterar sobre cada pestaña
  tabs.forEach(function(tab) {
      // Escuchar el evento de clic en la pestaña
      tab.addEventListener('click', function() {
          // Obtener el ID de la pestaña
          var tabId = this.getAttribute('id');
          // Actualizar el fragmento del URL
          window.location.hash = tabId;
      });
  });
</script>

@endsection

