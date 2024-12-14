@extends('admin.layouts.plantilla_admin')
@section('section-principal')
  <style>
    table tr th, table tr td{
      text-align: center;
    }
  </style>
  @if (session('success'))
    @include('admin.partials.MsjDelSistema.VendidoConExito') 
  @endif 


  <div class="w-fit mb-5">
    @include('admin.layouts.aside-left')
    <div class="flex justify-center mt-3">
      <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class="bg-blue-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
      <i class="fa-solid fa-circle-arrow-left"></i> Atrás
      </a>
    </div>
  </div>
  <div class="flex justify-center mt-3" >

    <div class="">
      <article class="article0 bg-red-500   px-2 hover:scale-105">
          <a href="{{ asset('compras-realizadas') }}" class="text-white no-underline">
          <div class="top">
              <span>
                <i class="fa-solid fa-cart-shopping" ></i>


              </span>
              <span class="recuento">
                  <i class="fa-solid fa-up-long" style="font-size: 1em"></i>
              </span>
          </div>
          <div class="bottom " style="font-size: 1.055em">
              <p>Aceptar o rechazar compras <br> pendientes</p>
          </div>
          </a>
      </article>
    </div>
    

    <div class="">
      <article class="article0 bg-slate-700   px-2 hover:scale-105">
          <a href="{{ route('compras.tabla') }}" class="text-white no-underline">
          <div class="top">
              <span>
                <i class="fa-solid fa-table"></i>

              </span>
              <span class="recuento">
                  <i class="fa-solid fa-up-long" style="font-size: 1em"></i>
              </span>
          </div>
          <div class="bottom " style="font-size: 1.055em">
              <p>Tabla de compras realizadas</p>
          </div>
          </a>
      </article>
    </div>

  </div>

  <div class=""style="border-left: 1px solid rgba(0, 0, 0, 0.315)">

    <article class="article0    px-3 bg-green-600 "   >
      <a href="{{ route('compras.index') }}" class="text-white no-underline">
        <div class="top">
          <span>
            <i class="fa-solid fa-chart-line"></i>
          </span>
          <span class="recuento">
            {{ $comprasRealizadas }}
          </span>
        </div>
        <div class="bottom">
          <p>
            Compras de clientes
            <br>
            (Recuento)

          </p>

        </div>
      </a>
    </article>
  </div>

 

@endsection