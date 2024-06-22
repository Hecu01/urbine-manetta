@extends('admin.layouts.plantilla_admin')

@section('section-principal')

  <div class="w-fit">
    @include('admin.layouts.aside-left')
    <div class="flex justify-center mt-3 mb-5">
      <a href="{{ route('RoutePorcentajeDescEspeciales') }}" id="boton-regresar-atras" class="bg-blue-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
        <i class="fa-solid fa-circle-arrow-left"></i> Atrás
      </a>

    </div>

  </div>
  <section>
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
        <strong>Atención!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif 
    <a  style="font-size: 2em" href="">Poner cantidad de porcentaje descuento</a>
    <div class="">
        <ul>
            <li><strong>Usuario ID: </strong>{{ $DescuentoUsuario->user->id }}</li>
            <li><strong>Nombre: </strong>{{ $DescuentoUsuario->user->name }}</li>
            <li><strong>Apellido: </strong>{{ $DescuentoUsuario->user->lastname }}</li>
        </ul>
    </div>
    <form method="POST" action="{{ route('adjuntarDescuento', $DescuentoUsuario->id) }}" class="w-max border p-1">
        @csrf
        @method('PUT')
        {{-- <input type="hidden" name="descuentoId" value="{{ $DescuentoUsuario->id }}"> --}}
        <div class="flex mb-3">
            <label for="" class="text-xl " style="min-width: 135px">Descuento</label>
            <div class="input-group  ">
                <span class="input-group-text">%</span>
                <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="porcentaje_descuento" style="width:70px" id="precio-descontando">
            </div>
        </div>
        <div class="">
          <ul>
            <li><strong> Base de datos:</strong> {{$DescuentoUsuario->porcentaje_descuento}}%</li>
          </ul>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="btn btn-secondary">APLICAR</button>
        </div>
    </form>











  </section>

  <div class="aside">
    <h1>aside</h1>
  </div>

  <style>
    .cabecera-tabla th{
      text-align: center;
      margin: auto;
      text-transform: capitalize
    }
  </style>
@endsection

