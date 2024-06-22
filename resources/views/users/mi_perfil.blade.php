@extends('layouts.app')

@section('section-principal')


  <div class="container" style="padding-bottom: 35px; margin-top:20px; height: 500px">
    <h1 class="block mt-2 font-medium  text-gray-900 border-b-2">Información personal</h1>
    <div class="flex "style="justify-content:space-between">
      <div class="flex col-9" style="justify-content: space-between">
        <div class="">
          <h2>Datos Personales</h2>
          <ul style="font-size: 1.2em; margin:0; padding:0">
            <li><strong style="font-weight: 600">{{ $user->administrator ? 'Admin' : 'Usuario' }}</strong>: {{ $user->name }} {{ $user->lastname }} </li>
            <li><strong>Correo</strong>: {{ $user->email }} </li>
            @if(isset(Auth::user()->descuentoUsuario->descuento_activo) == true)
              <li class="bg-rose-500 text-white px-1 w-fit  ">
                <strong style="font-weight: 600">Profesion</strong>: 
                {{ $user->descuentoUsuario->profesion_usuario}}</li>
            @endif
            @if(isset($user->domicilio))
              <li class="text-capitalize"><strong style="font-weight: semibold " >Calle</strong>: {{ $user->domicilio->calle }} </li>
              <li class="text-capitalize"><strong style="font-weight: 600">Barrio</strong>: {{ $user->domicilio->barrio }} </li>
              <li><strong style="font-weight: 600">Ciudad</strong>: {{ $user->domicilio->ciudad }} </li>
              <li><strong style="font-weight: 600">Codigo postal</strong>: {{ $user->domicilio->codigo_postal }} </li>
            @else
              <a href="{{ route('domicilio') }}" class="btn btn-primary mt-1">Cargar datos domicilio</a>
            @endif

          </ul>
        </div>
        <div class="" style="margin-right:50px">
          <h2>Datos sportivo</h2>
          <ul style="font-size: 1.2em; margin:0; padding:0">
            <li>
              <strong style="font-weight: 600">Se unió a Sportivo</strong>: 
              {{ $user->created_at->format('d/m/Y') }}  
            </li>
            <li>
              <strong style="font-weight: 600">Hora</strong>: 
              {{ $user->created_at->format('H:i:s') }}  
            </li>
            <li>
              <strong style="font-weight: 600">Rol</strong>: 
              {{ $user->administrator ? 'Admin' : 'Usuario' }}  
            </li>

            @if(isset(Auth::user()->descuentoUsuario->descuento_activo) == true)
              <li class="bg-rose-500 text-white px-1 w-fit">
                <strong style="font-weight: 600">Descuento especial</strong>: 
                {{ $user->descuentoUsuario->porcentaje_descuento}}%  
              </li>
            @endif

            <li>
              <strong style="font-weight: 600">Compras</strong>: 
              {{$user->compras_realizadas == null ? '0' : $user->compras_realizadas }}
            </li>
            <li >
              <strong style="font-weight: 600; ">Dinero</strong>: 
              $ {{ number_format($user->dinero_en_cuenta, 0, ',', '.')}}
            </li>
            <li class="text-yellow-500">
              <strong style="font-weight: 600; ">Puntos</strong>: 
              {{$user->puntos == null ? '0' : $user->puntos }}
            </li>

          </ul>
        </div>
      </div>
      <div class=" col-3" style="display: flex; flex-direction:column-reverse">
        <h3 class="text-center mt-2">Tu foto de perfil</h3>
        <div class="container  shadow-sm border-2 " style="height: 250px;width:250px;  display:flex; justify-content: center;align-items:center;  background:#fff; ">
          <img src="{{ url('usuario/'. $user->foto) }}" alt="" >
        </div>
      </div>
    </div>
  

  </div>  

@endsection