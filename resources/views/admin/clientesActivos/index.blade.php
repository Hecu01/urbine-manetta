@extends('admin.layouts.plantilla_admin')

@section('section-principal')

  <div class="w-fit">
    @include('admin.layouts.aside-left')
    <div class="flex justify-center mt-3 mb-5">
      <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class="bg-blue-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
        <i class="fa-solid fa-circle-arrow-left"></i> Atrás
      </a>

    </div>

  </div>
  <section>
    <div class="my-1">
      <a class="btn btn-primary" href=" {{ route('RouteDescuentosEspeciales') }} ">Habilitar/Inhabilitar descuento</a>
    </div>
    <div class="my-1">
      <a class="btn btn-secondary" href=" {{ route('RoutePorcentajeDescEspeciales') }} ">Asignar % de descuento</a>
    </div>
    <div class="my-1">
      <a class="btn btn-success" href=" {{ route('RoutePorcentajeDescEspeciales') }} ">Cargar saldo</a>
    </div>
  </section>

  <div class="aside">
    <h1>aside</h1>
  </div>
@endsection

