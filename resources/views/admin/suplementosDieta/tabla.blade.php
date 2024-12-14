@extends('admin.layouts.plantilla_admin')

@section('section-principal')

  <div class="w-fit mb-5">
    @include('admin.layouts.aside-left')
    <div class="flex justify-center mt-3">
      <a href="{{ route('suplementos-dieta.index') }}" id="boton-regresar-atras" class="bg-blue-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
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
  
  <section class="center-actions " style="max-width: 800px">
      <div class="">
        <table class="table table-bordered" id="resultsTable">
          <thead style="text-transform: uppercase; text-align:center" class="table-dark">
            <th>Foto</th>
            <th>Id</th>
            <th style="max-width: 150px">Titulo</th>
            <th>Precio</th>
            <th>Marca</th>
            <th>Stock</th>
            <th>Acciones </th>
          </thead>
          <tbody  id="tabla-articulos-deportivos">
            @foreach ($articulos as $articulo)
              <tr>
                <td> 
                  <img src="{{ url('productos/' . $articulo->fotos->first()->ruta) }}" alt="{{ $articulo->nombre }}" width="70px" height="70px">
                
                </td>
                <td>{{ $articulo->id }}</td>
                <td style="max-width: 150px">{{ $articulo->nombre}}</td>
                <td class="precio">$ {{ number_format($articulo->precio, 0, ',', '.') }}</td>
                <td>{{ $articulo->marca }}</td>
                
                <td>
                  
                  {{ $articulo->stock }}
                </td>

                <td class="acciones">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('suplementos-dieta.edit', $articulo->id) }}" class="btn btn-success btn-sm" title="Editar">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <button class="btn btn-danger btn-sm eliminar-btn mx-1" data-id="{{ $articulo->id }}" data-bs-toggle="modal" data-bs-target="#modalEliminar"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </section>
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