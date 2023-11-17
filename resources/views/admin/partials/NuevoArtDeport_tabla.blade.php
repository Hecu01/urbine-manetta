<table class="table table-hover">
    <thead  style="border:1px solid rgba(255, 0, 136, 0.377); text-align:center">
      <th>Foto</th>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Marca</th>
      <th>Categoria</th>
      <th>Stock</th>
    </thead>
    <tbody class="table-group-divider" id="tabla-articulos-deportivos">
      @foreach ($articulos as $articulo)
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
          <td>{{ $articulo->stock}}</td>
          <td>
            <div class="d-flex justify-content-center">
              <button class="btn btn-success btn-sm"><i class="fa-solid fa-pencil"></i></button>
              <form class="mx-1" id="deleteForm" data-id="{{ $articulo->id }}" action="{{ route('eliminar_articulo', ['id' => $articulo->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger btn-sm" type="submit" onclick="eliminarArticulo()"><i class="fa-solid fa-trash"></i></button>
              </form>
              <button class="btn btn-secondary btn-sm"><i class="fa-solid fa-eye"></i></button>
            </div>

          </td>


        </tr>
      @endforeach
    </tbody>
</table>
<div class="flex justify-center">
  {{ $articulos->links('pagination::bootstrap-4') }}
</div>