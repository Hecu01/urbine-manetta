<table class="table table-hover">
    <thead  >
      <td>Foto</td>
      <td >Nombre</td>
      <td >Precio</td>
      <td >Marca</td>
      <td >Categoria</td>
      <td >Stock</td>
      <td >Acciones</td>


    </thead>
    <tbody class="table-group-divider" id="tabla-articulos-deportivos">
      @foreach ($articulos as $articulo)
        <tr>

          <td> <img src="{{url('producto/'. $articulo->foto) }}" alt="Foto aspirante" width="70px" height="70px"> </td>
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
          <td>{{ $articulo->stock}}</td>
          <td>
            <div class="d-flex justify-content-center">
              <button class="btn btn-success btn-sm"><i class="fa-solid fa-pencil"></i></button>
              <form class="mx-1" action="{{ route('eliminar_articulo', ['id' => $articulo->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
              </form>
              <button class="btn btn-secondary btn-sm"><i class="fa-solid fa-eye"></i></button>
            </div>

          </td>


        </tr>
      @endforeach
    </tbody>
</table>