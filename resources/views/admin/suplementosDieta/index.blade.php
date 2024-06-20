@extends('admin.layouts.plantilla_admin')

@section('section-principal')
  <main class="principal-main-ropa-deportiva">

    <div class="w-fit">
      @include('admin.layouts.aside-left')
      <div class="flex justify-center mt-3">
        <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class="bg-green-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
          <i class="fa-solid fa-circle-arrow-left"></i> Atrás
        </a>
  
      </div>
   
    </div>

    <section class="center-actions">
        <div class=""style="max-width:800px; border:1px solid rgb(0,0,0,0.2)">

            <form class="row g-3 p-3" action="{{ route('articulos-deportivos.store')}}" method="POST" id="formulario-ropa-deportiva" enctype="multipart/form-data">
              @csrf
              <div class="col-md-12 flex ">
          
                  <div class="col-md-6">
          
                      <div class="col-md-12">
          
                          <div class="col-md-12">
                              <h1 class="text-white text-3xl shadow-1 border-1 bg-green-500 w-fit px-2 py-1 rounded-full hover:scale-105 hover:cursor-pointer shadow-inner" onclick="alert('Categoria: Nuevo suplemento deportivo')">
                                <div class="flex items-center">

                                  Suplementos y dieta 
                                  <span class="ml-2">
                                    <svg height="45px" width="45px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#B29A7E;" d="M256,141.954c-6.189,0-11.207-5.016-11.207-11.207C244.793,58.653,303.446,0,375.541,0 c6.189,0,11.207,5.016,11.207,11.207s-5.018,11.207-11.207,11.207c-59.736,0-108.334,48.598-108.334,108.334 C267.207,136.938,262.189,141.954,256,141.954z"></path> <path style="fill:#E07188;" d="M345.655,108.55c-33.08,0-63.871,9.78-89.655,26.595c-25.785-16.815-56.576-26.595-89.655-26.595 c-90.778,0-164.368,73.591-164.368,164.368C1.976,392.459,61.746,512,166.345,512c33.08,0,63.871-9.78,89.655-26.595 C281.785,502.22,312.576,512,345.655,512c104.598,0,164.368-119.541,164.368-239.081C510.024,182.14,436.435,108.55,345.655,108.55z "></path> <path style="fill:#DC4161;" d="M345.655,108.55c-15.525,0-30.537,2.179-44.774,6.204c68.962,19.531,119.487,82.946,119.487,158.164 c0,102.443-43.9,204.878-122.289,232.085c15.059,4.549,31.031,6.996,47.576,6.996c104.598,0,164.368-119.541,164.368-239.081 C510.024,182.14,436.435,108.55,345.655,108.55z"></path> <path style="fill:#95D5A7;" d="M133.471,12.918c0,67.67,54.859,122.529,122.529,122.529C256,67.775,201.143,12.918,133.471,12.918z"></path> <path style="fill:#80CB93;" d="M210.836,126.815c13.98,5.548,29.208,8.631,45.164,8.631c0-67.67-54.859-122.529-122.529-122.529 c0,2.905,0.137,5.777,0.336,8.631C176.573,38.522,207.495,78.855,210.836,126.815z"></path> </g></svg>                                  </span>
                                </div>
                              </h1>
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
                                  <select name="tipoProducto" class="form-select SelectTypeProduct" required >
                                      <option value="" selected hidden></option>
                                      <option value="Calzas térmicas">Calzas térmicas</option>
                                      <option value="Camisetas técnicas">Camisetas técnicas</option>
                                      <option value="Chalecos">Chalecos</option>
                                      <option value="Chaquetas cortaviento">Chaquetas cortaviento</option>
                                      <option value="Leggings">Leggings</option>
                                      <option value="Mallas">Mallas</option>
                                      <option value="Musculosa">Musculosa</option>
                                      <option value="Pantalones de chándal">Pantalones de chándal</option>
                                      <option value="Remeras">Remeras</option>
                                      <option value="Ropa de ciclismo">Ropa de ciclismo</option>
                                      <option value="Shorts de running">Shorts de running</option>
                                      <option value="Sujetadores deportivos">Sujetadores deportivos</option>
                                      <option value="Top deportivo">Top deportivo</option>
                                      <option value="Trajes de baño">Trajes de baño</option>
                                      <option value="Uniformes de equipo">Uniformes de equipo</option>
      
                                  </select>   

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
                                    <option value="" selected hidden> Agregá los deportes relacionados</option>
                                    @foreach ($deportes as $deporte)
                                        <option value="{{ $deporte->id }}">{{ $deporte->deporte }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div  style="width:50px; margin-top:29px" id="contenedor-plus">
                                <button class="py-2 px-3 bg-green-500 hover:bg-green-600"  type="button" onclick="agregarDeporte()" id="agregar-tag-artdeport">+</button>
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
                      <div class="col-md-12" style=" position: relative; display:flex; justify-content:end; ">
          
                          <div class=" d-flex justify-end shadow-sm border-2 " style="height: 250px;width:250px;margin-right:10px;  display:flex; ;align-items:center;  background:#fff">
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
                      <div class="col-md-12 flex justify-end my-3 "  style="margin-right: 50px" id="bottom-image">
                        <div style="margin-right: 90px">

                            <label class=" text-white  bg-green-500 hover:bg-green-600" for="imageInput" >
                                <input type="file" name="foto" id="imageInput" multiple accept="image/*">
                                Cargar fotos
                            </label>
                        </div>
                      </div>
          
                      
                      <div class="col-md-12 flex justify-end " >
                          <div class="col-md-9 flex  items-center" style="border-top: 1px solid rgb(16, 163, 28)">
          
                              <div class="col-md-5">
                                  <label for="stock_input" class="form-label">Stock</label>
                                  <input type="text" name="stock" placeholder="cantidad"  class="form-control total stock_input" id="stock_input_ropa" required>
          
                              </div>
          
                              <div class="ml-5 p-1 p-1">
                                  <label for="inputCity" class="form-label">Color</label>
                                  <input type="text" name="color" class="form-control" placeholder="Rojo, fuxia, amarillo..." required>
          
                              </div>
                              
                          </div>
                      </div>
                  </div>
          
          
                </div>
            
                <div id="contenedor-modal-talles">
                    @include('admin.ropasDeportivas.partials.modal')
                </div>
          
                <div class="col-12 d-flex " style="justify-content:space-between">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success">Cargar a Sportivo</button>
                    </div>
                    <div class="col-md-3">
                        <button  id="agregar-calzados"  type="button" class="bg-slate-600 rounded-full py-2 px-2 hover:cursor-pointer hover:scale-105  text-white "  data-bs-toggle="modal" data-bs-target="#modalTalles">Indicaciones (opcional)</button>
                    </div>
                    <div class="col-md-3 d-flex">
                        <label for="inputState" class="form-label mx-2 mt-2" >PRECIO</label>
                        <div class="input-group">
                            <span class="input-group-text " style="border:1px solid rgba(16, 163, 72, 0.377);" id="signo-peso" >$</span>
                            <input type="text" name="precio"onwheel="preventScroll(event)"  class="form-control" id="precioFinal"  aria-describedby="inputGroupPrepend2" onsubmit="removeDots()" required>
                        </div>
                    </div>
                </div>
            
 
            </form> 
        </div>
    </section>
  
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

