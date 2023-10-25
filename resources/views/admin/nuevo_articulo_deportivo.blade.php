@extends('admin.layouts.plantilla_admin')
@section('section-principal')

  <div class="w-fit">
    @include('admin.layouts.aside-left')
  </div>
 

  @if (session('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Atención!</strong> {{ session('mensaje') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif 
    <div id="articulos-deportivos">
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="display: flex; justify-content:space-between">
          <div class="d-flex">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Tabla <i class="fa-solid fa-table"></i></button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Crear articulo deportivo <i class="fa-solid fa-circle-plus"></i></button>
              </li>

            </ul>

          </div>
          <div class="mx-1">
            <li>
              <form class="d-flex mt-1" role="search">
                  <input class="form-control me-2 form-control-sm" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success btn-sm" type="submit">Search</button>
              </form>
            </li>
          </div>
           
        </ul>
        <div id="articulos-deportivos2">
            <div class="tab-content" id="myTabContent">
                
              <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0" style="min-height:500px;overflow-x:visible">
                <table class="table table-hover">
                    <thead  >
                      <td>Foto</td>
                      <td >Nombre</td>
                      <td >Precio</td>
                      <td >Marca</td>
                      <td >Categoria</td>
                      <td >Stock</td>
                      <td >Acciones</td>


                    </thead>
                    <tbody class="table-group-divider" id="tabla-articulos-deportivos">
                      @foreach ($articulos as $articulo)
                        <tr>

                          <td> <img src="{{url('producto/'. $articulo->foto) }}" alt="Foto aspirante" width="70px" height="70px"> </td>
                          <td><a href="{{ $articulo->id }}">{{ $articulo->nombre}}</a></td>
                          <td>$ {{number_format($articulo->precio, 0, ',', '.')}}</td>
                          <td>{{ $articulo->marca}}</td>
                          <td>
                            @foreach ($categorias as $categoria)
                              @if($articulo->id_categoria == $categoria->id)
                                {{ $categoria=$categoria->categoria }}
                              @endif
                            @endforeach
                          </td>
                          <td>{{ $articulo->stock}}</td>
                          <td>
                            <div class="d-flex justify-content-center">
                              <button class="btn btn-success btn-sm"><i class="fa-solid fa-pencil"></i></button>
                              <form class="mx-1" action="{{ route('eliminar_articulo', ['id' => $articulo->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                              </form>
                              <button class="btn btn-secondary btn-sm"><i class="fa-solid fa-eye"></i></button>
                            </div>

                          </td>


                        </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
              <div class="tab-pane fade " id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <form class="row g-3 p-3" 
                  action="{{ route('añadir_articulo')}}" 
                  method="POST"  
                  enctype="multipart/form-data">
                  @csrf
                  <div class="col-md-12 flex ">

                    <div class="col-md-6">

                      <div class="col-md-12">
  
                        <div class="col-md-12">
                          <h1 class="text-white text-3xl shadow-1 border-1 bg-pink-500/[0.9] w-fit px-2 py-1 rounded-full hover:scale-105 hover:cursor-pointer shadow-inner" onclick="alert('Categoria: Nuevo artículo deportivo')">Nuevo artículo deportivo</h1>
                        </div>
    
                        <div class="col-md-12">
                          <label for="inputEmail4" class="form-label">Titulo producto</label>
                          <input type="text" name="nombre_producto" class="form-control" id="inputEmail4">
                        </div>
  
                        <div class="col-md-12 flex mt-1 justify-between">
  
                          <div class="col-md-5 ">
                            <label for="inputEmail4" class="form-label">Genero del producto</label>
                            
                            <select name="genero" id="" class="form-select">
                              <option value="" selected hidden></option>
                              <option value="M">Masculino</option>
                              <option value="F">Femenino</option>
                              <option value="U">Unisex</option>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <label for="inputState" class="form-label">Stock</label>
                            <input type="text"name="stock" onwheel="preventScroll(event)"  oninput="formatNumber(this)"  class="form-control" id="stock" onsubmit="removeDots2()" >

                            {{-- <label for="inputEmail4" class="form-label">Tipo de producto</label>
                            
                            <select name="genero" id="" class="form-select">
                              <option value="" selected hidden></option>
                              <option value="M">Zapatilla de Futbol 5</option>
                              <option value="M">Botines de Futbol</option>
                              <option value="M">Pelota de voley</option>
                              <option value="M">Pelota de Handaball</option>
                              <option value="M">Pelota de Handaball</option>
                              <option value="M">Pechera</option>
                              <option value="M">Pelota</option>
  
                            </select> --}}
                          </div>
                        </div>
                      </div>
                        
  
  
                      <div class="col-md-12 flex justify-between">
       
    
                        <div class="col-md-5">
                          <label for="inputCity" class="form-label">Color</label>
                          <input type="text" name="color" class="form-control" id="inputCity">
                        </div>
                        <div class="col-md-6">
                          <label for="inputAddress" class="form-label">Marca</label>
                          <input type="text" name="marca" class="form-control" id="inputAddress" placeholder="Adidas, nike, otro">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="col-md-12">
    
                          <label class="form-label">Descripción</label>
                          <textarea class="form-control" placeholder="Podés brindar más  detalles sobre el producto, por ejemplo, ideal para empezar, pero, no para hacer uso profesional (por ejemplo)." id="" style="min-height: 110px; max-height:110px;" ></textarea>
                        </div>
                        

                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="col-md-12" style=" position: relative; ">
            

                        <div class="container d-flex justify-content-center bg-gray-500 " style="height: 250px;width:250px;  display:flex; justify-content: center;  background:#fff">
                            <a href="#" type="button" class="bg-gray-200">
                                <img id="imgPreview" style="height: 250px; width:250px;" >
                            </a>
                        </div>

                      </div>
                      <div class="col-md-12 grid justify-center my-3 ">
                        <label class=" btn text-white hover:scale-105 " style="background-color: #ec4899;text-align:center; width:100% ">
                          <input type="file" id="foto-aspirante" class="" name="foto" onchange="previewImage(event, '#imgPreview')" >
                          Subir foto
                        </label>
                      </div>

                      
                      <div class="col-md-12 flex justify-center " >
                        <div class="col-md-8 d-flex items-center" style="border-top: 1px solid #ec4899">

                          <div class="mr-5 bg-rose-500 p-1 h-min rounded-full text-white w-min">

                            <div class="form-check form-switch   ">
                              <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                              <label class="form-check-label" for="flexSwitchCheckDefault">Calzado</label>
                            </div>

                          </div>
                          <div class="ml-5  p-1  p-1 h-min   w-min">
                            <h1></h1>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                              <label class="form-check-label" for="flexRadioDefault1">
                                Niños
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                              <label class="form-check-label" for="flexRadioDefault2">
                                Adultos
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                              <label class="form-check-label" for="flexRadioDefault2">
                                Ambos
                              </label>
                            </div>
                          </div>

                          
                        </div>
                      </div>
                    </div>


                  </div>
                  

                  <div class="col-12 d-flex " style="justify-content:space-between">
                    <div class="col-md-3">
                      <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                    <div class="col-md-3 d-flex">
                      <label for="inputState" class="form-label mx-2 mt-2" >PRECIO</label>
                      <div class="input-group">
                        <span class="input-group-text " style="border:1px solid rgba(255, 0, 136, 0.377);" id="inputGroupPrepend2" >$</span>
                        <input type="text" name="precio"onwheel="preventScroll(event)"  class="form-control" id="validationDefaultUsername"  aria-describedby="inputGroupPrepend2" onsubmit="removeDots()" required>
                      </div>
                    </div>
                  </div>
                    <style>
                      .form-control, .form-select{
                        border :1px solid rgba(255, 0, 136, 0.466);
                        box-shadow: 0px 0px 5px rgba(255, 0, 136, 0.288); /*Si no gusta borrarlo*/
                      }

                    </style>
                </form>
              </div>
              <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
              <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
            </div>

 
              
        </div>

    </div>
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

