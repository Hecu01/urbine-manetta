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
        {{-- <h1 class="font-bold text-center">Tabla de pedidos solicitados</h1> --}}
        <h1 class="font-bold text-center">Tabla de reposición de Suplementos y Dieta</h1>
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
                  <th style="width: 150px">Pedido</th>
                  <th>Estado</th>
                  <th>Aceptadas</th>
                  <th>Accion</th>
              </tr>
          </thead>
          <tbody id="tabla-articulos-deportivos">
            @foreach ($artDeportivos as $artDeportivo)
                @php
                    $id = $artDeportivo->id;
                    $estado = $artDeportivo->estado;
                    $foto = '';
                    $nombre = '';
                    $stockArray = [];
                    $numeroCalzadoArray = [];

                @endphp
        
                @foreach($artDeportivo->articulos as $articulo)

                  @php
                    $foto = $articulo->foto;
                    $nombre = $articulo->nombre;
                    $stock = $articulo->pivot->cantidad;
                    $calzadoIdArray = [];
                    foreach ($articulo->calzados as $calzado) {
                      $calzadoIdArray[] = $calzado->id;
                    }
                    $numeroCalzadoArray[] = $articulo->pivot->valor_calzado_talle; // Aquí accedes al número del calzado

                    $stockArray[] = $articulo->pivot->cantidad;
                  @endphp

                @endforeach
        
                <tr style="vertical-align: middle">
                  <td>{{ $id }}</td>
                  <td>
                    <img draggable="false" src="{{ url('producto/' . $foto) }}" alt="{{ $nombre }}" width="70px" height="70px">
                  </td>
                  <td>{{ $nombre }}</td>
                  <td style="justify-content: center; align-items: center">
                    <div>
                      @if(empty($calzadoIdArray))
                        <strong>Unidades:</strong> <br> {{ $stock ?? '' }}
                      @else
                        <strong>Talles:</strong> <br> {{ json_encode($numeroCalzadoArray) }} <br>
                        <strong>Unidades:</strong> <br> {{ json_encode($stockArray) }} <br>
                      @endif
                    </div>
                  </td>
                  <td>
                    @switch($estado)
                        @case('Finalizado')
                          <div class="bg-green-500 text-white uppercase px-2 py-1 rounded-full" style="font-size: .8em">
                            {{ $estado }}
                          </div>
                          @break

                        @case('Pendiente')
                          <div class="bg-yellow-500 text-white uppercase px-2 py-1 rounded-full" style="font-size: .8em">
                            {{ $estado }}
                          </div>
                          @break

                        @case('Cancelado')
                          <div class="bg-rose-500 text-white uppercase px-2 py-1 rounded-full" style="font-size: .8em">
                            {{ $estado }}
                          </div>
                          @break

                        @default
                            
                    @endswitch

                  </td>

                  <td>
                      {{--  --}}
                      @if ($estado == 'Pendiente')
                          <form action="{{ route('articulos.aceptar', $id) }}" method="POST" class="d-inline"
                              id="formAceptarCantidad">
                              @method('PUT')
                              @csrf
                              <input type="number" name="unidades_aceptadas" placeholder="Cantidad" required min="0"  max="{{ $stock }}" class="form-control" style="width: 100px; display: inline-block" oninput="validar(this)">

                              <button type="submit" class="btn btn-outline-success border-0 p-1"><i class="fa-solid fa-check"></i></button>
                          </form>
                      @else
                              <span> {{ $articulo->pivot->unidades_aceptadas ?? 'Aceptada' }}</span>
                      @endif
                  </td>

                  <td class=" " style="font-size: .8em" id="acciones">
                    @if ($estado == 'Pendiente')
                      <form action="{{ route('articulos.rechazar', $id) }}" method="POST" class="d-inline" id="formCancelar">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-lg border-0"><i class="fa-solid fa-ban"></i></i></button>
                      </form>
                    @else
                      <form action="{{ route('articulos.eliminar', $id) }}" method="POST" class="d-inline" id="formEliminar">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-lg border-0"><i class="fa fa-trash"></i></button>
                      </form>
                    @endif
                  </td>
                </tr>

            @endforeach
          </tbody>
        
        </table>

      
        @if($reposicionesPendientes === 0)
          <h2 class="text-blue-500 text-center">Vaya vaya... parece que no hay <br>pedidos de reposicion pendientes... </h2>
          <p class="text-blue-500 text-center text-xl">
            <a href="{{ route('solicitar-sup-diet-index') }}">
              Solicitar más 
            </a>
          </p>
          
        @endif
      </div>
  </section>

  <!-- card reponer mercaderias -->
  @include('admin.reponerMercaderia.partials.CardReposicion')
    
  



  <script>
    function validar(input) {
      // Obtener los valores mínimo y máximo del input
      const min = parseInt(input.min, 10); // 0
      const max = parseInt(input.max, 10); // $articulo->pivot->cantidad
      let value = input.value;

      // Eliminar ceros iniciales, excepto si el valor es "0"
      if (value.length > 1 && value.startsWith("0")) {
        value = value.replace(/^0+/, '');
      }

      // Convertir el valor a número entero
      const numericValue = parseInt(value, 10);

      // Validar que el valor sea un número válido
      if (isNaN(numericValue)) {
        input.value = min; // Si no es un número, asignar el valor mínimo

        return;
      }

      // Validar que el número esté dentro del rango permitido
      if (numericValue < min) {
        input.value = min; // Ajustar al mínimo si es menor

      } else if (numericValue > max) {
        input.value = max; // Ajustar al máximo si es mayor
      } else {
        input.value = numericValue; // Asignar el valor ajustado
    }

  }
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
