@extends('admin.layouts.plantilla_admin')
@section('section-principal')
    <div class="flex justify-between w-max col-12">

        <div class="w-fit">
            @include('admin.layouts.aside-left')
            <div class="flex justify-center my-3">
                <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
                  <i class="fa-solid fa-circle-arrow-left"></i> Atrás
                </a>
          
            </div>
        </div>
     
        <div class="mx-10 mt-4" style="">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                    <strong>Atención!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('danger'))
                <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                    <strong>Atención!</strong> {{ session('danger') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(Auth::user()->super_administrator == true)
                <div class="">
                    <button class=" hover:scale-105 text-white text-3xl shadow-1 border-1 bg-blue-500/[0.9] w-fit px-2 py-1 rounded-full  hover:cursor-pointer shadow-inner no-underline" data-bs-toggle="modal" data-bs-target="#modalAgregarAdmin">Habilitar nuevo administrador</button>
                </div>

                <div class=" my-4 ">
                    <button class="text-white text-3xl shadow-1 border-1 bg-red-500/[0.9] w-fit px-2 py-1 rounded-full  hover:cursor-pointer shadow-inner no-underline hover:scale-105"  data-bs-toggle="modal" data-bs-target="#modalQuitarAdmin">Eliminar administrador</button>
                </div>
            @endif


            <div class=" ">
                <button class="text-white text-3xl shadow-1 border-1 bg-orange-500/[0.9] w-fit px-2 py-1 rounded-full  hover:cursor-pointer shadow-inner no-underline hover:scale-105"  data-bs-toggle="modal" data-bs-target="#modalAdminesActivos">Admines activos</button>
            </div>

            {{-- MODAL Agregar admin nuevo --}}

            <div class="modal fade "  id="modalAgregarAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog mx-10" >
                    <div class="modal-content " >
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">Agregá el nuevo admin</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body  ">
                            <h3 class="text-xl text-center"> Usuarios</h3>
                            <div class="overflow-auto"style="max-height: 400px">

                                <table class="table  " >
                                    <thead>
                                        <th>Img</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Habilitar</th>
                                    </thead>
                                    <tbody >
                                        @foreach ($usuarios as $usuario)
                                            <tr>
    
                                                <td> <img src="{{ url('usuario/' . $usuario->foto ) }}" alt="" width="40px" height="40px"></td>
                                                <td> {{ $usuario->name }} </td>
                                                <td> {{ $usuario->email }} </td>
                                                <td>
                                                    
                                                    <form action="{{ route('habilitar_admin', $usuario->id) }}" method="POST">
    
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-primary btn-sm">Habilitar</button>
                                                    </form>
                                                    
                                                </td>
                                            </tr>
                                            
                                        @endforeach
    
                                    </tbody>
                                </table>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL QUITAR ADMIN --}}

            <div class="modal fade "  id="modalQuitarAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog mx-10" >
                    <div class="modal-content " >
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">Quitar a un admin</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body  ">
                            <h3 class="text-xl text-center"> Admines activos</h3>
                            <div class="overflow-auto"style="max-height: 400px">

                                <table class="table  " >
                                    <thead>
                                        <th>Img</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Habilitar</th>
                                    </thead>
                                    <tbody >
                                        @foreach ($usuariosAdmines as $usuario)
                                            <tr>
    
                                                <td> <img src="{{ url('usuario/' . $usuario->foto ) }}" alt="" width="40px" height="40px"></td>
                                                <td> {{ $usuario->name }} </td>
                                                <td> {{ $usuario->email }} </td>
                                                <td>
                                                    
                                                    <form action="{{ route('quitar_admin', $usuario->id) }}" method="POST">
    
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-danger btn-sm">Quitar</button>
                                                    </form>
                                                    
                                                </td>
                                            </tr>
                                            
                                        @endforeach
    
                                    </tbody>
                                </table>
  
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Mostrar admines activos --}}

            <div class="modal fade "  id="modalAdminesActivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  >
                <div class="modal-dialog mx-10" style="min-width:600px">
                    <div class="modal-content " >
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">Quitar a un admin</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body  ">
                            <h3 class="text-xl text-center"> Admines activos</h3>
                            <div class="overflow-auto"style="max-height: 400px">

                                <table class="table  " >
                                    <thead>
                                        <th>Img</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Se unió a Sportivo</th>
                                    </thead>
                                    <tbody >
                                        @foreach ($admines as $usuario)
                                            <tr>
    
                                                <td> <img src="{{ url('usuario/' . $usuario->foto ) }}" alt="" width="40px" height="40px"></td>
                                                <td> 
                                                    {{ $usuario->name }}  
                                                </td>
                                                <td >
                                                    <div class="flex">
                                                        {{ $usuario->email }}  {{ $usuario->super_administrator == 1 ? '(Super Admin)' : '' }}
                                                    </div>
                                                </td>
                                                <td>
                                                     {{ $usuario->created_at->format('d/m/Y') }}  
                                                </td>

                                            </tr>
                                            
                                        @endforeach
    
                                    </tbody>
                                </table>
  
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>  
    
        <div class=""style="border-left: 1px solid rgba(0, 0, 0, 0.315)">

            <article class="article0    px-3  bg-slate-500 border-purple-500"   >
                <a href="{{ route('AdminesActivos.index') }}" class="text-white no-underline ">
                    <div class="top">
                        <span>
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </span>
                        <span class="recuento">
                            {{ $adminesActivos }}
                        </span>
                    </div>
                    <div class="bottom">
                        <p>Admins</p>
                    </div>
                </a>
            </article>
        </div>

    </div>




@endsection

