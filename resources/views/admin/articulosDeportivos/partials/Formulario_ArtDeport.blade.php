<form class="row g-3 p-3" action="{{ route('articulos-deportivos.store') }}" method="POST" id="FormArtDeport"
    enctype="multipart/form-data">
    @csrf
    <div class="col-md-12 flex ">

        <div class="col-md-6">

            <div class="col-md-12">
                {{-- Titulo principal --}}
                <div class="col-md-12">
                    <h1 class="text-white text-3xl shadow-1 border-1 bg-sky-500/[0.9] w-fit px-2 py-1 rounded-full hover:scale-105 hover:cursor-pointer shadow-inner"
                        onclick="alert('Categoria: Nuevo artículo deportivo')">Nuevo artículo deportivo</h1>
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
                        {{-- Categoria: Articulo deportivo--}}
                        <input type="text" name="categoria" id="" value="1" hidden>
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
                            <option value="calzado">Calzados</option>
                            <option value="accesorio">Accesorios</option>
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
                        data-bs-interval="3000">

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
                    <input type="file" name="fotos[]" id="imageInput" required multiple accept="image/*" onchange="validateImage()">
                    Cargar fotos
                </label>
                <div id="errorMessage" style="color: red; font-size: 14px; margin-top: 5px; display: none;">
                    Falta cargar 1 o más imagenes
                </div>
            </div>

            {{-- Abajo del previsualizador de imagenes --}}
            <div class="col-md-12 flex justify-center ">

                <div class="col-md-9 flex justify-center items-center" style="border-top: 1px solid rgb(16, 153, 163)">

                    {{-- Stock --}}
                    <div class="col-md-5">
                        <label for="stock_input" class="form-label">Stock</label>
                        <input type="text" value="0" name="stock" placeholder="" oninput="validarNumeros(this)"  class="form-control total stock_input" id="stock_input" required >
                        
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

    {{-- Modal - agregar calzados --}}
    <div style="display: none" id="contenedor-modal-calzados">
        @include('admin.articulosDeportivos.partials.Modal_ArtDeport')
    </div>
    {{-- Modal - agregar descripción --}}
    <div class="">
        @include('admin.articulosDeportivos.partials.AgregarDescripcion')
    </div>

    {{-- Fila final --}}
    <div class="col-12 d-flex mt-4" style="justify-content:space-between">
        
        {{-- BTN cargar articulo --}}
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary " id="buttonCargarArticulo" >CARGAR ARTICULO</button>
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
                <input type="text" name="precio"onwheel="preventScroll(event)" class="form-control"
                    id="precioFinal" aria-describedby="inputGroupPrepend2" oninput="validarNumeros(this)"  required>
            </div>
        </div>
    </div>
    @if ($errors->has('precio'))
        <div class="error-message" style="color: red">El precio es un número absurdamente alto.</div>
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

<script>

    function validateImage() {
        const imageInput = document.getElementById('imageInput');
        const errorMessage = document.getElementById('errorMessage');

        // Check if any file is selected
        if (imageInput.files.length === 0) {
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
        }
    }

    document.getElementById('buttonCargarArticulo').addEventListener('click', function () {
        const imageInput = document.getElementById('imageInput');
        const errorMessage = document.getElementById('errorMessage');

        // Verifica si hay imágenes cargadas
        if (imageInput.files.length === 0) {
            errorMessage.style.display = 'block'; // Muestra el mensaje
        } else {
            errorMessage.style.display = 'none'; // Oculta el mensaje
            document.getElementById('formArtDeport').submit(); // Envía el formulario
        }
    });
</script>
