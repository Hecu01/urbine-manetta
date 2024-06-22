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
    <h1>Tabla clientes activos</h1>
    <table class="table table-bordered" style="min-width: 700px">
        <thead class="cabecera-tabla">
            <th>Id</th>
            <th>Nombre</th>
            <th>Correo Electrónico</th>
        </thead>
        <tbody>
          @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }} {{ $usuario->lastname }}</td>
                <td>{{ $usuario->email }}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </section>
  <div class="aside">
    <h1>aside</h1>
  </div>


@endsection

