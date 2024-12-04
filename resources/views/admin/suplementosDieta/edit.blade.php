@extends('admin.layouts.plantilla_admin')
@section('section-principal')
    {{-- Mensaje de actualización --}}
    @if (session('mensaje'))
        @include('admin.partials.MsjDelSistema.ArtActualizado') 
    @endif 

    {{-- Aside izquierdo --}}
    <div class="w-fit">
        @include('admin.layouts.aside-left')

        <div class="flex justify-center mt-3">
            <a href="{{ route('suplementos-dieta.tabla') }}" id="boton-regresar-atras"
                class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow"
                style="font-size: 2.5em">
                <i class="fa-solid fa-circle-arrow-left"></i> Atrás
            </a>

        </div>

    </div>

    <div class="estilos-crear-articulos-ropa mt-2">

        <div class="estilos-crear-articulos-ropa2">
            <!-- Formulario actualizar -->
            <form class="row g-3 p-3" action="{{ route('suplementos-dieta.update', $articulo->id) }}" method="POST" id="FormArtDeport" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="col-md-12 flex ">

                    <div class="col-md-6">

                        <div class="col-md-12">

                            <div class="col-md-12">
                                <h1 class="text-white text-3xl shadow-1 border-1 bg-blue-500/[0.9] w-fit px-2 py-1 rounded-full hover:scale-105 hover:cursor-pointer shadow-inner" onclick="alert('Categoria: Nuevo artículo deportivo')">Editar suplemento ID: {{ $articulo->id }}</h1>
                            </div>

                            <div class="col-md-12">
                                
                                <label for="inputEmail4" class="form-label">Titulo producto</label>
                                <input type="text" name="nombre_producto"  class="form-control" placeholder="Inserte un titulo bonito al producto" required value="{{ $articulo->nombre }}">
                            </div>

                            <div class="col-md-12 flex mt-1 justify-between my-1">

                                <div class="col-md-5 ">
                                    <label for="inputEmail4" class="form-label">Genero del producto</label>
                                    
                                    <select name="genero" id="" class="form-select">
                                        @if ($articulo->genero == 'Masculino')
                                            <option value="{{ $articulo->genero }}" selected>Masculino (original)</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Unisex">Unisex</option>
                                        @elseif($articulo->genero == 'Femenino')
                                            <option value="Masculino">Masculino</option>
                                            <option value="{{ $articulo->genero }}" selected>Femenino (Original)</option>
                                            <option value="Unisex">Unisex</option>
                                        @else
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="{{ $articulo->genero }}" selected>Unisex (Original)</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Público dirigido</label>
                                    
                                    <select name="publico_dirigido" id="publico-dirigido" class="form-select" required>

                                        @if ($articulo->dirigido_a == 'adultos')
                                            <option value="{{ $articulo->dirigido_a }}" selected>Adultos (Original)</option>
                                            <option value="niños">Niños</option>
                                            <option value="ambos">Ambos</option>
                                        @elseif($articulo->dirigido_a == 'niños')
                                            <option value="adultos">Adultos</option>
                                            <option value="{{ $articulo->dirigido_a }}" selected>Niños (Original)</option>
                                            <option value="ambos">Ambos</option>
                                        @else
                                            <option value="adultos">Adultos</option>
                                            <option value="niños">Niños</option>
                                            <option value="{{ $articulo->dirigido_a }}" selected>Ambos (Original)</option>
                                        @endif
                                    </select>


                                    {{-- Categoria --}}
                                    <input type="text" name="categoria" id="" value="3" hidden>
                                </div>
                            </div>
                        </div>
                        


                        <div class="col-md-12 flex justify-between my-1">


                            <div class="col-md-5">
                                <label for="inputState" class="form-label " >Tipo de producto</label>
                                <div class="input-group d-flex" >
                                    <select name="tipoProducto" id="" class="form-select SelectTypeProduct">

                                        <option value="{{ $articulo->tipo_producto }}" selected>{{ $articulo->tipo_producto }} (Original)
                                        </option>


                                    </select>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="inputAddress" class="form-label">Marca</label>
                                <input type="text" name="marca" class="form-control" id="inputAddress" required placeholder="Adidas, nike, otro" value="{{ $articulo->marca }}">
                            </div>
                        </div>
                        <!-- Sección de las etiquetas -->
                        <div class="col-md-12 flex justify-between mt-3" style="align-content: center; ">
                            <div class="col-md-5 grid">
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#editar-etiquetas-modal" type="button" >Etiquetas</button>
                            </div>
                            <div class="col-md-6 grid">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editar-descripcion-modal" type="button" >Descripción</button>
                            </div>

                        </div>
                        <div class="col-md-12 flex justify-between mt-2" style="align-content: center">
                            <div id="etiquetas-container" class="etiquetas-container">
                                <!-- Aquí se agregarán las etiquetas dinámicamente -->
                                @foreach ($deportes as $deporte)
                                    @php
                                        $deporteAsociado = $articulo->deportes->firstWhere('pivot.deporte_id',
                                            $deporte->id,
                                        );

                                    @endphp
                                    
                                    @if (isset($deporteAsociado))
     
                                        {{-- <div class='etiqueta' data-deporte-id='{{$deporteAsociado->deporte_id}}'>{{$deporteAsociado->deporte}}<span class='eliminar-etiqueta'>x</span></div> --}}
                                        <input type="text" id="etiquetas-hidden" name="etiquetas[]" hidden value="{{ $deporteAsociado->deporte_id }}">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        
                            

                        
                    </div>
                    <div class="col-md-6">
                        <div id="carousel-{{ $articulo->id }}" class="carousel slide" data-bs-slide="300000s" data-bs-ride="carousel"  style="background: rgba(0, 0, 0, 0.404); display:block; align-items:center;width: 200px;margin:auto;margin-bottom:10px">
                            <div class="carousel-inner">
                                @foreach($articulo->fotos as $index => $foto)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ url('productos/' . $foto->ruta) }}" alt="{{ $articulo->nombre }}" style="width: 200px; height: 200px;">

                                    </div>
                                @endforeach
                            </div>
                
                            <!-- Controles del carrusel -->
                            <button class="carousel-control-prev"  type="button" data-bs-target="#carousel-{{ $articulo->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true" ></span>
                                <span class="visually-hidden" >Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $articulo->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>     


                        
                        <div class="col-md-12 flex justify-center " >
                            <div class="col-md-9 flex justify-center items-center" style="border-top: 1px solid rgb(16, 153, 163)">


                                <div class="col-md-5">
                                    <label for="stock-calzados" class="form-label">Stock</label>
                                    <input type="text"   name="stock" placeholder="cantidad" class="form-control"  required value={{$articulo->stock}} >
                        

                                    

                                </div>

                                <div class="ml-5 p-1 p-1">
                                    <label for="color" class="form-label">Color</label>
                                    <input type="text" name="color" id="color" class="form-control" placeholder="Rojo, fuxia, amarillo..." required value={{ $articulo->color }}>

                                </div>

                                
                            </div>
                        </div>
                    </div>


                </div>

                {{-- Modals --}}
                <div style="display: block" id="contenedor-modal-calzados">
                    @include('admin.ropasDeportivas.partials.ModalEditDescripcion')
                    @include('admin.articulosDeportivos.partials.ModalEditEtiquetas')
                </div>

                {{-- 
                    Botón: 
                    Actualizar /  Cambiar precio 
                --}}
                <div class="col-12 d-flex mt-5" style="justify-content:space-between">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">ACTUALIZAR PRODUCTO</button>
                    </div>

                    <div class="col-md-3 d-flex">
                        <label for="inputState" class="form-label mx-2 mt-2" >PRECIO</label>
                        <div class="input-group">
                            <span class="input-group-text " style="border:1px solid rgb(16, 153, 163,0.377);" id="signo-peso" >$</span>
                            <input type="text" name="precio" onwheel="preventScroll(event)"  class="form-control" id="precioFinal"  aria-describedby="inputGroupPrepend2" onsubmit="removeDots()" required value={{$articulo->precio}}>
                        </div>
                    </div>
                </div>

                <style>
                    input:disabled {
                        /* Estilos para el modo de solo lectura */
                        background-color: #f2f2f2;
                        /* Cambia el color de fondo a un tono gris */
                        border: 1px solid #ccc;
                        /* Añade un borde gris */
                        cursor: not-allowed;
                        /* Cambia el cursor a 'no permitido' */
                        /* Agrega otros estilos según sea necesario */
                    }
                    .etiqueta {
                        display: inline-block;
                        padding: 5px 10px;
                        background-color: grey;
                        color: #fff;
                        margin-right: 5px;
                        margin-bottom: 5px;
                        border-radius: 5px;
                    }

                    .eliminar-etiqueta {
                        cursor: pointer;
                        margin-left: 5px;
                    }
                    label{
                        font-weight: 600;
                    
                    }
                    #signo-peso{
                        z-index: 1;
                        border :1px rgb(3, 3, 3);
                    box-shadow: -1px 0px 5px rgba(16, 153, 163); 
                    }
                    .form-control, .form-select{
                    border :1px rgb(3, 3, 3);
                    box-shadow: 0px 0px 5px rgba(16, 153, 163); /*Si no gusta borrarlo*/
                    }
                    /* Estilos para el modo de solo lectura */
                    .estilo-readonly {
                        background-color: #f2f2f2; /* Cambia el color de fondo a un tono gris */
                        border: 1px solid #ccc; /* Añade un borde gris */
                        cursor: not-allowed; /* Cambia el cursor a 'no permitido' */
                        /* Agrega otros estilos según sea necesario */
                    }
                </style>
            </form> 

        </div>

    </div>




    <!-- Sumplementos y dieta -->
    <a href="{{ route('suplementos-dieta.index') }}" class="text-white no-underline article0 article3 px-1">
        <div class="top">
            <span>
            <i class="fa-solid fa-heart"></i>
            </span>
            <span class="recuento">
            {{ $suplementos }}
            </span>
        </div>
        <div class="bottom">
            <p>Sumplementos y dieta</p>
        </div>
        </a>



   
@endsection
