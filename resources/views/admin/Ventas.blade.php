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
 

    <div class="" style="height: 500px; ">
      <div class="">
        {{-- <select id="">
          <option value="" selected hidden>Seleccione</option>
          <option value="">Cliente registrado</option>
          <option value="">Cliente no registrado</option>
        </select> --}}

        {{-- Cliente registrado formulario --}}
        <form action="" class="  border p-4" style="width:700px">
          <label for="">DNI</label><br>
          <input type="text"><br>

          
          <div class="flex mt-3 col-6">
            <div class="flex mx-2">
              <div class="col-6">
                <label for="">Artículo a vender</label><br>
                <select name="" id="">
                  @foreach ($deportes as $item)
                      <option value="">{{ $item->deporte }}</option>
                  @endforeach  
  
                </select>
              </div>
              <div class="col-2">

                <label for="">Cantidad</label><br>
                <input type="text"  class=" mx-2" >
              </div>
            </div>
            <a href="#" class="btn btn-primary h-fit " style="margin-left: 20px; margin-top:25px">Añadir</a>

          </div>          

          <button class="btn btn-success mt-5">Vender</button>

        </form>
        {{-- <form action="" class="  border p-4" style="width:700px">
          <label for="">DNI</label><br>
          <input type="text"><br>
          <div class="">
            @foreach ($articulos as $item)
                <p> {{ $item->id }} </p>
            @endforeach  
          </div>          

        </form> --}}
        {{-- <div id="cliente-registrado">
          
        </div>
        <div id="cliente-no-registrado">
          
        </div> --}}

      </div>

    </div>
  <!-- Artículos deportivos -->
  <article class="article0 article4   px-2"  id="redirigirBoton">
    <a href="{{ route('nuevo_articulo') }}" class="text-white no-underline">
      <div class="top">
        <span>
          <i class="fa-solid fa-football"></i>
        </span>
        <span class="recuento">
         35000
        </span>
      </div>
      <div class="bottom">
        <p>V <br> disponibles</p>
      </div>
    </a>
  </article>
@endsection

