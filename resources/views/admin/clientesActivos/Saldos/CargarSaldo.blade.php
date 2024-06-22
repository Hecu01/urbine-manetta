@extends('admin.layouts.plantilla_admin')

@section('section-principal')

  <div class="w-fit">
    @include('admin.layouts.aside-left')
    <div class="flex justify-center mt-3 mb-5">
      <a href="{{ route('clientes-activos.index') }}" id="boton-regresar-atras" class="bg-blue-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
        <i class="fa-solid fa-circle-arrow-left"></i> Atrás
      </a>

    </div>

  </div>
  <section >
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
        <strong>Atención!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif 
    <a  style="font-size: 2em" href="">Cargar saldo al usuario </a>
    <div class="">
        <ul>
            <li><strong>Usuario ID: </strong>{{ $user->id }}</li>
            <li><strong>Nombre: </strong>{{ $user->name }}</li>
            <li><strong>Apellido: </strong>{{ $user->lastname }}</li>
            <li><strong>Saldo: $ </strong>{{ $user->dinero_en_cuenta == null ? '0' : $user->dinero_en_cuenta }}</li>
        </ul>
    </div>
    <form method="POST" action="{{ route('carga_virtual_saldo', $user->id) }}" class="w-max border p-1" >
        @csrf
        @method('PUT')
        <div class="flex mb-3">
          <label for="" class="text-xl " style="min-width: 135px">Descuento</label>
          <div class="input-group  ">
            <span class="input-group-text">$</span>
            <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="plata" style="width:70px" id="precio-descontando">
          </div>
        </div>
        <div class="flex justify-center">
          <button type="submit" class="btn btn-success">Cargar</button>
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

