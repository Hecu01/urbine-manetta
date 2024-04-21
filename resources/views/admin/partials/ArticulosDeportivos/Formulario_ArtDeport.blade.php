<form class="row g-3 p-3" action="{{ route('añadir_articulo')}}" method="POST" id="FormArtDeport" enctype="multipart/form-data">
    @csrf
    <div class="col-md-12 flex ">

        <div class="col-md-6">

            <div class="col-md-12">

                <div class="col-md-12">
                    <h1 class="text-white text-3xl shadow-1 border-1 bg-sky-500/[0.9] w-fit px-2 py-1 rounded-full hover:scale-105 hover:cursor-pointer shadow-inner" onclick="alert('Categoria: Nuevo artículo deportivo')">Nuevo artículo deportivo</h1>
                </div>

                <div class="col-md-12">
                    
                    <label for="inputEmail4" class="form-label">Titulo producto</label>
                    <input type="text" name="nombre_producto"  class="form-control" placeholder="Inserte un titulo bonito al producto" required>
                </div>

                <div class="col-md-12 flex mt-1 justify-between my-1">

                    <div class="col-md-5 ">
                    <label for="inputEmail4" class="form-label">Genero del producto</label>
                    
                    <select name="genero" id="" class="form-select" required>
                        <option value="" selected hidden>Elija una opción</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                        <option value="U">Unisex</option>
                    </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Público dirigido</label>
                        
                        <select name="publico_dirigido" id="publico-dirigido" class="form-select" required>
                            <option value="" selected hidden></option>
                            <option value="adultos">Adultos</option>
                            <option value="niños">Niños</option>
                            <option value="ambos">Ambos</option>
                        </select>


                        {{-- Categoria --}}
                        <input type="text" name="categoria" id="" value="1" hidden>
                    </div>
                </div>
            </div>
            


            <div class="col-md-12 flex justify-between my-1">


                <div class="col-md-5">
                    <label for="inputState" class="form-label " >Tipo de producto</label>
                    <div class="input-group d-flex" >
                        <select name="tipoProducto" id="SelectTypeProduct" class="form-select" required >
                            <option value="" selected hidden></option>
                            <option value="calzado">Calzado</option>
                            <option value="accesorio">Accesorio</option>
                        </select>          
                        <span  id="agregar-calzados"  class="input-group-text hover:cursor-pointer hover:scale-105 " style="border:1px solid rgb(16, 153, 163, 0.377); display: none;" data-bs-toggle="modal" data-bs-target="#exampleModal">+</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="inputAddress" class="form-label">Marca</label>
                    <input type="text" name="marca" class="form-control" id="inputAddress" required placeholder="Adidas, nike, otro">
                </div>
            </div>
            <!-- Sección de las etiquetas -->
            <div class="col-md-12 flex justify-between my-1" style="align-content: center; ">
                <div class="col-md-10">
                    <label for="deporte" class="form-label">Etiquetas de deportes</label>
                    <select name="select_deportes" id="deporte" class="form-select">
                        <option value="" selected hidden> Agrega etiqueta/s</option>
                        @foreach ($deportes as $deporte)
                            <option value="{{ $deporte->id }}">{{ $deporte->deporte }}</option>
                        @endforeach
                    </select>
                </div>
                <div  style="width:50px; margin-top:29px">
                    <button class="btn btn-primary" style="width: 100%" type="button" onclick="agregarDeporte()" id="agregar-tag-artdeport">+</button>
                </div>
            </div>
            <div class="col-md-12 flex justify-between mt-2" style="align-content: center">
                <div id="etiquetas-container" class="etiquetas-container">
                    <!-- Aquí se agregarán las etiquetas dinámicamente -->
                </div>
                <input type="text" id="etiquetas-hidden" name="etiquetas[]" hidden>
            </div>
            
                 

            
        </div>
        <div class="col-md-6">
            <div class="col-md-12" style=" position: relative; margin: 10px 0px">

                <div class="container d-flex justify-content-center shadow-sm border-2 " style="height: 250px;width:250px;  display:flex; justify-content: center;align-items:center;  background:#fff">
                    <!-- Carrusel para previsualizar imágenes -->
                    <div id="imagePreviewCarousel" class="carousel slide" data-bs-ride="carousel"  data-bs-interval="3000">
                        <div class="carousel-inner " id="imagePreviewInner"  style="height: 100%">
                            <!-- Las imágenes previsualizadas se mostrarán aquí -->
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#imagePreviewCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#imagePreviewCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

            </div>
            <div class="col-md-12 grid justify-center my-3 ">
                <label class=" btn text-white hover:scale-105 " for="imageInput" style="background-color: rgb(16, 153, 163);text-align:center; width:100% ">
                    <input type="file" name="foto" id="imageInput" multiple accept="image/*">
                    Cargar fotos
                </label>
            </div>

            
            <div class="col-md-12 flex justify-center " >
                <div class="col-md-9 flex justify-center items-center" style="border-top: 1px solid rgb(16, 153, 163)">


                    <div class="col-md-5">
                        <label for="stock_input" class="form-label">Stock</label>
                        <input type="text" name="stock" placeholder="cantidad"  class="form-control total" id="stock_input" required>
                        

                    </div>

                    <div class="ml-5 p-1 p-1">
                        <label for="inputCity" class="form-label">Color</label>
                        <input type="text" name="color" class="form-control" placeholder="Rojo, fuxia, amarillo..." required>

                    </div>

                    
                </div>
            </div>
        </div>


    </div>

    <!-- calzados disponibles (acá está el problema de array string conversion) (linea 120) -->
    <div style="display: none" id="contenedor-modal-calzados">
        @include('admin.partials.ArticulosDeportivos.Modal_ArtDeport')
    </div>

    <div class="col-12 d-flex " style="justify-content:space-between">
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
        <div class="col-md-3 d-flex">
            <label for="inputState" class="form-label mx-2 mt-2" >PRECIO</label>
            <div class="input-group">
                <span class="input-group-text " style="border:1px solid rgb(16, 153, 163,0.377);" id="signo-peso" >$</span>
                <input type="text" name="precio"onwheel="preventScroll(event)"  class="form-control" id="precioFinal"  aria-describedby="inputGroupPrepend2" onsubmit="removeDots()" required>
            </div>
        </div>
    </div>



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
<script>
    function agregarDeporte() {
        var select = document.getElementById("deporte");
        var textarea = document.getElementById("contenedor-etiquetas");

        // Obtener el valor seleccionado del select
        var deporte = select.options[select.selectedIndex].text;

        // Agregar el valor al textarea como etiqueta
        if (textarea.value === "") {
            textarea.value = deporte;
        } else {
            textarea.value += ", " + deporte;
        }
    }

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

    function agregarDeporte() {
        var select = document.getElementById("deporte");
        var etiquetasContainer = document.getElementById("etiquetas-container");
        var inputHidden = document.getElementById("etiquetas-hidden");

        var deporteId = select.value; // Capturamos el ID del deporte seleccionado
        var deporteNombre = select.options[select.selectedIndex].text; // Capturamos el nombre del deporte seleccionado

        // Crear la etiqueta visual
        var etiqueta = document.createElement("div");
        etiqueta.classList.add("etiqueta");
        etiqueta.textContent = deporteNombre; // Mostramos el nombre del deporte en la etiqueta
        etiqueta.setAttribute("data-deporte-id", deporteId); // Almacenamos el ID del deporte como un atributo personalizado

        // Crear el botón "x" para eliminar la etiqueta
        var botonEliminar = document.createElement("span");
        botonEliminar.textContent = "x";
        botonEliminar.classList.add("eliminar-etiqueta");
        botonEliminar.onclick = function() {
            etiqueta.remove();
            actualizarInputHidden();
        };

        // Agregar el botón de eliminar a la etiqueta
        etiqueta.appendChild(botonEliminar);

        // Agregar la etiqueta al contenedor de etiquetas
        etiquetasContainer.appendChild(etiqueta);

        // Actualizar el contenido del input hidden
        actualizarInputHidden();
    }

    function actualizarInputHidden() {
        var etiquetas = document.querySelectorAll(".etiqueta");
        var etiquetasIDs = Array.from(etiquetas).map(function(etiqueta) {
            return etiqueta.getAttribute("data-deporte-id");
        });
        var inputHidden = document.getElementById("etiquetas-hidden");
        inputHidden.value = etiquetasIDs.join(","); // Enviamos solo los IDs separados por coma
    }

</script>

