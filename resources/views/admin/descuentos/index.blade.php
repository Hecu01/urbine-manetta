@extends('admin.layouts.plantilla_admin')
@section('section-principal')

    <div class="w-fit">
        @include('admin.layouts.aside-left')
        <div class="flex justify-center mt-3">
            <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
                <i class="fa-solid fa-circle-arrow-left"></i> Atrás
            </a>

        </div>
    </div>
 

    <div class="m-2" style="height: 500px">

        <div class="tab-content" id="" style="min-width: 950px">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="col-12 flex justify-center">
                    <div class="col-md-7" style="box-shadow: 0px 0px 1px #000" id="busqueda-para-descuentos">
                        <form class="d-flex mt-1" role="search">
                            <input type="search" class="form-control" placeholder="Buscá acá el producto a agregar descuento a través del ID, el nombre o el precio."  aria-label="Search" id="searchInput3">
                            @csrf
                        </form>
                    </div>
                </div>
                <table class="table w-max" id="resultsTable3">
                    <thead style="font-weight:bolder">
                        <th>Foto</th>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Precio principal</th>
                        <th>Aplicar descuento</th>

                    </thead>
                    <tbody id="tabla-descuentos">

   
                    </tbody>
        
                </table>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <table class="table w-max" >
                    <thead style="font-weight:bolder" class="text-center">
                        <th>Id</th>
                        <th>img</th>


                        <th>Titulo</th>
                        <th>Precio principal</th>
                        <th>Descuento</th>
                        <th>Precio con descuento</th>
                        <th>Activo</th>
                        <th>Acción</th>
                    </thead>
                    <tbody>
                        @foreach ($descuentos as $descuento)
                            @if ($descuento->articulo)
                                <tr class="text-center">
                                        
                                    <td>{{ $descuento->articulo->id}}</td>

                                    <td>

                                    
                                        {{-- Recuperar el artículo desde la base de datos usando el ID --}}
                                        @php
                                            $articulo = \App\Models\Articulo::find($descuento->articulo->id);
                                        @endphp

                                        {{-- Verificar si el artículo existe y tiene fotos --}}

                                        <div class="flex w-48 relative content-center">

                                            <div id="carousel-{{ $articulo->id }}" class="carousel slide mr-5" data-bs-ride="carousel"  style="display:flex; align-items:center;width: 200px;">
                                                <div class="carousel-inner">
                                                    @foreach($articulo->fotos as $index => $foto)
                                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                            <img src="{{ url('productos/' . $foto->ruta) }}" alt="{{ $articulo->nombre }}" style="width: 100px; height: auto;">

                                                        </div>
                                                    @endforeach
                                                </div>
                                    
                                                <!-- Controles del carrusel -->
                                                <button class="carousel-control-prev" style="color: red" type="button" data-bs-target="#carousel-{{ $articulo->id }}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true" style="color: red"></span>
                                                    <span class="visually-hidden" style="color: red">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $articulo->id }}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>                                    
                                        </div>
                                    
                                    
                                    
                                    
                                    </td>

                                    <td>{{ $descuento->articulo->nombre}}</td>
                                    <td> 
                                        <span >
                                            $ {{ number_format($descuento->articulo->precio, 0, ',', '.')}}
                                        </span>
                                        </td>
                                    <td> <span class="bg-green-500  p-1 text-white font-semibold">{{ number_format($descuento->porcentaje, 0, ',', '.') }}%</span></td>
                                    <td>
                                        <span class="font-semibold">
                                            $ {{ number_format($descuento->articulo->precio - $descuento->plata_descuento, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td> 
                                        @if($descuento->activo == true)
                                            <span class="bg-blue-500 text-white p-1 px-2 rounded-full">
                                                Sí
                                            </span>
                                        @else
                                            <span class="bg-red-500 text-white p-1 px-2 rounded-full">
                                                No
                                            </span>
                                        @endif
                                    </td>
                                    <td>

                                    {{-- Desactivar/activar descuento --}}
                                    <form id="cambiar-estado-form-{{ $descuento->id }}" action="{{ route('cambiar.estado.descuento', $descuento->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    
                                    @if($descuento->activo == true)
                                        <button onclick="event.preventDefault();
                                            if(confirm('¿Estás seguro de desactivar el descuento?')) {
                                                document.getElementById('cambiar-estado-form-{{ $descuento->id }}').submit();
                                            }" class="btn btn-warning btn-sm">
                                            Desactivar
                                        </button>
                                    @else
                                        <button onclick="event.preventDefault();
                                            if(confirm('¿Querés activar el descuento?')) {
                                                document.getElementById('cambiar-estado-form-{{ $descuento->id }}').submit();
                                            }" class="btn btn-success btn-sm">
                                            Activar
                                        </button>
                                    @endif

                                    
                                    
                                    {{-- Eliminar descuento --}}
                                    <a href="{{ route('eliminar.descuento', $descuento->id) }}" class="btn btn-danger btn-sm"
                                        onclick="event.preventDefault();
                                                    if(confirm('¿Estás seguro de eliminar este descuento?')) {
                                                        document.getElementById('eliminar-form-{{ $descuento->id }}').submit();
                                                    }">
                                        Eliminar
                                    </a>
                                    
                                    <form id="eliminar-form-{{ $descuento->id }}" action="{{ route('eliminar.descuento', $descuento->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                        
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        {{-- <tr>
                            <td>35</td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Sí</td>
                            <td><button class="btn btn-success btn-sm">Descuento</button></td>
                        </tr>
                        <tr>
                            <td>28</td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Sí</td>
                            <td><button class="btn btn-success btn-sm">Descuento</button></td>
                        </tr>
                        <tr>
                            <td>365</td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Lorem, ipsum dolor.</td>
                            <td>Sí</td>
                            <td><button class="btn btn-success btn-sm">Descuento</button></td>
                        </tr> --}}
                    </tbody>
        
                </table>
            </div>
            {{-- <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                ...
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                ...
            </div> --}}
        </div>


    </div>
    <div class="">
        <div class="d-flex align-items-start ">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Nuevo descuento</button>
                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Descuentos activos</button>
                {{-- <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button> --}}
                {{-- <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button> --}}
            </div>

        </div>
          
    </div>
@endsection

