@extends('admin.layouts.plantilla_admin')

@section('section-principal')

  <div class="w-fit mb-5">
    @include('admin.layouts.aside-left')
    <div class="flex justify-center mt-3">
      <a href="{{ route('compras.index') }}" id="boton-regresar-atras" class="bg-blue-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
        <i class="fa-solid fa-circle-arrow-left"></i> Atrás
      </a>

    </div>
  
  </div>

    
    <section class="center-actions " style="max-width: 800px">
      @if (session('danger'))
        <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
          <strong>Atención!</strong> {{ session('danger') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <div class="">
        <table class="table table-bordered" id="resultsTable">
          <thead style="text-transform: uppercase; text-align:center" class="table-dark">
            <th>id</th>
            <th>total</th>
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th style="min-width:60px">PDF</th>
            <th>Eliminar</th>

          </thead>
          <tbody  id="tabla-articulos-deportivos">
            @foreach ($compras as $compra)
              <tr>
                <td>{{ $compra->id }}</td>
                <td>$ {{ number_format($compra->total, 0, ',', '.') }}</td>
                <td>{{ $compra->user->name }}</td>
                <td>{{ $compra->fecha }}</td>
                <td>{{ $compra->estado }}</td>
                <td>
                    <a class=" btn btn-danger btn-sm "  href="{{ url("/ventas/pdf/{$compra->id}") }}" title="Generar PDF"  >
                      PDF
                      <svg fill="#ffffff" class="inline" xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/></svg>

                    </a>
                
                </td>
                <td>
                  @if($compra->estado == 'Pendiente')
                    <div class="" onclick="alert('Todavía tiene que entregar el pedido, o cancelarlo.')">

                      <button class="btn btn-danger btn-sm eliminar-btn mx-1" data-id="{{ $compra->id }}" data-bs-toggle="modal" data-bs-target="#modalEliminar" disabled >
                        Eliminar 
                        <i class="fa-solid fa-trash"></i>
                      
                      </button>
                    </div>
                  @else

                    <a href="{{ route('compras.destroy', $compra->id) }}" class="btn btn-danger btn-sm"
                      onclick="event.preventDefault();
                                  if(confirm('¿Estás seguro de eliminar esta compra?')) {
                                      document.getElementById('eliminar-form-{{ $compra->id }}').submit();
                                  }">
                      Eliminar
                      <i class="fa-solid fa-trash"></i>

                    </a>
                  
                    <form id="eliminar-form-{{ $compra->id }}" action="{{ route('compras.destroy', $compra->id) }}" method="POST" style="display: none;">
                      @csrf
                      @method('DELETE')
                    </form>
                  @endif

                
                </td>


              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="flex justify-center">
            {{ $compras->links('pagination::bootstrap-4') }}
          </div>
      </div>
  </section>
    <div class=""style="border-left: 1px solid rgba(0, 0, 0, 0.315)">

        <article class="article0    px-3 bg-green-600 "   >
            <a href="{{ route('compras.index') }}" class="text-white no-underline">
                <div class="top">
                    <span>
                        <i class="fa-solid fa-chart-line"></i>
                    </span>
                    <span class="recuento">
                        {{ $comprasRealizadas }}
                    </span>
                </div>
                <div class="bottom">
                    <p>
                        Compras de clientes
                        <br>
                        (Recuento)

                    </p>

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