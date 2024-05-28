@extends('admin.layouts.plantilla_admin')
@section('section-principal')


    <div class="w-fit" style="margin-bottom:100px">
        @include('admin.layouts.aside-left')
        <div class="flex justify-center mt-3">
            <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
                <i class="fa-solid fa-circle-arrow-left"></i> Atrás
            </a>

        </div>
        <br>
    </div>
    <div class=" mx-2 flex  border m-3 mt-3 p-2 justify-center h-fit" style="min-width: 600px; max-width:650px; max-height:400px">
        <div class="border-2 mr-2">
            <img src="{{ url('producto/' . $articulo->foto) }}" alt=" " style="height: 250px;width:250px;" class=" inset-0   object-cover w-full  m-auto" loading="lazy" />
        </div>
        <div class="" >
            <p class="text-xl font-semibold uppercase">{{ $articulo->nombre }}</p>    
            <p class="text-xl ">Precio actual - $<span id="precio-regular">{{ $articulo->precio }}</span></p>    
            <form method="POST" action="{{ route('crearDescuento', ['articuloId' => $articulo->id]) }}" class="w-max">
                @csrf
                <input type="hidden" name="articuloId" value="{{ $articulo->id }}">
                <div class="flex mb-3">
                    <label for="" class="text-xl " style="min-width: 135px">Precio nuevo -</label>
                    <div class="input-group  ">
                        <span class="input-group-text">$</span>
                        <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" style="width:70px" id="precio-descontando">
                    </div>
                </div>
                <p class=" bg-cyan-500 text-white text-xl px-1">
                    <input type="text" name="descuento" hidden id="input_precio_descontado">
                    Descuento: $<span id="precio-descontado"></span>
                </p>
                <p class=" bg-cyan-500 text-white text-xl px-1">
                    <input type="text" name="porcentaje" id="input_precio_porcentaje" hidden>
                    Porcentaje:  <span id="precio-porcentaje"></span>%
                </p>
                <div class="flex justify-center">
                    <button type="submit" class="btn btn-secondary">APLICAR</button>
                </div>
            </form>
            

        </div>
        

    </div>


    <!-- Artículos deportivos -->
    <a href="{{ route('descuentos') }}" class="text-white no-underline article0 bg-red-500 border-red-500 px-1">
        <div class="top">
            <span class="mt-3 text-3xl">
                OFF %
            </span>
            <span class="recuento">
                0
            </span>
        </div>
        <div class="bottom">
            <p>Descuentos activos</p>
        </div>
    </a> 

@endsection

