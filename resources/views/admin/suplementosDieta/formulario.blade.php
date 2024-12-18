@extends('admin.layouts.plantilla_admin')

@section('section-principal')
  <main class="principal-main-ropa-deportiva">

    <div class="w-fit">
      @include('admin.layouts.aside-left')
      <div class="flex justify-center mt-3">
        <a href="{{ route('suplementos-dieta.index') }}" id="boton-regresar-atras" class="bg-blue-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
          <i class="fa-solid fa-circle-arrow-left"></i> Atrás
        </a>
  
      </div>
   
    </div>

    <section class="center-actions">
        <div class=""style="max-width:800px; border:1px solid rgb(0,0,0,0.2)">

            <form class="row g-3 p-3" action="{{ route('suplementos-dieta.store') }}" method="POST" id="FormArtDeport" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12 flex ">
            
                    <div class="col-md-6">
                        
                        <div class="col-md-12">
                            {{-- Titulo principal --}}
                            <div class="col-md-12">
                                <h1 class="text-white text-3xl shadow-1 border-1 bg-blue-500 w-fit px-2 py-1 rounded-full hover:scale-105 hover:cursor-pointer shadow-inner" onclick="alert('Categoria: Nuevo suplemento deportivo')">
                                    <div class="flex items-center">
    
                                      Nuevo Suplem. y dieta 
                                      <span>
                                        <i class="fa-solid fa-heart" style="font-size:1.1em; margin:5px 10px"></i>
                                    </div>
                                  </h1>
    
                            </div>
                            
                            {{-- Titulo producto --}}
                            <div class="col-md-12">
                                <label for="inputEmail4" class="form-label">Titulo producto</label>
                                <input type="text" name="nombre_producto" class="form-control" placeholder="Inserte un titulo bonito al producto" required>
                            </div>
                            
                            <div class="col-md-12 flex mt-1 justify-between my-1">
                                
                                {{-- Género del producto --}}
                                <div class="col-md-5 ">
                                    <label for="inputEmail4" class="form-label">Genero del producto</label>
                                    <select name="genero" id="" class="form-select" required>
                                        <option value="" selected hidden>Elija una opción</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Unisex">Unisex</option>
                                    </select>
                                </div>
            
                                {{-- Público dirigido --}}
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Público dirigido</label>
                                    <select name="publico_dirigido" id="publico-dirigido" class="form-select" required>
                                        <option value="" selected hidden></option>
                                        <option value="adultos">Adultos</option>
                                        <option value="niños">Niños</option>
                                        <option value="ambos">Ambos</option>
                                    </select>

                                    {{-- Categoria: Suplementos y dieta--}}
                                    <input type="text" name="categoria" id="" value="3" hidden>
                                </div>
                            </div>
                        </div>
            
            
            
                        <div class="col-md-12 flex justify-between my-1">
                            
                            {{-- Tipo de producto --}}
                            <div class="col-md-5">
                                <label for="inputState" class="form-label ">Tipo de producto</label>
                                <div class="input-group d-flex">
                                    <select name="tipoProducto" class="form-select SelectTypeProduct" required>
                                        <option value="" selected hidden></option>
                                        <option value="Suplemento">Suplemento</option>
                                        <option value="Comida">Comida</option>
                                    </select>
                                    <span id="agregar-calzados" class="input-group-text hover:cursor-pointer hover:scale-105 "
                                        style="border:1px solid rgb(16, 153, 163, 0.377); display: none;" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">+</span>
                                </div>
                            </div>
            
                            {{-- Marca --}}
                            <div class="col-md-6">
                                <label for="inputAddress" class="form-label">Marca</label>
                                <input type="text" name="marca" class="form-control" id="inputAddress" required
                                    placeholder="Adidas, nike, otro">
                            </div>
                        </div>
            
                        <!-- Sección de las etiquetas -->
                        <div class="col-md-12 flex justify-between my-1" style="align-content: center;">
                            
                            {{-- Input select --}}
                            <div class="col-md-10">
                                <label for="deporte" class="form-label">Etiquetas de deportes</label>
                                <select name="select_deportes" id="deporte" class="form-select">
                                    @foreach ($deportes as $deporte)
                                        <option value="{{ $deporte->id }}">{{ $deporte->deporte }}</option>
                                    @endforeach
                                </select>
                            </div>
            
                            {{-- Contenedor btn agregar etiqueta --}}
                            <div style="width:50px; margin-top:29px">
                                <button class="btn btn-primary" style="width: 100%" type="button" onclick="agregarDeporte()" id="agregar-tag-artdeport">+</button>
                            </div>
                        </div>
            
            
                        {{-- Contenedor visual de etiquetas --}}
                        <div class="col-md-12 flex justify-between mt-2" style="align-content: center">
                            <div id="etiquetas-container" class="etiquetas-container">
                                <!-- Aquí se agregarán las etiquetas dinámicamente -->
                            </div>
                            <input type="hidden" id="etiquetas-hidden" name="etiquetas[]" value="">
                            <input type="hidden" id="nombres-etiquetas-hidden" name="nombres_etiquetas[]" value="">
                        </div>
            
            
            
            
                    </div>
                    <div class="col-md-6">
            
                        <div class="col-md-12" style=" position: relative; margin: 10px 0px">
            
                            <div class="container d-flex justify-content-center shadow-sm border-2 "
                                style="height: 250px;width:250px;  display:flex; justify-content: center;align-items:center;  background:#fff">
            
                                <!-- Carrusel para previsualizar imágenes -->
                                <div id="imagePreviewCarousel" class="carousel slide" data-bs-ride="carousel"
                                    data-bs-interval="30000">
            
                                    <div class="carousel-inner " id="imagePreviewInner" style="height: 100%">
                                        <!-- Las imágenes previsualizadas se mostrarán aquí -->
                                    </div>
            
                                    <button class="carousel-control-prev" type="button" data-bs-target="#imagePreviewCarousel"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
            
                                    <button class="carousel-control-next" type="button" data-bs-target="#imagePreviewCarousel"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
            
                                </div>
            
                            </div>
            
                        </div>
            
                        {{-- Contenedor input y cargar fotos --}}
                        <div class="col-md-12 grid justify-center my-3 ">
                            <label class=" btn text-white hover:scale-105 " for="imageInput"
                                style="background-color: rgb(16, 153, 163);text-align:center; width:100% ">
                                <input type="file" name="fotos[]" id="imageInput" required multiple accept="image/*">
                                Cargar fotos
                            </label>
                        </div>
            
                        {{-- Abajo del previsualizador de imagenes --}}
                        <div class="col-md-12 flex justify-center ">
            
                            <div class="col-md-9 flex justify-center items-center" style="border-top: 1px solid rgb(16, 153, 163)">
            
                                {{-- Stock --}}
                                <div class="col-md-5">
                                    <label for="stock_input" class="form-label">Stock</label>
                                    <input type="text" name="stock" placeholder="cantidad" class="form-control total stock_input" id="stock_input" oninput="validarNumeros(this)"  required>

                                </div>
            
                                {{-- Marca --}}
                                <div class="ml-5 p-1 p-1">
                                    <label for="inputCity" class="form-label">Color</label>
                                    <input type="text" name="color" class="form-control" placeholder="Rojo, fuxia, amarillo..." required>
            
                                </div>
            
            
                            </div>
                        </div>
                    </div>
            
            
                </div>

                {{-- Modal - agregar descripción --}}
                <div class="">
                    @include('admin.suplementosDieta.partials.AgregarDescripcion')
                </div>
            
                {{-- Fila final --}}
                <div class="col-12 d-flex mt-4" style="justify-content:space-between">
                    
                    {{-- BTN cargar articulo --}}
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary ">CARGAR PRODUCTO</button>
                    </div>
            
                    {{-- BTN agregar descripcion --}}
                    <div class="col-md-2">
                        <button class="btn btn-secondary " type="button" id="descripcion-articulo" data-bs-toggle="modal" data-bs-target="#agregar-descripcion-modal">DESCRIPCION</button>
                    </div>
            
                    {{-- Input agregar precio --}}
                    <div class="col-md-3 d-flex">
                        <label for="inputState" class="form-label mx-2 mt-2">PRECIO</label>
                        <div class="input-group">
                            <span class="input-group-text " style="border:1px solid rgb(16, 153, 163,0.377);"
                                id="signo-peso">$</span>
                            <input type="text" name="precio" class="form-control"
                                id="precioFinal" aria-describedby="inputGroupPrepend2"  oninput="validarNumeros(this)"  required>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($errors->has('precio'))
                    <div class="error-message" style="color: red">El precio es un número absurdamente alto.</div>

                @endif
                @if ($errors->has('stock'))
                    <div class="error-message" style="color: red">El stock es absurdamente alto.</div>

                @endif
            
                <style>
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
            
                    label {
                        font-weight: 600;
            
                    }
            
                    #signo-peso {
                        z-index: 1;
                        border: 1px rgb(3, 3, 3);
                        box-shadow: -1px 0px 5px rgba(16, 153, 163);
                    }
            
                    .form-control,
                    .form-select {
                        border: 1px rgb(3, 3, 3);
                        box-shadow: 0px 0px 5px rgba(16, 153, 163);
                        /*Si no gusta borrarlo*/
                    }
            
                    /* Estilos para el modo de solo lectura */
                    .estilo-readonly {
                        background-color: #f2f2f2;
                        /* Cambia el color de fondo a un tono gris */
                        border: 1px solid #ccc;
                        /* Añade un borde gris */
                        cursor: not-allowed;
                        /* Cambia el cursor a 'no permitido' */
                        /* Agrega otros estilos según sea necesario */
                    }
                </style>
            </form>
            
        </div>
    </section>
  
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
    
  </main>
  



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

