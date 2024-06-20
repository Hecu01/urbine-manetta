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
    <a  style="font-size: 2em" href="">Pág. descuentos especiales</a>
    <table class="table table-bordered" style="min-width: 700px">
        <thead class="cabecera-tabla">
            <th>Id</th>
            <th>Nombre</th>
            <th>profesion <br> usuario</th>
            <th>motivo <br> descuento</th>
            <th>foto <br> certificado</th>
            <th>Habilitacion</th>
        </thead>
        <tbody>
          @foreach ($usuarios as $usuario)
            @if($usuario->descuentoUsuario->aceptado === null )

              <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }} {{ $usuario->lastname }}</td>
                <td>{{ $usuario->descuentoUsuario->profesion_usuario }}</td>
                <td>{{ $usuario->descuentoUsuario->motivo_descuento }}</td>
                <td><a href="#" data-foto="{{ $usuario->foto_certificado }}" >Certificado</a></td>
                <td>
                  {{-- aceptar --}}
                  <form id="aceptar" action="{{ route('AceptarDescuentoEspecial', $usuario->descuentoUsuario->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('PUT')
                  </form>
                  <button onclick="event.preventDefault();
                    if(confirm('¿Querés activar el descuento?')) {
                      document.getElementById('aceptar').submit();
                    }" class="btn btn-primary btn-sm">
                      Aceptar
                  </button>
              
                  {{-- rechazar --}}
                  <form id="rechazar" action="{{ route('RechazarDescuentoEspecial', $usuario->descuentoUsuario->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('PUT')
                  </form>
                  <button onclick="event.preventDefault();
                    if(confirm('¿Querés rechazar el descuento?')) {
                      document.getElementById('rechazar').submit();
                    }" class="btn btn-danger btn-sm">
                    Rechazar
                  </button>

                </td>
              </tr>
            @endif






          @endforeach
        </tbody>
    </table>
    @if($usuario->descuentoUsuario->aceptado !== null)
      <h2>...Vaya, ya no hay peticiones pendientes.</h2>
    @endif












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

