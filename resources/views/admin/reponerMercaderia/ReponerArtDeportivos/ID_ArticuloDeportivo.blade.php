@extends('admin.layouts.plantilla_admin')

@section('section-principal')

    <div class="w-fit mb-5">
        @include('admin.layouts.aside-left')
        <div class="flex justify-center mt-3">
            <a href="{{ route('solicitar-art-deport-index') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
                <i class="fa-solid fa-circle-arrow-left"></i> Atrás
            </a>

        </div>
    </div>
    <div class="">
        <h1>Solicitar reposicion del articulo</h1>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                <strong>Atención!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif 
        @if($artDeportivos->tipo_producto == "accesorio")
            <div class="flex justify-between">
                <ul>
                    <li><strong>Usuario ID: </strong>{{ $artDeportivos->id }}</li>
                    <li><strong>Nombre: </strong>{{ $artDeportivos->nombre }}</li>
                    <li><strong>Stock: </strong>{{ $artDeportivos->stock }}</li>
                </ul>
                <div class="">
                    <img style="margin: auto" src="{{ url('producto/'. $artDeportivos->foto) }}" alt="{{ $artDeportivos->nombre }}" width="100px" height="100px">

                </div>
            </div>
            <form method="POST" action="{{ route('reponer_mercaderia_artDeport', $artDeportivos->id) }}" class="w-max border p-1">
                @csrf
                {{-- <input type="hidden" name="descuentoId" value="{{ $DescuentoUsuario->id }}"> --}}
                <div class="flex mb-3">
                    <label for="" class="text-xl mx-2" style="">Solicitar</label>
                    <div class="input-group  ">
                        <span class="input-group-text">unidades</span>
                        <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="unidades_reposicion" style="width:70px" id="precio-descontando">
                        <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="tipo_producto" style="width:70px" value="No calzado" hidden>
                        <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="id_artDeport" style="width:70px" value="{{ $artDeportivos->id }}" hidden>
                    </div>
                </div>
                <div class="">
                <ul>
                    <li><strong> Mercaderia:</strong> {{$artDeportivos->stock}} en stock</li>
                </ul>
                </div>
            
                <div class="flex justify-center">
                    <button type="submit" class="btn btn-warning">Solicitar</button>
                </div>
            </form>
        @else
            <p class="bg-rose-500 text-white text-center">Página en desarrollo</p>
            @foreach ($calzados as $calzado)
                @php
                    $calzadoAsociado = $artDeportivos->calzados->firstWhere('pivot.calzado_id',
                        $calzado->id,
                    );
                @endphp

                <div class="mx-3 my-1">
                    @if ($calzadoAsociado)
                        {{-- Calzado existente --}}
                        <input type="hidden" name="calzado_ids[]" value="{{ $calzadoAsociado->id }}">

                        <label for="calzado-{{ $calzadoAsociado->id }}" class="mx-1">Talle N° {{ $calzadoAsociado->calzado }}</label>
                        {{-- <select name="stocks[]" id="stock-{{ $calzadoAsociado->id }}" class="border-1  border-cyan-600/[0.5] text-small input-suma p-0 px-2" style="width:70px;height:30px;">
                            @foreach ($stockOptions as $stockOption)
                                <option value="{{ $stockOption }}" {{ $calzadoAsociado->pivot->stocks == $stockOption ? 'selected' : '' }}>
                                    {{ $stockOption }}
                                    {{ $calzadoAsociado->pivot->stocks == $stockOption ? ' (*)' : '' }}
                                </option>
                            @endforeach
                        </select> --}}
                        <input type="text" name="" disabled id="stock-{{ $calzadoAsociado->id }}" class=" text-small my-1 input-suma p-0 px-2" style="width:30px;height:28px;" value="{{ $calzadoAsociado->pivot->stocks }}">
                        <label for="calzado-{{ $calzadoAsociado->id }}" class="mx-1">unidades disponibles || solicitar</label>
                        <input type="text" name="stock_solicitado_uno_a_muchos"  id="stock-{{ $calzadoAsociado->id }}" class="border-1  border-cyan-600/[0.5] text-small my-1 input-suma p-0 px-2" style="width:30px;height:28px;" value="0">
                    
                    @endif
                </div>
            @endforeach
        @endif
    </div>

    <!-- Artículos deportivos -->
    <div class="">
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
                </div>
            </a>
        </article>
  </div>
    
<style>
    #table-art-deport-solicitar {
        width: 680px
    }
</style>
@endsection












