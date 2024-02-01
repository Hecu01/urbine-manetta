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
      <div class="mx-1 " id="busqueda-artdeport">
        <form class="d-flex mt-1" role="search">
          <input class="form-control me-2 form-control-sm" type="search" placeholder="Buscar" aria-label="Search">
          <button class="btn btn-primary btn-sm" type="submit">Buscar</button>
        </form>
      </div>
        
    </ul>
    <div class="estilos-crear-articulos-ropa2">
      <div class="tab-content" id="myTabContent">
          
        <div class="tab-pane fade show active" id="accesorios-pane" role="tabpanel" aria-labelledby="accesorios" tabindex="0" style="min-height:500px;overflow-x:visible">
          @include('admin.partials.ArticulosDeportivos.TablaAccesorios_ArtDeport')
          <div class="flex justify-center">
            {{ $articulos->links('pagination::bootstrap-4') }}
          </div>
        </div>

        <div class="tab-pane fade " id="calzados-pane" role="tabpanel" aria-labelledby="calzado" tabindex="0" style="min-height:500px;overflow-x:visible">
          @include('admin.partials.ArticulosDeportivos.TablaCalzados_ArtDeport')

          
        </div>
        <div class="tab-pane fade " id="formulario-pane" role="tabpanel" aria-labelledby="formulario" tabindex="0">
          @include('admin.partials.ArticulosDeportivos.Formulario_ArtDeport')

          
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






@endsection

