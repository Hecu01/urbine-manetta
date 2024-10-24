@extends('layouts.app')

@section('section-principal')
  @if (session('mensaje'))
    <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
        <strong>Atención!</strong> {{ session('mensaje') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif 
    
  <form action="{{ route('mi-perfil.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="container" style="padding-bottom: 35px; margin-top:20px; min-height: 500px">
    @csrf
    @method('PUT')
    
    {{-- Titulo --}}
    <h1 class="block mt-2 font-medium  text-gray-900 border-b-2">Editar perfil</h1>

    {{-- Contenedor --}}
    <div class="flex "style="justify-content:space-between; align-items:start">

      {{-- Contenedor izquierda/derecha --}}
      <div class="flex col-9" style="justify-content: space-between">
        
        {{-- Lado izquierdo datos registrados --}}
        <div class="">
          <h2>Datos Registrados</h2>
          <ul style="font-size: 1.2em; margin:0; padding:0; text-transform:capitalize">
            <li>
                <strong style="font-weight: 600">
                    Nombre
                </strong>:
                {{ $user->name }}
            </li>
            <li class="my-1">
                <strong style="font-weight: 600">
                    Apellido
                </strong>:
                {{ $user->lastname }} 
            </li>
            <li class="my-1">
                <strong style="font-weight: 600">
                    DNI
                </strong>:
                {{ number_format($user->dni, 0, ',', '.') }} 
            </li>

            
            {{-- ¿Existe descuento? --}}
            @isset(Auth::user()->descuentoUsuario->descuento_activo)
              {{-- Mostrar... y ahora --}}
              {{-- ¿está activo? --}}
              @if(Auth::user()->descuentoUsuario->descuento_activo == true)
                <li class="my-1">
                  <strong style="font-weight: 600">Profesion</strong>: 
                  {{ $user->descuentoUsuario->profesion_usuario}}
                </li>
              @endif

            @endisset

            {{-- Mostrar si el usuario ingresó su domicilio --}}
            @if(isset($user->domicilio))
              <hr>
              <li class="text-capitalize my-1"><strong style="font-weight: semibold " >Calle</strong>: {{ $user->domicilio->calle }} </li>
              <li class="text-capitalize my-1"><strong style="font-weight: 600">Barrio</strong>: {{ $user->domicilio->barrio }} </li>
              <li class="my-1"><strong style="font-weight: 600">Ciudad</strong>: {{ $user->domicilio->ciudad }} </li>
              <li class="my-1"><strong style="font-weight: 600">Codigo postal</strong>: {{ $user->domicilio->codigo_postal }} </li>
              <li class="my-1"><strong style="font-weight: 600">Provincia</strong>: {{ $user->domicilio->provincia }} </li>
              <li class="my-1"><strong style="font-weight: 600">País</strong>: {{ $user->domicilio->pais }} </li>
              <li class="my-1"><strong style="font-weight: 600">Depto</strong>: {{ $user->domicilio->departamento ? $user->domicilio->departamento : '-' }} </li>
              <li class="my-1"><strong style="font-weight: 600">Piso</strong>: {{ $user->domicilio->piso ? $user->domicilio->piso : '-' }} </li>
            @endif
          </ul>
        </div>



        {{-- Lado derecho para editar los datos --}}
        <div class="">
          <h2>Editar información</h2>

            <ul style="font-size: 1.2em; margin:0; padding:0; text-align:end">
              <li>
                <div class="flex justify-between">

                  <strong style="font-weight: 600">
                      Nombre:
                  </strong>
                  <input type="text" class="form-control mx-1" style="width: 200px; height:30px" value="{{ $user->name }}" name="nombre">
                </div>
              </li>
              
              <li class="my-1">
                <div class="flex justify-between">

                  <strong style="font-weight: 600">
                      Apellido:
                  </strong>
                  <input type="text" class="form-control mx-1" style="width: 200px; height:30px" value="{{ $user->lastname }}" name="apellido">
                </div>


              </li>           
  
              
              <li class="my-1">
                <div class="flex justify-between">

                  <strong style="font-weight: 600">
                      DNI:
                  </strong>
                  <input type="text" class="form-control mx-1" style="width: 200px; height:30px" value="{{ $user->dni }}" name="dni">
                </div>


              </li>           
  
   
  
              
              @isset(Auth::user()->descuentoUsuario->descuento_activo)
                @if(Auth::user()->descuentoUsuario->descuento_activo == true)
                  <li>
                    <strong style="font-weight: 600">Profesion</strong>: 
                    {{ $user->descuentoUsuario->profesion_usuario}}
                  </li>
                @endif
              @endisset
              @if(isset($user->domicilio))
                <hr>
                <li class="my-1">
                  <div class="flex justify-between">

                    <strong style="font-weight: 600">
                      Calle:
                    </strong>
                    <input type="text" class="form-control mx-1" style="width: 200px; height:30px " value="{{ $user->domicilio->calle }}" name="calle">
                  </div>
                </li>
                <li class="my-1">
                  <div class="flex justify-between">

                    <strong style="font-weight: 600">
                      Barrio:
                    </strong>
                    <input type="text" class="form-control mx-1" style="width: 200px; height:30px" value="{{ $user->domicilio->barrio }}" name="barrio">
                  </div>
                </li>
                <li class="my-1">
                  <div class="flex justify-between">

                    <strong style="font-weight: 600">
                      Ciudad:
                    </strong>
                    <input type="text" class="form-control mx-1" style="width: 200px; height:30px" value="{{ $user->domicilio->ciudad }}" name="ciudad">
                  </div>
                </li>
                <li class="my-1">
                  <div class="flex justify-between">

                    <strong style="font-weight: 600">
                      Cód. postal:
                    </strong>
                    <input type="text" class="form-control mx-1" style="width: 200px; height:30px" value="{{ $user->domicilio->codigo_postal }}" name="codigo_postal">
                  </div>
                </li>
                <li class="my-1">
                  <div class="flex justify-between">

                    <strong style="font-weight: 600">
                      Provincia:
                    </strong>
                    <input type="text" class="form-control mx-1" style="width: 200px; height:30px" value="{{ $user->domicilio->provincia }}" name="provincia">
                  </div>
                </li>
                <li class="my-1">
                  <div class="flex justify-between">

                    <strong style="font-weight: 600">
                      Pais:
                    </strong>
                    <input type="text" class="form-control mx-1" style="width: 200px; height:30px" value="{{ $user->domicilio->pais }}" name="pais">
                  </div>
                </li>
                <li class="my-1">
                  <div class="flex justify-between">

                    <strong style="font-weight: 600">
                      Depto:
                    </strong>
                    <input type="text" class="form-control mx-1" style="width: 200px; height:30px" value="{{ $user->domicilio->departamento }}" name="departamento">
                  </div>
                </li>
                <li class="my-1">
                  <div class="flex justify-between">

                    <strong style="font-weight: 600">
                      Piso:
                    </strong>
                    <input type="text" class="form-control mx-1" style="width: 200px; height:30px" value="{{ $user->domicilio->piso }}" name="piso">
                  </div>
                </li>
              @endif
            </ul>
          
        </div>

      </div>

      {{-- Contendor foto/titulo/email --}}
      <div class=" col-3" style="display: flex; flex-direction:column-reverse">
        <span class="text-slate-500 text-center"> {{ $user->email }}</span>
        <h3 class="text-center mt-2">Tu foto de perfil</h3>
        <div class="container  shadow-sm border-2 " style="height: 250px;width:250px;  display:flex; justify-content: center;align-items:center;  background:#fff; ">
          <img src="{{ url('usuario/'. $user->foto) }}" alt="foto de {{ $user->name }}" style="width:100%">
        </div>
      </div>

    </div>

    <button class="btn btn-primary" type="submit">Guardar cambios</button>
    <a class="btn btn-success" href="{{ route('mi-perfil.index') }}">Volver al perfil</a>
  

  </form> 

@endsection