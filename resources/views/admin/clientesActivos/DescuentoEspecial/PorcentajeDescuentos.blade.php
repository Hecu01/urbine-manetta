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
    <a  style="font-size: 2em" href="">Pág. asignar porcentaje descuento especial</a>
    <table class="table table-bordered" style="min-width: 700px">
        <thead class="cabecera-tabla">
            <th>Id</th>
            <th>Nombre y <br> Apellido</th>
            <th>Estado <br> Descuento</th>
            <th>Profesión <br> Usuario</th>
            <th>Porcentaje <br> Descuento</th>
            <th>Acciones</th>
        </thead>
        <tbody class="tbody-tabla">
          @foreach ($usuarios as $usuario)
            @if($usuario->descuentoUsuario->aceptado == true )

              <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }} {{ $usuario->lastname }}</td>
                <td style="text-align: center">
                  <p class="text-white {{$usuario->descuentoUsuario->descuento_activo ? 'bg-green-500' : 'bg-red-500' }}" style="border-radius: 50px">
                    {{$usuario->descuentoUsuario->descuento_activo ? 'Activo' : 'Inactivo'}} 
                  </p>

                </td>
                <td>{{ $usuario->descuentoUsuario->profesion_usuario }}</td>
                <td>{{ $usuario->descuentoUsuario->porcentaje_descuento }}%</td>
                <td style="">
                  {{-- Habilitar e Inhabilitar --}}
                  <form id="habilitarInhabilitar" action="{{ route('HabilitarInhabilitarDescuento', $usuario->descuentoUsuario->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('PUT')
                  </form>
                  <div class="flex justify-center">
                    @if($usuario->descuentoUsuario->descuento_activo)
                      <button onclick="event.preventDefault();
                        if(confirm('¿Quieres desactivar el descuento?')) {
                          document.getElementById('habilitarInhabilitar').submit();
                        }" class="btn btn-danger btn-sm">
                        Desactivar
                    </button>
                    @else
                      <button onclick="event.preventDefault();
                        if(confirm('¿Quieres habilitar nuevamente el descuento?')) {
                          document.getElementById('habilitarInhabilitar').submit();
                        }" class="btn btn-success btn-sm">
                        Activar
                      </button>

                    @endif
                    <a href="{{ route('pagAsignarDescuento', $usuario->descuentoUsuario->id) }}" class="btn btn-primary btn-sm mx-1">
                      % descuento
                    </a>
                  </div>
                </td>
              </tr>
            @endif






          @endforeach
        </tbody>
    </table>
  </section>

  <a href="{{ route('clientes-activos.index') }}" class="text-white no-underline article0 article1 px-2">
    <div class="top">
        <span>
            <i class="fa-solid fa-user-plus"></i>
        </span>
        <span class="recuento">
            0
        </span>
    </div>
    <div class="bottom">
        <p>Clientes activos</p>
    </div>
 </a>


  <style>
    .cabecera-tabla th, .tbody-tabla tr td{
      text-align: center;
      margin: auto;
    }
  </style>
@endsection

