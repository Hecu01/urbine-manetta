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
    {{-- <div class="my-1">
      <a class="btn btn-primary" href=" {{ route('tablaClientesActivos') }} ">Tabla clientes Activos</a>
    </div>
    <div class="my-1" >
      <button class="btn btn-danger"  disabled >Consultas y reclamos</button>
    </div>
    <div class="my-1">
      <a class="btn btn-info" href=" {{ route('RouteDescuentosEspeciales') }} ">Habilitar/Inhabilitar descuento</a>
    </div>
    <div class="my-1">
      <a class="btn btn-secondary" href=" {{ route('RoutePorcentajeDescEspeciales') }} ">Asignar % de descuento</a>
    </div>
    <div class="my-1">
      <a class="btn btn-success" href=" {{ route('RouteCargarSaldo') }} ">Cargar saldo</a>
    </div> --}}
  
    <table class="table table-bordered">
      <thead>
        <th>ID</th>
        <th>Usuario</th>
        <th>Dni</th>
        <th>Email</th>
        <th>Compras realizadas</th>
        <th>Se unió en</th>
      </thead>
      <tbody>
        @foreach ($clientes as $cliente)
          <tr>
            <td>{{$cliente->id}}</td>
            <td>{{$cliente->name}} {{$cliente->lastname}}</td>
            <td>{{$cliente->dni}}</td>
            <td>{{$cliente->email}}</td>
            <td>
              <span>{{$cliente->compras_realizadas}}</span>
            </td>
            <td>{{ $cliente->created_at->format('d/m/Y') }}</td>
          </tr>
        @endforeach

      </tbody>
    </table>
  </section>

  <a href="{{ route('clientes-activos.index') }}" class="text-white no-underline article0 article1 px-2 hover:scale-105">
    <div class="top">
        <span>
            <i class="fa-solid fa-user-plus"></i>
        </span>
        <span class="recuento">
            {{ $recuentoClientes }}
        </span>
    </div>
    <div class="bottom">
        <p>Clientes activos</p>
    </div>
 </a>

@endsection

