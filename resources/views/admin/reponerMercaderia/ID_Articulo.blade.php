@extends('admin.layouts.plantilla_admin')

@section('section-principal')
    {{-- ¿Existe el pedido de reposicion? --}}
    @php
        $reposicionPendiente = $articulos->reposiciones->firstWhere('estado', 'Pendiente');
    @endphp

    <div class="w-fit mb-5">
        @include('admin.layouts.aside-left')
        <div class="flex justify-center mt-3">
            @switch($articulos->id_categoria)
                @case(1)
                    <a href="{{ route('solicitar-art-deport-index') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
                        <i class="fa-solid fa-circle-arrow-left"></i> Atrás
                    </a>
                    @break
                @case(2)
                    <a href="{{ route('solicitar-rop-deport-index') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
                        <i class="fa-solid fa-circle-arrow-left"></i> Atrás
                    </a>
                    @break
                @case(3)
                    <a href="{{ route('solicitar-sup-diet-index') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
                        <i class="fa-solid fa-circle-arrow-left"></i> Atrás
                    </a>
                    @break
                @default
                    
            @endswitch

        </div>
    </div>
    <div class="">
        <h1>Solicitar reposicion del articulo</h1>

        @if (session('success'))
            @include('admin.partials.MsjDelSistema.ArtAgregConExito') 
        @endif 

        @switch($articulos->tipo_producto)
             {{-- Articulos deportivos --}}
            @case('accesorio')
                <div class="flex justify-between">
                    <ul>
                        <li><strong>Usuario ID: </strong>{{ $articulos->id }}</li>
                        <li><strong>Nombre: </strong>{{ $articulos->nombre }}</li>
                        <li><strong>Stock: </strong>{{ $articulos->stock }}</li>
                    </ul>
                    {{-- <div class="">
                        <img style="margin: auto" src="{{ url('producto/'. $articulos->foto) }}" alt="{{ $articulos->nombre }}" width="100px" height="100px">

                    </div> --}}
                </div>
                <form method="POST" action="{{ route('reponer_mercaderia', $articulos->id) }}" class="w-max border p-1">
                    @csrf
                    {{-- <input type="hidden" name="descuentoId" value="{{ $DescuentoUsuario->id }}"> --}}
                    <div class="flex mb-3">
                        <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="id_categoria" style="width:70px" value="{{ $articulos->id_categoria }}" hidden>

                        <label for="" class="text-xl mx-2" style="">Solicitar</label>
                        <div class="input-group  ">
                            <span class="input-group-text">unidades</span>
                            <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="unidades_reposicion" style="width:70px" id="precio-descontando">
                            <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="tipo_producto" style="width:70px" value="No calzado" hidden>
                            <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="id_artDeport" style="width:70px" value="{{ $articulos->id }}" hidden>
                        </div>
                    </div>
                    <div class="">
                    <ul>
                        <li><strong> Mercaderia:</strong> {{$articulos->stock}} en stock</li>
                    </ul>
                    </div>
                    
                
                    {{--  --}}
                    <div class="mb-5 mt-1">

                        @if($reposicionPendiente)
                            <button class="btn btn-success btn-lg mt-2" type="submit" disabled>Encargado</button>
                            <div class="d-grid mt-4">
                                <a class="btn btn-primary" href="{{ route('tablaArticulosDeportivos') }}">TABLA DE PEDIDOS</a>
                            </div>
                        @else
                            <button class="btn btn-success btn-lg mt-2" type="submit">Encargar</button>
                        @endif
                    </div>

                </form>
                
                @break

             <!-- Articulos deportivos:calzado -->
            @case('calzado')
                <div class="flex justify-between">
                    <ul>
                        <li><strong>Usuario ID: </strong>{{ $articulos->id }}</li>
                        <li><strong>Nombre: </strong>{{ $articulos->nombre }}</li>
                        <li><strong>Stock: </strong>{{ $articulos->stock }}</li>
                    </ul>
                    {{-- <div class="">
                        <img style="margin: auto" src="{{ url('producto/'. $articulos->foto) }}" alt="{{ $articulos->nombre }}" width="100px" height="100px">

                    </div> --}}
                </div>
                <form method="POST" action="{{ route('reponer_mercaderia', $articulos->id) }}" class="p-1">
                    @csrf
                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="id_categoria" style="width:70px" value="{{ $articulos->id_categoria }}" hidden>

                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="id_artDeport" style="width:70px" value="{{ $articulos->id }}" hidden>

                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="tipo_producto" style="width:70px" value="calzado" hidden>
                    


                    <div class="" style="overflow-y :scroll; max-height:250px; padding-right:10px">

                        @foreach ($calzados as $calzado)
                            @php
                                $calzadoAsociado = $articulos->calzados->firstWhere('pivot.calzado_id',$calzado->id);
                            @endphp
    
                            @if ($calzadoAsociado)
                                <div class="flex" style="width: 100%; ">
    
                                    {{-- talle asociado --}}
                                    <input type="hidden" name="art_id_muchos_a_muchos[]" value="{{ $calzadoAsociado->id }}">
                                    <input type="hidden" name="valorCalzadoTalle[]" value="{{ $calzadoAsociado->talle }}">
                                    <input type="hidden" name="muchos_a_muchos_bool" value="true">
                                    
                                    <table class="table table-bordered text-center">
                                        <thead class="font-semibold uppercase">
                                            <td>Talle</td>
                                            <td>Disponibles</td>
                                            <td>solicitar</td>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td >
                                                    {{ $calzadoAsociado->calzado }}
                                                </td>
                                                <td >
                                                    <div class="flex justify-center">

                                                        <input type="text" disabled id="stock-{{ $calzadoAsociado->id }}" class="text-center form-control text-small my-1 input-suma p-0 px-2" style="width:50px;height:28px;" value="{{ $calzadoAsociado->pivot->stocks }}">
                                                    </div>
                                                    
                                                </td>
    
                                                <td style="">
                                                    <div class="flex justify-center">

                                                        <input type="text" name="stock_solicitado_muchos_a_muchos[]"  id="stock-{{ $calzadoAsociado->id }}" class="border-1 form-control border-cyan-600/[0.5] text-small my-1 input-suma p-0 px-2" style="width:50px;height:28px;" >
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
    
                                
                                </div>
                            @endif
                        @endforeach
                    </div>

                    {{--  --}}
                    <div class="mb-5 mt-1">

                        @if($reposicionPendiente)
                            <button class="btn btn-success btn-lg mt-2" type="submit" disabled>Encargado</button>
                            <div class="d-grid mt-4">
                                <a class="btn btn-primary" href="{{ route('tablaArticulosDeportivos') }}">TABLA DE PEDIDOS</a>
                            </div>
                        @else
                            <button class="btn btn-success btn-lg mt-2" type="submit">Encargar</button>
                        @endif
                    </div>

                </form>
                @break

             {{-- Ropa deportivas  --}}
           
            @case($articulos->id_categoria == 2) 
                <div class="flex justify-between">
                    <ul>
                        <li><strong>Usuario ID: </strong>{{ $articulos->id }}</li>
                        <li><strong>Nombre: </strong>{{ $articulos->nombre }}</li>
                        <li><strong>Stock: </strong>{{ $articulos->stock }}</li>
                    </ul>
                    {{-- <div class="">
                        <img style="margin: auto" src="{{ url('producto/'. $articulos->foto) }}" alt="{{ $articulos->nombre }}" width="100px" height="100px">

                    </div> --}}
                </div>
                <form method="POST" action="{{ route('reponer_mercaderia', $articulos->id) }}" class="p-1">
                    @csrf
                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="id_categoria" style="width:70px" value="{{ $articulos->id_categoria }}" hidden>

                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="id_artDeport" style="width:70px" value="{{ $articulos->id }}" hidden>

                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="tipo_producto" style="width:70px" value="ropa" hidden>
                    <div class="" style="overflow-y :scroll; max-height:250px; padding-right:10px">

                        @foreach ($talles as $talle)
                            @php
                                $talleAsociado = $articulos->talles->firstWhere('pivot.talle_id',$talle->id);
                            @endphp
    
                            @if ($talleAsociado)
                                <div class="flex" style="width: 100%; ">
    
                                    {{-- talle asociado --}}
                                    <input type="hidden" name="art_id_muchos_a_muchos[]" value="{{ $talleAsociado->id }}">
                                    <input type="hidden" name="valorCalzadoTalle[]" value="{{ $talleAsociado->talle_ropa }}">
                                    <input type="hidden" name="muchos_a_muchos_bool" value="true">

                                    
                                    
                                    <table class="table table-bordered text-center">
                                        <thead class="font-semibold uppercase">
                                            <td>Talle</td>
                                            <td>Disponibles</td>
                                            <td>solicitar</td>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td >
                                                    {{ $talleAsociado->talle_ropa }}
                                                </td>
                                                <td >
                                                    <div class="flex justify-center">

                                                        <input type="text" disabled id="stock-{{ $talleAsociado->id }}" class="text-center form-control text-small my-1 input-suma p-0 px-2" style="width:50px;height:28px;" value="{{ $talleAsociado->pivot->stocks }}">
                                                    </div>
                                                    
                                                </td>
    
                                                <td style="">
                                                    <div class="flex justify-center">

                                                        <input type="text" name="stock_solicitado_muchos_a_muchos[]"  id="stock-{{ $talleAsociado->id }}" class="border-1 form-control border-cyan-600/[0.5] text-small my-1 input-suma p-0 px-2" style="width:50px;height:28px;" >
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
    
                                
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div id="contenedor-modal-talles">
                        @include('admin.ropasDeportivas.partials.talleSinStock', [
                            'oldTalles' => old('talles', []),
                        ])
                    </div>
                    <div class="col-md-4 ">
                        <button id="agregar-calzados" type="button"
                            class="bg-slate-600 rounded-full py-2 px-4 hover:cursor-pointer hover:scale-105  text-white "
                            data-bs-toggle="modal" data-bs-target="#modalTalles">Nuevos talles</button>
                    </div>
                    {{--  --}}
                    <div class="mb-5 mt-1">

                        @if($reposicionPendiente)
                            <button class="btn btn-success btn-lg mt-2" type="submit" disabled>Encargado</button>
                            <div class="d-grid mt-4">
                                <a class="btn btn-primary" href="{{ route('tablaRopasDeportivas') }}">TABLA DE PEDIDOS</a>
                            </div>
                        @else
                            <button class="btn btn-success btn-lg mt-2" type="submit">Encargar</button>
                        @endif
                    </div>
                </form>
                @break
            @case($articulos->id_categoria == 3) 
                <div class="flex justify-between">
                    <ul>
                        <li><strong>Usuario ID: </strong>{{ $articulos->id }}</li>
                        <li><strong>Nombre: </strong>{{ $articulos->nombre }}</li>
                        <li><strong>Stock: </strong>{{ $articulos->stock }}</li>
                    </ul>
                    {{-- <div class="">
                        <img style="margin: auto" src="{{ url('producto/'. $articulos->foto) }}" alt="{{ $articulos->nombre }}" width="100px" height="100px">

                    </div> --}}
                </div>
                <form method="POST" action="{{ route('reponer_mercaderia', $articulos->id) }}" class="w-max border p-1">
                    @csrf
                    {{-- <input type="hidden" name="descuentoId" value="{{ $DescuentoUsuario->id }}"> --}}
                    <div class="flex mb-3">
                        <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="id_categoria" style="width:70px" value="{{ $articulos->id_categoria }}" hidden>

                        <label for="" class="text-xl mx-2" style="">Solicitar</label>
                        <div class="input-group  ">
                            <span class="input-group-text">unidades</span>
                            <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="unidades_reposicion" style="width:70px" id="precio-descontando">
                            <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="tipo_producto" style="width:70px" value="No calzado" hidden>
                            <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="id_artDeport" style="width:70px" value="{{ $articulos->id }}" hidden>
                        </div>
                    </div>
                    <div class="">
                    <ul>
                        <li><strong> Mercaderia:</strong> {{$articulos->stock}} en stock</li>
                    </ul>
                    </div>
                
                    {{--  --}}
                    <div class="mb-5 mt-1">

                        @if($reposicionPendiente)
                            <button class="btn btn-success btn-lg mt-2" type="submit" disabled>Encargado</button>
                            <div class="d-grid mt-4">
                                <a class="btn btn-primary" href="{{ route('tablaArticulosDeportivos') }}">TABLA DE PEDIDOS</a>
                            </div>
                        @else
                            <button class="btn btn-success btn-lg mt-2" type="submit">Encargar</button>
                        @endif
                    </div>

                </form>
                @break
            @default
                
        @endswitch


    </div>

    <!-- card reponer mercaderias -->
    @include('admin.reponerMercaderia.partials.CardReposicion')
    

    

@endsection












