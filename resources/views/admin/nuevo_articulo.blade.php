@extends('admin.layouts.plantilla_admin')
@section('section-principal')
  @include('admin.layouts.aside-left')

  @if (session('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Atención!</strong> {{ session('mensaje') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif 
    <div class="" id="articulos-deportivos" >
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="display: flex; justify-content:space-between">
          <div class="d-flex">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Tabla <i class="fa-solid fa-table"></i></button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Nuevo articulo <i class="fa-solid fa-circle-plus"></i></button>
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
                            <button class="btn btn-success btn-sm"><i class="fa-solid fa-pencil"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                            <button class="btn btn-secondary btn-sm"><i class="fa-solid fa-eye"></i></button>

                          </td>


                        </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <form class="row g-3 p-3" 
                  action="{{ route('añadir_articulo')}}" 
                  method="POST"  
                  enctype="multipart/form-data">
                  @csrf
                  <div class="col-md-12">

                    <div class="d-flex">

                      <div class="col-md-6">

   
                        <div class="col-md-12">
                          <label for="inputEmail4" class="form-label">Titulo producto</label>
                          <input type="text" name="nombre_producto" class="form-control" id="inputEmail4">
                        </div>
  
                        <div class="col-md-12">
                          <label for="inputEmail4" class="form-label">Genero del producto</label>
  
                          <select name="genero" id="" class="form-select">
                            <option value="" selected hidden>Seleccione una opción</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            <option value="U">Unisex</option>
                          </select>
                        </div>
                      </div>
                      <div class="" style="display: flex; justify-content: space-between; align-items:center; position: relative; margin-left:50px">
            
                        <label class="custom-file-upload btn btn-danger" style="text-align:center; margin:0px 30px; margin-right:20px;">
                          <input type="file" id="foto-aspirante" class="btn btn-secondary " name="foto" onchange="previewImage(event, '#imgPreview')" >
                          Subir foto
                        </label>
                        <div class="container d-flex justify-content-center" style="height: 130px;width:130px;  display:flex; justify-content: center; box-shadow: 0px 0px 1px #000; background:#fff">
                            <a href="#" type="button">
                                <img id="imgPreview" style="height: 130px; width:130px;">
                            </a>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div class="col-md-12">
                      <label for="inputAddress" class="form-label">Marca</label>
                      <input type="text" name="marca" class="form-control" id="inputAddress" placeholder="Adidas, nike, rebook, umbro">
                    </div>
                    <div class="col-md-12">
                      <label for="inputAddress2" class="form-label">Categoria</label>
                      <select name="categoria" id="" class="form-select">
                        <option value="" selected hidden>Seleccione una opción</option>
                        @foreach ($categorias as $categoria)                          
                          <option value="{{ $categoria->id}}">{{ $categoria->categoria}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-12">
                      <label for="inputCity" class="form-label">Color</label>
                      <input type="text" name="color" class="form-control" id="inputCity">
                    </div>

                  </div>
                  <div class="col-md-6">
                    <div class="col-md-12">

                      <label class="form-label">Descripción</label>
                      <textarea class="form-control" placeholder="Podés brindar más  detalles sobre el producto, por ejemplo, ideal para empezar, pero, no para hacer uso profesional (por ejemplo)." id="" style="min-height: 110px; max-height:110px;" ></textarea>
                    </div>
                    
                    <div class="col-md-12">
                      <label for="inputState" class="form-label">Stock</label>
                      <input type="number"name="stock" class="form-control" id="inputStock">

                    </div>

                  </div>

                    <div class="col-12 d-flex " style="justify-content:space-between">
                      <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                      </div>
                      <div class="col-md-3 d-flex">
                        <label for="inputState" class="form-label mx-2 mt-2">PRECIO 

                        </label>
                        <input type="number"name="precio" class="form-control" id="inputStock">                      
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
@endsection
