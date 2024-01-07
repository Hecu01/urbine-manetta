@extends('admin.layouts.plantilla_admin')
@section('section-principal')

  <div class="w-fit">
    @include('admin.layouts.aside-left')
  </div>
 
    {{-- <form 
    method="POST" 
    action="{{ route('registro.actualizar', $registro->id) }}" 
    id="form-update"  
    class="container-fluid d-flex" 
    style="display: flex; justify-content: space-around; align-items:flex-start"
    >
      
      @method("PUT")
      @csrf
    </form> --}}

    <div class="estilos-crear-articulos-ropa">

        <div class="estilos-crear-articulos-ropa2">
                
            <form class="row g-3 p-3" action="{{ route('articulos.actualizar', ['id' => $articulo->id]) }}" method="POST" id="FormArtDeport" enctype="multipart/form-data">

                @csrf
                @method("PUT")
                <div class="col-md-12 flex ">
            
                <div class="col-md-6">
            
                    <div class="col-md-12">
            
                        <div class="col-md-12">
                            <h1 class="text-white text-3xl shadow-1 border-1 bg-sky-500/[0.9] w-fit px-2 py-1 rounded-full hover:scale-105 hover:cursor-pointer shadow-inner" onclick="alert('Categoria: Nuevo artículo deportivo')">Edición del articulo n°{{ $articulo->id }}</h1>
                        </div>
            
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Titulo producto</label>
                            <input type="text" name="nombre_producto" class="form-control" id="inputEmail4" value="{{ $articulo->nombre }}">
                        </div>
            
                        <div class="col-md-12 flex mt-1 justify-between">
            
                            <div class="col-md-5 ">
                            <label for="inputEmail4" class="form-label">Genero del producto</label>
                            
                            <select name="genero" id="" class="form-select">
                                
                                @if($articulo->genero = "M")
                                    <option value="{{ $articulo->genero}}">{{ $articulo->genero}} (original)</option>
                                    <option value="F">Femenino</option>
                                    <option value="U">Unisex</option>
                                @elseif($articulo->genero = "F")      
                                    <option value="M">Masculino</option>
                                    <option value="{{ $articulo->genero}}">{{ $articulo->genero}}</option>
                                    <option value="U">Unisex</option>                         
                                @else 
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                    <option value="{{ $articulo->genero}}">{{ $articulo->genero}} (Original)</option>
                                @endif

                                

                            </select>


                            </div>
                            <div class="col-md-6">
                                <label for="stock_input" class="form-label">Stock  </label>
                                <input type="text" name="stock"  value="{{ $articulo->stock }}"  class="form-control total" id="stock_input" required>
                                
                                {{-- Categoria --}}
                                <input type="text" name="categoria" id="" value="1" hidden>
                            </div>
                        </div>
                    </div>
                    
            
            
                    <div class="col-md-12 flex justify-between">
            
            
                        <div class="col-md-5">
                            <label for="inputCity" class="form-label">Color</label>
                            <input type="text" name="color" class="form-control" id="inputCity" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputAddress" class="form-label">Marca</label>
                            <input type="text" name="marca" class="form-control" id="inputAddress" required placeholder="Adidas, nike, otro">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
            
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" placeholder="Podés brindar más  detalles sobre el producto, por ejemplo, ideal para empezar, pero, no para hacer uso profesional (por ejemplo)." id="" style="min-height: 110px; max-height:110px;" name="descripcion"></textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mr-3 " >

                            <div class="inline-block relative ">
                                {{-- @php 
                                    $variable = [];
                                @endphp
                                @foreach($articulo->calzados as $calzado)
                                  @if($calzado->pivot->stocks > 0)
                                    <p >Talle N° {{ $calzado->calzado }} - Disponibles {{$calzado->pivot->stocks}} - id {{$calzado->pivot->calzado_id}}</p>
                                    @php
                                        $variable[] = $calzado->pivot->calzado_id;
                                    @endphp
                                  @endif
                                @endforeach
                                        --}}
                            </div>
                            <div>
                                
                                @foreach($calzados as $calzado)
                                    @php
                                        $calzadoAsociado = $articulo->calzados->firstWhere('pivot.calzado_id', $calzado->id);
                                    @endphp

                                    <div class="mx-3 my-1">
                                        @if($calzado->calzado > 38)
                                            @if($calzadoAsociado)
                                                {{-- Calzado existente --}}
                                                <input type="hidden" name="calzado_ids[]" value="{{ $calzadoAsociado->id }}">
                                                <input type="checkbox" checked name="calzados[]" id="calzado-{{ $calzadoAsociado->id }}" value="{{ $calzadoAsociado->calzado }}" class="form-check-input">
                                                <label for="calzado-{{ $calzadoAsociado->id }}" class="mx-1">Calzado {{ $calzadoAsociado->calzado }}</label>
                                                <input type="text" name="stocks[]" id="stock-{{ $calzadoAsociado->id }}" class="border-1 text-center border-cyan-600/[0.5] text-small input-suma p-0" style="width:40px;height:22px;" value="{{ $calzadoAsociado->pivot->stocks }}">
                                            @else
                                                {{-- Nuevo calzado --}}
                                                <input type="hidden" name="calzado_ids[]" value="{{ $calzado->id }}">
                                                <input type="checkbox" name="calzados[]" id="calzado-{{ $calzado->id }}" value="{{ $calzado->calzado }}" class="form-check-input">
                                                <label for="calzado-{{ $calzado->id }}" class="mx-1">Calzado {{ $calzado->calzado }}</label>
                                                <input type="text" name="stocks[]" id="stock-{{ $calzado->id }}" class="border-1 text-center border-cyan-600/[0.5] text-small input-suma p-0" style="width:40px;height:22px;">
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
    
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12" style=" position: relative; margin: 10px 0px">
            
                        <div class="container d-flex justify-content-center bg-gray-500 " style="height: 250px;width:250px;  display:flex; justify-content: center;align-items:center;  background:#fff">
                            <!-- Carrusel para previsualizar imágenes -->
                            <div  class="">
                                <img src="{{ url('producto/' . $articulo->foto) }}" alt=" " style="height: 250px;width:250px;" class="absolute inset-0   object-cover w-full  m-auto" loading="lazy" />
                            </div>    
                   
                        </div>
            
                    </div>

                    
                    <div class="col-md-12 flex justify-center " >
                        <div class="col-md-9 flex justify-center items-center" style="border-top: 1px solid rgb(16, 153, 163)">
            
            
                            <div class="">
                                <label for="inputState" class="form-label mx-2 " >Tipo de producto</label>
                                <div class="input-group d-flex" >
                                    <select name="tipoProducto" id="SelectTypeProduct" class="form-select" >

                                        @if($articulo->tipo_producto = "calzado")
                                            <option value="{{ $articulo->tipo_producto}}">{{ $articulo->tipo_producto}} (original)</option>
                                            <option value="accesorio">Accesorio</option>
                                        @else 
                                            <option value="calzado">calzado</option>
                                            <option value="{{ $articulo->tipo_producto}}">{{ $articulo->tipo_producto}} (original)</option>
                                        @endif

                                    </select>
                                    @if($articulo->tipo_producto = "calzado")
                                        <span  id="agregar-calzados"  class="input-group-text hover:cursor-pointer hover:scale-105 " style="border:1px solid rgb(16, 153, 163, 0.377);" data-bs-toggle="modal" data-bs-target="#exampleModal">+</span>
                                    @else
                                        <span  id="agregar-calzados"  class="input-group-text hover:cursor-pointer hover:scale-105 " style="border:1px solid rgb(16, 153, 163, 0.377); display: none;" data-bs-toggle="modal" data-bs-target="#exampleModal">+</span>
                                    @endif          
                                </div>
                            </div>
            
                            <div class="ml-5 p-1 p-1">
                                <div class="">
                                    <label for="inputEmail4" class="form-label">Público dirigido</label>
                                    
                                    <select name="publico_dirigido" id="" class="form-select">
                                        <option value="" selected hidden></option>
                                        <option value="adultos">Adultos</option>
                                        <option value="niños">Niños</option>
                                        <option value="ambos">Ambos</option>


                                    </select>
                                </div>
                            </div>
            
                            
                        </div>
                    </div>
                </div>
            
            
                </div>
            
                <!-- calzados disponibles (acá está el problema de array string conversion) (linea 120) -->
                <div style="display: none" id="contenedor-modal-calzados">
                    {{-- @include('admin.partials.NuevoArtDeport_modal') --}}
                </div>
            
                <div class="col-12 d-flex " style="justify-content:space-between">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                    <div class="col-md-3 d-flex">
                        <label for="inputState" class="form-label mx-2 mt-2" >PRECIO</label>
                        <div class="input-group">
                            <span class="input-group-text " style="border:1px solid rgb(16, 153, 163,0.377);" id="signo-peso" >$</span>
                            <input type="text" name="precio"onwheel="preventScroll(event)"  class="form-control" id="validationDefaultUsername"  aria-describedby="inputGroupPrepend2" onsubmit="removeDots()" required>
                        </div>
                    </div>
                </div>
            
            
            
              <style>
                    
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
            
            <script>
                // Mostrar u ocultar el campo de opciones de calzado según el tipo seleccionado
                document.querySelector('select[name="tipoProducto"]').addEventListener('change', function() {
                    var opcionesCalzado = document.getElementById('contenedor-modal-calzados');
                    if (this.value === 'calzado') {
                        opcionesCalzado.style.display = 'block';
                    } else {
                        opcionesCalzado.style.display = 'none';
                    }
                });
            
                document.addEventListener('DOMContentLoaded', function () {
                    // Manejar cambios en el campo de entrada de imágenes
                    document.getElementById('imageInput').addEventListener('change', handleImagePreview);
                });
            
                function handleImagePreview(event) {
                    // Limpiar el carrusel de previsualización
                    document.getElementById('imagePreviewInner').innerHTML = '';
            
                    // Obtener archivos seleccionados
                    const files = event.target.files;
            
                    // Mostrar previsualización de imágenes
                    for (const file of files) {
                        const reader = new FileReader();
            
                        reader.onload = function (e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('d-block');
                            img.style.height= '250px';
            
                            const item = document.createElement('div');
                            item.classList.add('carousel-item');
            
                            // Marcar el primer elemento como activo
                            if (document.getElementById('imagePreviewInner').childElementCount === 0) {
                                item.classList.add('active');
                            }
            
                            item.appendChild(img);
                            document.getElementById('imagePreviewInner').appendChild(item);
                        };
            
                        reader.readAsDataURL(file);
                    }
                }
            </script>
            
     
  
              
        </div>
  
    </div>


            
  <!-- Artículos deportivos -->
  <article class="article0 article4   px-2"  id="redirigirBoton">
    <a href="{{ route('nuevo_articulo') }}" class="text-white no-underline">
      <div class="top">
        <span>
          <i class="fa-solid fa-football"></i>
        </span>
        <span class="recuento">
          {{-- {{ $artDeportivos }} --}}
        </span>
      </div>
      <div class="bottom">
        <p>Artículos deportivos <br> disponibles</p>
      </div>
    </a>
  </article>




  <script>
    function formatNumber(input) {
      // Eliminar caracteres no numéricos
      var num = input.value.replace(/[^0-9]/g, '');
      // Formatear con separadores de miles
      input.value = num.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    function preventScroll(event) {
      event.preventDefault();
    }

    // Remover puntos
    function removeDots() {
      var input = document.getElementById('precio');
      input.value = input.value.replace(/\./g, '');
    }
      // Remover puntos
      function removeDots2() {
      var input = document.getElementById('stock');
      input.value = input.value.replace(/\./g, '');
    }
  </script>
@endsection

