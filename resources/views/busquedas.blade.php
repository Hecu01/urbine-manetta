@extends('layouts.app')
@section('section-principal')
    <div class="section" style=" background:none">
    
        <div class=" py-2 text-4xl " style="background: #ffffff96; width:min:content; text-align:center">
            <h1>Búsqueda: <strong>{{ $query }}</strong></h1>
        </div>



        <div class="contenedor-resultados gap-4 justify-center flex flex-wrap" >
            @foreach ($resultados as $resultado)     
              <div class="w-min bg-white shadow-lg  h-fit">
                  <div class="flex font-sans ">
                      <div class="flex w-48 relative content-center">
                        <img src="{{ url('producto/' . $resultado->foto) }}" alt="" class="absolute inset-0   object-cover w-full  m-auto" loading="lazy" />
                      </div>
                      <form class="flex-auto p-6">
                        <div class="flex flex-wrap">
                          <h1 class="flex-auto text-lg font-semibold text-slate-900">
                            {{ $resultado->nombre}}
                              
                          </h1>
                          <div class="text-lg font-semibold text-slate-500">
                              $ {{number_format($resultado->precio, 0, ',', '.')}} AR
                          </div>
                          <div class="w-full flex-none text-sm font-medium text-slate-700 my-2">
                            Hay {{ $resultado->stock}} unidades disponibles
                          </div>
                        </div>
                        <div class="flex">
                          @if($resultado->tipo_producto == "calzado" && count($resultado->calzados) > 0)
                            <div class="bg-gray-100 my-2 w-min   hover:cursor ">
                              <div class="inline-block relative w-32">
                                <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline hover:cursor-pointer">
                                    @foreach($resultado->calzados as $calzado)
                                      @if($calzado->pivot->stocks > 0)
                                        <option value="{{ $calzado->id }}">Talle N° {{ $calzado->calzado }}</option>
                                      @endif
                                    @endforeach
                                </select>
  
                              </div>
                            </div>
                          @endif
                          <div class="w-16 my-2 mx-3">
  
                            <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500   py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline hover:cursor-pointer ">
                              @for ($i = 1; $i <= 10; $i++)
                                <option value="">{{$i}} unidades</option>
                              @endfor
    
                            </select>
                          </div>
                        </div>

                        <div class="flex space-x-4 mb-6 text-sm font-medium ">
                          <div class="flex-auto flex space-x-4">
                            {{-- Invitado --}}
                            @guest
                              <!-- Botón para abrir el modal -->
                              <button data-bs-toggle="modal" data-bs-target="#miModal" type="button"  class="hover:scale-105 hover:shadow-xl h-10 px-6 font-semibold rounded-md bg-black text-white" type="button">
                                Comprar
                              </button>

                              <button data-bs-toggle="modal" data-bs-target="#miModal" type="button"  class="hover:scale-105 hover:shadow-md hover:cursor-pointer w-max h-10 px-6 font-semibold rounded-md border border-slate-200 text-slate-900" type="button">
                                <a href="#" class="text-black no-underline">
                                  Agregar al carrito
                                </a>
                              </button>
                              <!-- Modal -->
                              <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title text-xl" id="miModalLabel">Atención!</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                      <!-- Contenido del modal -->
                                      
                                      <p class="text-xl  ">Inicia sesión o regístrate para poder comprar o agregar al carrito</p>
                                      <a class="btn btn-primary" href="{{ route('login') }}">Entrar</a>
                                      <a class="btn btn-primary" href="{{ route('register') }}">Registrarse</a>
                                    </div>
    
                                  </div>
                                </div>
                              </div>
                            {{-- Logueado --}}
                            @else
                              <button class="hover:scale-105 hover:shadow-xl h-10 px-6 font-semibold rounded-md bg-black text-white" type="submit">
                                Comprar
                              </button>

                              <button class="hover:scale-105 hover:shadow-md hover:cursor-pointer w-max h-10 px-6 font-semibold rounded-md border border-slate-200 text-slate-900" type="button">
                                <a href="#" class="text-black no-underline">
                                  Agregar al carrito
                                </a>
                              </button>
                            @endguest

                          </div>
                          <button class="hover:scale-105 hover:shadow-md hover:cursor-pointer flex-none flex items-center justify-center w-9 h-9 rounded-md text-slate-300 border border-slate-200" type="button" aria-label="Like">
                            <svg width="20" height="20" fill="currentColor" aria-hidden="true">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                            </svg>
                          </button>
                        </div>
                        <p class="text-sm text-slate-700">
                          Tiene hasta 10 días hábiles para cambiarse
                        </p>
                      </form>
                  </div>
              </div>

            @endforeach 
            @if($contar_resultados < 1)
              <style>

              </style>
              <p style="width:fit-content; background: #ffffff8a; padding:10px">No se ha encontrado nada </p>
            @endif
        </div>
    </div>


    
    




@endsection