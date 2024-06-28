@extends('admin.layouts.plantilla_admin')

@section('section-principal')

  <div class="w-fit mb-5">
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
            <th>Talles (U) </th>
            <th>Acciones </th>
          </thead>
          <tbody  id="tabla-articulos-deportivos">
            @foreach ($articulos as $articulo)
              <tr>
                <td> <img src="{{ url('producto/'. $articulo->foto) }}" alt="{{ $articulo->nombre }}" width="70px" height="70px"> </td>
                <td>{{ $articulo->id }}</td>
                <td style="max-width: 150px"><a href="{{ $articulo->id }}">{{ $articulo->nombre}}</a></td>
                <td class="precio">$ {{ number_format($articulo->precio, 0, ',', '.') }}</td>
                <td>{{ $articulo->marca }}</td>
                
                <td>
                  
                  {{ $articulo->stock }}
                </td>
                <td>
                  @foreach($articulo->talles as $talle)
                  
                    <span>
                      - <strong>{{$talle->talle_ropa}}</strong> ({{ $talle->pivot->stocks}})<br>
                    </span>
                  @endforeach
                </td>
                <td class="acciones">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('articulos-deportivos.edit', $articulo->id) }}" class="btn btn-success btn-sm" title="Editar">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <button class="btn btn-danger btn-sm eliminar-btn mx-1" data-id="{{ $articulo->id }}" data-bs-toggle="modal" data-bs-target="#modalEliminar"><i class="fa-solid fa-trash"></i></button>
                        <button class="btn btn-secondary btn-sm"><i class="fa-solid fa-eye"></i></button>
                    </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </section>
  <div class="aside " >
    @include('admin.ropasDeportivas.partials.right')
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

