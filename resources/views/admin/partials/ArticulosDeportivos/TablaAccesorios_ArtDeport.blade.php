<!-- Botón que activa el popover -->
<table class="table table-hover font-sans" id="resultsTable">
    <thead  style="border:1px solid rgb(16, 153, 163); text-align:center">
      <th>Foto</th>
      <th>Id</th>
      <th>Titulo</th>
      <th>Precio</th>
      <th>Marca</th>
      <th>Stock</th>
    </thead>
    <tbody  id="tabla-articulos-deportivos">
      @foreach ($articulos as $articulo)
        @if($articulo->id_categoria == 1 && $articulo->tipo_producto == "accesorio")
            <tr>
                <td> <img src="{{ url('producto/'. $articulo->foto) }}" alt="{{ $articulo->nombre }}" width="70px" height="70px"> </td>
                <td>{{ $articulo->id }}</td>
                <td><a href="{{ $articulo->id }}">{{ $articulo->nombre}}</a></td>
                <td class="precio">$ {{ number_format($articulo->precio, 0, ',', '.') }}</td>
                <td>{{ $articulo->marca }}</td>

                <td>

                  {{ $articulo->stock }}
                </td>
                <td class="acciones">
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

<style>
  .precio {
    font-weight: bold;
    color: green;
  }
</style>
