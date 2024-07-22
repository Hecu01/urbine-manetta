@extends('admin.layouts.plantilla_admin')

@section('section-principal')

    <div class="w-fit mb-5">
        @include('admin.layouts.aside-left')
        <div class="flex justify-center mt-3">
        <a href="{{ route('reposicion-mercaderia.index') }}" id="boton-regresar-atras" class="bg-blue-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
            <i class="fa-solid fa-circle-arrow-left"></i> Atrás
        </a>

        </div>
  
    </div>


  <section class="center-actions " style="max-width: 800px">

      <div class="">
        <h1>Tabla de pedidos solicitados</h1>
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
            <strong>Atención!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif 
        @if (session('danger'))
          <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
              <strong>Atención!</strong> {{ session('danger') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif 
        <table class="table table-bordered text-center" id="resultsTable" style="min-width: 700px">
          <thead style="text-transform: uppercase; text-align:center" class="table-dark">
              <tr>
                  <th>Id</th>
                  <th>Foto</th>
                  <th style="width: 100px">Nombre</th>
                  <th style="width: 150px">Cantidad <br> solicitada</th>
                  <th>Estado</th>
                  <th>Accion</th>
              </tr>
          </thead>
          <tbody id="tabla-articulos-deportivos">
            @foreach ($artDeportivos as $artDeportivo)
    
                {{-- Declaramos las variables necesarias --}}
                @php 
                  $id = $artDeportivo->id;
                  $estado = $artDeportivo->estado;
                @endphp
    
                {{-- Contamos cuántas veces aparece en la tabla pivot --}}
                @foreach ($artDeportivo->articulos as $articulo)
                  @php 
                    $stockArray = [];
                    $calzadoIdArray = [];
                    $numeroCalzadoArray = [];
                    $foto = $articulo->foto;
                    $nombre = $articulo->nombre;

                  @endphp
                    @foreach ($articulo->calzados as $calzado)
                        @php 
                            $stockArray[] = $calzado->pivot->stocks;
                            $calzadoIdArray[] = $calzado->id;
                            $numeroCalzadoArray[] = $calzado->calzado; // Aquí accedes al número del calzado
                            @endphp
                    @endforeach
                @endforeach
    
                <tr>
                    <td>{{ $id }}</td>
                    <td>
                        <img draggable="false" src="{{ url('producto/'. $foto) }}" alt="{{ $nombre }}" width="70px" height="70px">
                    </td>
                    <td>{{ $nombre }}</td>
                    <td>
                        {{-- Calzado: <br> {{ json_encode($calzadoIdArray) }} <br> --}}
                        Número: <br> {{ json_encode($numeroCalzadoArray) }} <br>
                        Stock: <br> {{ json_encode($stockArray) }}
                    </td>
                    <td class="flex items-center justify-center ">
                        <div class="{{ $estado == 'Finalizado' ? 'bg-green-500' : 'bg-rose-500' }} text-white uppercase px-2 py-1 mt-2 rounded-full" style="font-size: .8em">
                            {{ $estado }}
                        </div>
                    </td>
                    <td class=" " style="font-size: .8em" id="acciones">
                      @if($estado == "pendiente")
                        <form action="{{ route('articulos.aceptar', $id) }}" method="POST" class="d-inline">
                          @csrf
                          <button type="submit" class="btn btn-primary btn-sm uppercase mt-2">Llegó</button>
                        </form>
                        <form action="{{ route('articulos.rechazar', $id) }}" method="POST" class="d-inline">
                          @csrf
                          <button type="submit" class="btn btn-danger btn-sm uppercase mt-2">Cancelar</button>
                        </form>
                      @else
                        <form action="{{ route('articulos.eliminar', $id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm uppercase mt-2">Eliminar</button>
                        </form>
                      @endif
                    </td>
                </tr>
            @endforeach
            
          </tbody>
        </table>
      
        @if($contarReposiciones === 0)
          <h2 class="text-blue-500 text-center">Vaya vaya... parece que no hay pedidos de reposicion pendientes</h2>
        @endif
      </div>
  </section>

  <!-- Artículos deportivos -->
  <div class="">
    <article class="article0 bg-yellow-500   px-2"  id="redirigirBoton">
      <a href="{{ route('articulos-deportivos.index') }}" class="text-white no-underline">
        <div class="top">
          <span>
            <i class="fa-solid fa-truck"></i>
          </span>
          <span class="recuento">
            6
          </span>
        </div>
        <div class="bottom">
          <p>Reposicino mercaderia <br> pendientes</p>
        </div>
      </a>
    </article>
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
