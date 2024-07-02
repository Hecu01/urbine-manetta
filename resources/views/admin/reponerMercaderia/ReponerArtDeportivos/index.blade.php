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
        <h1>Solicitar mercadería de articulos deportivos</h1>
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
                    @foreach ($artDeportivos as $artDeportivo)
                        <tr>
                            <td class="fixed-column">{{ $artDeportivo->id }}</td>
                            <td class="fixed-column">
                                <img style="margin: auto" src="{{ url('producto/'. $artDeportivo->foto) }}" alt="{{ $artDeportivo->nombre }}" width="50px" height="50px">
                            </td>
                            <td>{{ $artDeportivo->nombre }}</td>
                            <td>{{ $artDeportivo->marca }}</td>
                            <td>{{ $artDeportivo->tipo_producto }}</td>
                            <td class="{{ $artDeportivo->stock < 20 ? 'text-rose-500' : '' }}">{{ $artDeportivo->stock }}</td>
                    
                            @php
                                $reposicionPendiente = $artDeportivo->reposiciones->firstWhere('estado', 'pendiente');
                            @endphp
                    
                            @if($reposicionPendiente)
                                <td>
                                    <button class="btn btn-warning btn-sm" disabled>Solicitado</button>
                                </td>
                            @else
                                <td>
                                    <a href="{{ route('solicitarMercaderiaArtDeport', $artDeportivo->id) }}" class="btn btn-success btn-sm">Solicitar</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
    </div>

    <div class="">
        <!-- Artículos deportivos -->
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

<style>
    #table-art-deport-solicitar {
        width: 680px
    }
    .fixed-columns th {
        background-color: #f2f2f2;
    }

</style>
@endsection


