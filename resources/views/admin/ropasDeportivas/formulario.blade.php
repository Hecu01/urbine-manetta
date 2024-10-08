@extends('admin.layouts.plantilla_admin')

@section('section-principal')
  <main class="principal-main-ropa-deportiva">

    <div class="w-fit">
      @include('admin.layouts.aside-left')
      <div class="flex justify-center mt-3">
        <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
          <i class="fa-solid fa-circle-arrow-left"></i> Atrás
        </a>
  
      </div>
   
    </div>

    @if (session('mensaje'))
        @include('admin.partials.MsjDelSistema.ArtAgregConExito') 
    @endif 
    @if (session('eliminado'))
        @include('admin.partials.MsjDelSistema.ProductoEliminado') 
    @endif 
    <section class="center-actions">
        <div class=""style=" border:1px solid rgb(0,0,0,0.2)">

            <form class="row g-3 p-3" action="{{ route('ropa-deportiva.store')}}" method="POST" id="formulario-ropa-deportiva" enctype="multipart/form-data">
              @csrf
              <div class="col-md-12 flex ">
          
                  <div class="col-md-6">
          
                      <div class="col-md-12">
          
                          <div class="col-md-12">
                            <h1 class="text-white text-3xl shadow-1 border-1 bg-blue-500 w-fit px-2 py-1 rounded-full hover:scale-105 hover:cursor-pointer shadow-inner" onclick="alert('Categoria: Nuevo suplemento deportivo')">
                                <div class="flex items-center">

                                  Nuevo artículo 
                                  <span>
                                    <svg fill="#ffffff" style="width: 50px" viewBox="-1 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="m15.867 7.593-1.534.967a.544.544 0 0 1-.698-.118l-.762-.957v7.256a.476.476 0 0 1-.475.475h-7.79a.476.476 0 0 1-.475-.475V7.477l-.769.965a.544.544 0 0 1-.697.118l-1.535-.967a.387.387 0 0 1-.083-.607l2.245-2.492a2.814 2.814 0 0 1 2.092-.932h.935a2.374 2.374 0 0 0 4.364 0h.934a2.816 2.816 0 0 1 2.093.933l2.24 2.49a.388.388 0 0 1-.085.608z"></path></g></svg>
                                  </span>
                                </div>
                              </h1>
                          </div>
          
                          <div class="col-md-12">
                              
                              <label for="nombre-ropa" class="form-label">Titulo producto</label>
                              <input type="text" name="nombre_producto"  class="form-control" placeholder="Inserte un titulo bonito al producto" required id="nombre-ropa">
                          </div>
          
                          <div class="col-md-12 flex mt-1 justify-between my-1">
          
                              <div class="col-md-5 ">
                              <label for="genero-ropa" class="form-label">Genero del producto</label>
                              
                              <select name="genero" id="genero-ropa" class="form-select" required>
                                  <option value="" selected hidden>Elija una opción</option>
                                  <option value="Masculino">Masculino</option>
                                  <option value="Femenino">Femenino</option>
                                  <option value="Unisex">Unisex</option>
                              </select>
                              </div>
                              <div class="col-md-6">
                                  <label for="publico-dirigido" class="form-label">Público dirigido</label>
                                  
                                  <select name="publico_dirigido" id="publico-dirigido" class="form-select" required>
                                      <option value="" selected hidden></option>
                                      <option value="adultos">Adultos</option>
                                      <option value="niños">Niños</option>
                                      <option value="ambos">Ambos</option>
                                  </select>
          
          
                                  {{-- Categoria --> ropa deportiva --}}
                                  <input type="text" name="categoria" id="" value="2" hidden>
                              </div>
                          </div>
                      </div>
                      
          
          
                      <div class="col-md-12 flex justify-between my-1">
          
          
                          <div class="col-md-5">
                              <label for="tipo-ropa" class="form-label " >Tipo de producto</label>
                              <div class="input-group d-flex" >
                                  <select name="tipoProducto" id="tipo-ropa" class="form-select SelectTypeProduct" required >
                                      <option value="" selected hidden></option>
                                      <option value="">Calzas térmicas</option>
                                      <option value="">Camisetas técnicas</option>
                                      <option value="">Chalecos</option>
                                      <option value="">Chaquetas cortaviento</option>
                                      <option value="">Leggings</option>
                                      <option value="">Mallas</option>
                                      <option value="">Musculosa</option>
                                      <option value="">Pantalones de chándal</option>
                                      <option value="">Remeras</option>
                                      <option value="">Ropa de ciclismo</option>
                                      <option value="">Shorts de running</option>
                                      <option value="">Sujetadores deportivos</option>
                                      <option value="">Top deportivo</option>
                                      <option value="">Trajes de baño</option>
                                      <option value="">Uniformes de equipo</option>
      
                                  </select>   

                              </div>
                          </div>
                          <div class="col-md-6">
                              <label for="marca-ropa" class="form-label">Marca</label>
                              <input type="text" name="marca" class="form-control" id="marca-ropa" required placeholder="Adidas, nike, otro">
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
                              <button class="py-2 px-3 btn btn-primary"  type="button" onclick="agregarDeporte()" id="agregar-tag-artdeport">+</button>
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

                            <label class=" text-white  bg-blue-500 hover:bg-blue-600" for="imageInput" >
                                <input type="file" name="foto" id="imageInput" multiple accept="image/*">
                                Cargar fotos
                            </label>
                        </div>
                      </div>
          
                      
                      <div class="col-md-12 flex justify-end " >
                          <div class="col-md-9 flex  items-center" style="border-top: 1px solid rgb(16, 18, 163)">
          
                              <div class="col-md-5">
                                  <label for="stock_input_ropa" class="form-label">Stock</label>
                                  <input type="text" name="stock" placeholder="cantidad"  class="form-control estilo-readonly total stock_input" id="stock_input_ropa" required>
          
                              </div>
          
                              <div class="ml-5 p-1 p-1">
                                  <label for="color-ropa" class="form-label">Color</label>
                                  <input type="text" name="color" id="color-ropa" class="form-control" placeholder="Rojo, fuxia, amarillo..." required>
          
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
                        <button type="submit" class="btn btn-primary" id="cargar-ropa" >Finalizar</button>
                    </div>
                    <div class="col-md-3 ">
                        <button  id="agregar-calzados"  type="button" class="bg-slate-600 rounded-full py-2 px-5 hover:cursor-pointer hover:scale-105  text-white "  data-bs-toggle="modal" data-bs-target="#modalTalles">Talles</button>
                    </div>
                    <div class="col-md-3 d-flex">
                        <label for="inputState" class="form-label mx-2 mt-2" >PRECIO</label>
                        <div class="input-group">
                            <span class="input-group-text " style="border:1px solid rgb(16, 153, 163,0.377);" id="signo-peso" >$</span>
                            <input type="text" name="precio"onwheel="preventScroll(event)"  class="form-control" id="precioFinal"  aria-describedby="inputGroupPrepend2" onsubmit="removeDots()" required>
                        </div>
                    </div>
                </div>
            
 
            </form> 
        </div>
    </section>
    <div class="aside " >
        @include('admin.ropasDeportivas.partials.right')
    </div>
    
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

