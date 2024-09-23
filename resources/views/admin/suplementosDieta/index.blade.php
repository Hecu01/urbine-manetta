@extends('admin.layouts.plantilla_admin')

@section('section-principal')
  <main class="principal-main-ropa-deportiva">

    <div class="w-fit">
      @include('admin.layouts.aside-left')
      <div class="flex justify-center mt-3">
        <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class="bg-blue-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
          <i class="fa-solid fa-circle-arrow-left"></i> Atrás
        </a>
  
      </div>
   
    </div>

    <section class="center-actions">
        <div class=""style="max-width:800px; border:1px solid rgb(0,0,0,0.2)">

            <form class="row g-3 p-3" action="{{ route('suplementos-dieta.store')}}" method="POST" id="formulario" enctype="multipart/form-data">
              @csrf
              <div class="col-md-12 flex ">
          
                  <div class="col-md-6">
          
                      <div class="col-md-12">
          
                          <div class="col-md-12">
                              <h1 class="text-white text-3xl shadow-1 border-1 bg-blue-500 w-fit px-2 py-1 rounded-full hover:scale-105 hover:cursor-pointer shadow-inner" onclick="alert('Categoria: Nuevo suplemento deportivo')">
                                <div class="flex items-center">

                                  Nuevo Suplem. y dieta 
                                  <span>
                                    <i class="fa-solid fa-heart" style="font-size:1.1em; margin:5px 10px"></i>
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
          
          
                                  {{-- Categoria: Suplementos y dieta --}}
                                  <input type="text" name="categoria" id="" value="3" hidden>
                              </div>
                          </div>
                      </div>
                      
          
          
                      <div class="col-md-12 flex justify-between my-1">
          
          
                          <div class="col-md-5">
                              <label for="inputState" class="form-label " >Tipo de producto</label>
                              <div class="input-group d-flex" >
                                  <select name="tipoProducto" class="form-select SelectTypeProduct" required >
                                      <option value="" selected hidden></option>
                                      <option value="Suplemento">Suplemento</option>
                                      <option value="Barra Energetica">Barra Energetica</option>
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
                              <button class="py-2 px-3 bg-blue-500 hover:bg-blue-600"  type="button" onclick="agregarDeporte()" id="agregar-tag-artdeport">+</button>
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

                            <label class=" text-white  bg-blue-500 hover:bg-green-600" for="imageInput" >
                                <input type="file" name="foto" id="imageInput" multiple accept="image/*">
                                Cargar fotos
                            </label>
                        </div>
                      </div>
          
                      
                      <div class="col-md-12 flex justify-end " >
                          <div class="col-md-9 flex  items-center" style="border-top: 1px solid rgb(43, 16, 163)">
          
                              <div class="col-md-5">
                                  <label for="stock_input" class="form-label">Stock</label>
                                  <input type="text" name="stock" placeholder="cantidad"  class="form-control " " required>
          
                              </div>
          
                              <div class="ml-5 p-1 p-1">
                                  <label for="inputCity" class="form-label">Color</label>
                                  <input type="text" name="color" class="form-control" placeholder="Rojo, fuxia, amarillo..." required>
          
                              </div>
                              
                          </div>
                      </div>
                  </div>
          
          
              </div>
          

          
                <div class="col-12 d-flex " style="justify-content:space-between">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-danger">Sportivo!</button>
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

