@extends('admin.layouts.plantilla_admin')

@section('section-principal')

    <div class="w-fit mb-5">
        @include('admin.layouts.aside-left')
        <div class="flex justify-center mt-3">
            <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
                <i class="fa-solid fa-circle-arrow-left"></i> Atrás
            </a>

        </div>
    </div>
    <div class="">
        <h1>Solicitar reposicion del articulo</h1>


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
        <form method="POST" action="{{ route('adjuntarDescuento', $artDeportivos->id) }}" class="w-max border p-1">
            @csrf
            @method('PUT')
            {{-- <input type="hidden" name="descuentoId" value="{{ $DescuentoUsuario->id }}"> --}}
            <div class="flex mb-3">
                <label for="" class="text-xl mx-2" style="">Solicitar</label>
                <div class="input-group  ">
                    <span class="input-group-text">unidades</span>
                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="porcentaje_descuento" style="width:70px" id="precio-descontando">
                </div>
            </div>
            <div class="">
              <ul>
                <li><strong> Mercaderia:</strong> {{$artDeportivos->stock}} en stock</li>
              </ul>
            </div>
        
            <div class="flex justify-center">
                <button type="submit" class="btn btn-warning">Pedir</button>
            </div>
        </form>
    </div>

    <div class="">
        <h1>aside</h1>
    </div>

<style>
    #table-art-deport-solicitar {
        width: 680px
    }
</style>
@endsection












