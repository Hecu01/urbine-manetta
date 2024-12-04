@extends('admin.layouts.plantilla_admin')

@section('section-principal')

    <div class="w-fit mb-5">
        @include('admin.layouts.aside-left')
        <div class="flex justify-center mt-3">
            <a href="{{ route('reposicion-mercaderia.index') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
                <i class="fa-solid fa-circle-arrow-left"></i> Atrás
            </a>

        </div>
    </div>
    <div class="">
        <h1 class="font-semibold text-center">Tabla de Suplementos y Dieta</h1>
        <div class="table-container">
            <table class="table-bordered text-center fixed-columns" id="table-art-deport-solicitar">
                <thead>
                    <tr>
                        <th class="fixed-column">ID</th>
                        <th class="fixed-column">IMG</th>
                        <th>Articulo</th>
                        <th>Marca</th>
                        <th>Tipo <br> producto</th>
                        <th>Stock <br> Actual</th>
                        <th>Solicitar <br> Mercaderia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articulos as $articulo)
                        <tr>
                            <td class="fixed-column">{{ $articulo->id }}</td>
                            <td class="fixed-column">
                                @if ($articulo->fotos->isNotEmpty())
                                    <img src="{{ url('productos/' . $articulo->fotos->first()->ruta) }}"
                                        alt="{{ $articulo->nombre }}" width="70px" height="70px" style="display: block; margin: 0 auto;">
                                @else
                                    <span></span>
                                @endif
                            </td>
                            <td>{{ $articulo->nombre }}</td>
                            <td>{{ $articulo->marca }}</td>
                            <td>{{ $articulo->tipo_producto }}</td>
                            <td class="{{ $articulo->stock < 20 ? 'text-rose-500' : '' }}">{{ $articulo->stock }}</td>
                    
                            @php
                                $reposicionPendiente = $articulo->reposiciones->firstWhere('estado', 'Pendiente');
                            @endphp
                    
                            @if($reposicionPendiente)
                                <td>
                                    <button class="btn btn-warning btn-sm" disabled>Solicitado</button>
                                </td>
                            @else
                                <td>
                                    <a href="{{ route('solicitarMercaderia', $articulo->id) }}" class="btn btn-success btn-sm">Solicitar</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
    </div>

    <!-- card reponer mercaderias -->
    @include('admin.reponerMercaderia.partials.CardReposicion')

<style>
    #table-art-deport-solicitar {
        width: 680px
    }
    .fixed-columns th {
        background-color: #f2f2f2;
    }

</style>
@endsection


