@extends('admin.layouts.plantilla_admin')
@section('section-principal')
    <div class="flex justify-between w-max col-12">

        <div class="w-fit">
            @include('admin.layouts.aside-left')
        </div>
     
        <div class="mx-10 mt-4" style="">

            <div class="">
                <button class=" hover:scale-105 text-white text-3xl shadow-1 border-1 bg-blue-500/[0.9] w-fit px-2 py-1 rounded-full  hover:cursor-pointer shadow-inner no-underline" data-bs-toggle="modal" data-bs-target="#modalAdmins">Habilitar nuevo administrador</button>
            </div>

            <div class=" my-4 ">
                <button class="text-white text-3xl shadow-1 border-1 bg-red-500/[0.9] w-fit px-2 py-1 rounded-full  hover:cursor-pointer shadow-inner no-underline hover:scale-105"  data-bs-toggle="modal" data-bs-target="#modalAdmins">Eliminar administrador</button>
            </div>

            <div class=" ">
                <button class="text-white text-3xl shadow-1 border-1 bg-orange-500/[0.9] w-fit px-2 py-1 rounded-full  hover:cursor-pointer shadow-inner no-underline hover:scale-105"  data-bs-toggle="modal" data-bs-target="#modalAdmins">Admines activos</button>
            </div>

            {{-- MODAL --}}

            <div class="modal fade "  id="modalAdmins" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>  
    
                

    </div>




@endsection

