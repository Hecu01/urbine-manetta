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
  <section>
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
        <strong>Atención!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif 
    <a  style="font-size: 2em" href="">Cargar saldo al cliente</a>
    <table class="table table-bordered text-center" style="min-width: 700px">
        <thead class="cabecera-tabla">
            <th>Id</th>
            <th style="text-transform: none">Nombre y apellido</th>
            <th style="text-transform: none">Direno en cuenta</th>
            <th>Cargar saldo</th>
        </thead>
        <tbody class="tbody-tabla">
          @foreach ($usuarios as $usuario)
            @if($usuario->descuentoUsuario->aceptado == true )

              <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }} {{ $usuario->lastname }}</td>
                <td>$ {{ $usuario->dinero_en_cuenta == null ? '0' : $usuario->dinero_en_cuenta }}</td>
                <td style="">
                  <div class="flex justify-center">

                    <a href="{{ route('asigarSaldoUsuario', $usuario->id) }}" class="btn btn-success btn-sm mx-1">
                      Cargar
                    </a>
                  </div>
                </td>
              </tr>
            @endif






          @endforeach
        </tbody>
    </table>








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

