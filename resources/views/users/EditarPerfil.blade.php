@extends('layouts.app')

@section('section-principal')

    

  <div class="container" style="padding-bottom: 35px; margin-top:20px; height: 500px">
    <h1 class="block mt-2 font-medium  text-gray-900 border-b-2">Editar perfil</h1>
    <div class="flex "style="justify-content:space-between">
      <div class="flex col-9" style="justify-content: space-between">
        <div class="">
          <h2>Datos Personales</h2>
          <ul style="font-size: 1.2em; margin:0; padding:0">
            <li>
                <strong style="font-weight: 600">
                    Nombre
                </strong>:
                {{ $user->name }}
            </li>
            <li>
                <strong style="font-weight: 600">
                    Apellido
                </strong>:
                {{ $user->lastname }} 
            </li>
            <li><strong>Correo</strong>: {{ $user->email }} </li>
            
            @isset(Auth::user()->descuentoUsuario->descuento_activo)
              @if(Auth::user()->descuentoUsuario->descuento_activo == true)
                <li>
                  <strong style="font-weight: 600">Profesion</strong>: 
                  {{ $user->descuentoUsuario->profesion_usuario}}
                </li>
              @endif
            @endisset
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



        <div class="">
          <h2>Editar</h2>
          <ul style="font-size: 1.2em; margin:0; padding:0">
            <li>
              <strong style="font-weight: 600">
                  Nombre
              </strong>:
              {{ $user->name }}
            </li>
            
            <li>
                <strong style="font-weight: 600">
                    Apellido
                </strong>:
                {{ $user->lastname }} 
            </li>           

            <li><strong>Correo</strong>: {{ $user->email }} </li>
            
            @isset(Auth::user()->descuentoUsuario->descuento_activo)
              @if(Auth::user()->descuentoUsuario->descuento_activo == true)
                <li>
                  <strong style="font-weight: 600">Profesion</strong>: 
                  {{ $user->descuentoUsuario->profesion_usuario}}
                </li>
              @endif
            @endisset
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