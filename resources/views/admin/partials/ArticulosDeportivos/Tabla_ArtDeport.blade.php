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
                <td> <img src="{{ url('producto/'. $articulo->foto) }}" alt="{{ $articulo->nombre }}" width="70px" height="70px"> </td>
                <td><a href="{{ $articulo->id }}">{{ $articulo->nombre}}</a></td>
                <td>$ {{ number_format($articulo->precio, 0, ',', '.') }}</td>
                <td>{{ $articulo->marca }}</td>
                <td>
                    @foreach ($categorias as $categoria)
                        @if($articulo->id_categoria == $categoria->id)
                            {{ $categoria=$categoria->categoria }}
                        @endif
                    @endforeach
                </td>
                <td>
                    @if($articulo->tipo_producto == 'calzado')
                        <a href="#" id="popoverButton-{{ $articulo->id }}">
                            {{ $articulo->stock }}
                        </a>  

                        <!-- Contenedor del popover (inicialmente oculto) -->
                        <div id="popoverContent-{{ $articulo->id }}" class="hidden bg-white border p-1 absolute z-10 mt-2 w-fit bg-gray-100 ">
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
                        {{ $articulo->stock }}
                    @endif
                </td>
                <td>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('EditarArtDep', $articulo->id) }}" class="btn btn-success btn-sm" title="Editar">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <button class="btn btn-danger btn-sm eliminar-btn mx-1" data-id="{{ $articulo->id }}" data-bs-toggle="modal" data-bs-target="#modalEliminar"><i class="fa-solid fa-trash"></i></button>
                        <button class="btn btn-secondary btn-sm"><i class="fa-solid fa-eye"></i></button>
                    </div>
                </td>
            </tr>
        @endif
      @endforeach
    </tbody>
</table>

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
