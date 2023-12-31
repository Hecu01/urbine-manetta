<!-- Botón que activa el popover -->
<table class="table table-hover font-sans">
    <thead  style="border:1px solid rgb(16, 153, 163); text-align:center">
      <th>Foto</th>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Marca</th>
      <th>Categoria</th>
      <th>Stock</th>
    </thead>
    <tbody  id="tabla-articulos-deportivos">
      @foreach ($articulos as $articulo)
        @if($articulo->id_categoria == 1)
          <tr>

            <td> <img src="{{url('producto/'. $articulo->foto) }}" alt="{{ $articulo->nombre }}" width="70px" height="70px"> </td>
            <td><a href="{{ $articulo->id }}">{{ $articulo->nombre}}</a></td>
            <td>$ {{number_format($articulo->precio, 0, ',', '.')}}</td>
            <td>{{ $articulo->marca}}</td>
            <td>
              @foreach ($categorias as $categoria)
                @if($articulo->id_categoria == $categoria->id)
                  {{ $categoria=$categoria->categoria }}
                @endif
              @endforeach
            </td>
            <td>
              @if($articulo->tipo_producto == 'calzado')
                <a href="#" id="popoverButton-{{ $articulo->id }}" >
                  {{ $articulo->stock}}
                </a>  

                <!-- Contenedor del popover (inicialmente oculto) -->
                <div id="popoverContent-{{ $articulo->id }}"  class="hidden bg-white border p-1 absolute z-10 mt-2 w-fit bg-gray-100 ">
                  <h3 class="text-xl underline">Calzados - disponibles</h3>
                  {{-- Logica para que cargue los calzados correspondientes --}}
                    @if($articulo->tipo_producto == "calzado" && count($articulo->calzados) > 0)
                      <div class=" my-2   hover:cursor ">
                        <div class="inline-block relative ">
                          @foreach($articulo->calzados as $calzado)
                            @if($calzado->pivot->stocks > 0)
                              <p >Talle N° {{ $calzado->calzado }} - Disponibles {{$calzado->pivot->stocks}}</p>
                            @endif
                          @endforeach
    
                        </div>
                      </div>
                    @endif
                  
                </div>


              @else
                {{ $articulo->stock}}
              @endif
            </td>
            <td>
              <div class="d-flex justify-content-center">

                <a href="{{ route('EditarArtDep', $articulo->id) }}" class="btn btn-success btn-sm"  title="Editar">
                
                  <i class="fa-solid fa-pen-to-square"></i>
              </a>
                <form class="mx-1" id="deleteForm" data-id="{{ $articulo->id }}" action="{{ route('eliminar_articulo', ['id' => $articulo->id]) }}" method="POST">
                  @method('DELETE')
                  @csrf
                  <button class="btn btn-danger btn-sm" type="submit" onclick="eliminarArticulo()"><i class="fa-solid fa-trash"></i></button>
                </form>
                <button class="btn btn-secondary btn-sm"><i class="fa-solid fa-eye"></i></button>
              </div>

            </td>


          </tr>
        @endif
      @endforeach
    </tbody>
</table>
<div class="flex justify-center">
  {{ $articulos->links('pagination::bootstrap-4') }}
</div>