@extends('layouts.app')
@section('section-principal')
    <div class="section" style=" background:none">
    
        <div class=" py-2 text-4xl " style="background: #ffffff96; width:min:content; text-align:center">
            <h1>Búsqueda: <strong>{{ $query }}</strong></h1>
        </div>

        {{-- <button id="btn1" class="bg-cyan-600 p-4 py-2 rounded text-white mx-2 hover:bg-cyan-500 hover:text-dark">Hazme click</button> --}}


        <div class="contenedor-resultados gap-4 justify-center flex flex-wrap" >
            @foreach ($resultados as $resultado)     


                {{-- 
                  <div class="">
                      <div class="card resultado" style="width: 18rem; ">
                          <a href="" style="color: currentColor; text-decoration:none">
                              <div class="" style="width: 200px; margin:auto" >
                                  <img src="{{ url('producto/' . $resultado->foto) }}" class="card-img-top" alt="..."  > 
                              </div>
                              <div class="card-body descripcion" style="border-top:1px solid #000">
                                  <h5 class="card-text">{{ $resultado->nombre}}</h5>
                                  <p class="card-text">Disponibles: {{ $resultado->stock}} </p>
                                  <p class="card-text">Precio: $ {{number_format($resultado->precio, 0, ',', '.')}}  </p>
                              </div>
                          </a>                    
                          <div class=" d-flex justify-content-center   ">
      
                              @guest
                                  <a href="#" class="btn btn-primary btn-sm my-1 mx-1" onclick="alert('Debes registrarte')">Agregar al carrito</a>
                              @else   
                                  <a href="#" class="btn btn-primary btn-sm my-1 mx-1" onclick="alert('Agregado al carrito')">Agregar al carrito</a>
                              @endguest
                              
                              
                              <a href="{{ route('detalles', ['id' => $resultado->id]) }}" class="btn btn-secondary btn-sm my-1 mx-1">Detalles</a>
                          </div>
                      </div>
                  </div>   
                --}}


              <div class="w-min bg-white shadow-lg  h-fit">
                  <div class="flex font-sans ">
                      <div class="flex w-48 relative content-center">
                        <img src="{{ url('producto/' . $resultado->foto) }}" alt="" class="absolute inset-0   object-cover w-full  m-auto" loading="lazy" />
                      </div>
                      <form class="flex-auto p-6">
                        <div class="flex flex-wrap">
                          <h1 class="flex-auto text-lg font-semibold text-slate-900">
                              {{ $resultado->nombre}} 
                          </h1>
                          <div class="text-lg font-semibold text-slate-500">
                              $ {{number_format($resultado->precio, 0, ',', '.')}} AR
                          </div>
                          <div class="w-full flex-none text-sm font-medium text-slate-700 mt-2">
                            Hay {{ $resultado->stock}} unidades disponibles
                          </div>
                        </div>
                        <div class="bg-gray-100 my-4 w-min   hover:cursor ">
                          <div class="inline-block relative w-32">
                            
                            <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline hover:cursor-pointer">
                              <option >Tu calzado</option>
                              <option>36-37</option>
                              <option>37-38</option>
                              <option>38-39</option>
                              <option>39-40</option>
                              <option>40-41</option>
                              <option>41-42</option>
                              <option>42-43</option>
                              <option>43-44</option>
                              <option>44-45</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M10 12l-6-6 1.41-1.41L10 9.17l4.59-4.58L16 6l-6 6z" />
                                </svg>
                            </div>
                          </div>
                        </div>
                        <div class="flex space-x-4 mb-6 text-sm font-medium">
                          <div class="flex-auto flex space-x-4">
                            <button class="hover:scale-105 hover:shadow-xl h-10 px-6 font-semibold rounded-md bg-black text-white" type="submit">
                              Comprar
                            </button>
                            {{-- <form action="{{ route('cart.store') }}" method="POST">
                              {{ csrf_field() }}
                              <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                              <input type="hidden" value="{{ $pro->name }}" id="name" name="name">
                              <input type="hidden" value="{{ $pro->price }}" id="price" name="price">
                              <input type="hidden" value="{{ $pro->image_path }}" id="img" name="img">
                              <input type="hidden" value="{{ $pro->slug }}" id="slug" name="slug">
                              <input type="hidden" value="1" id="quantity" name="quantity">
                              <div class="card-footer" style="background-color: white;">
                                    <div class="row">
                                      <button class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart">
                                          <i class="fa fa-shopping-cart"></i> agregar al carrito
                                      </button>
                                  </div>
                              </div>
                            </form> --}}
                            <button class="hover:scale-105 hover:shadow-md hover:cursor-pointer w-max h-10 px-6 font-semibold rounded-md border border-slate-200 text-slate-900" type="button">
                              <a href="#" class="text-black no-underline">
                                Agregar al carrito
                              </a>
                            </button>
                          </div>
                          <button class="hover:scale-105 hover:shadow-md hover:cursor-pointer flex-none flex items-center justify-center w-9 h-9 rounded-md text-slate-300 border border-slate-200" type="button" aria-label="Like">
                            <svg width="20" height="20" fill="currentColor" aria-hidden="true">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                            </svg>
                          </button>
                        </div>
                        <p class="text-sm text-slate-700">
                          Envíos gratis dentro del partido de San Nicolas
                        </p>
                      </form>
                  </div>
              </div>

            @endforeach 
            @if($contar_resultados < 1)
                <p style="width:fit-content; background: #ffffff8a; padding:10px">No se ha encontrado nada </p>
            @endif
        </div>
    </div>


    
    




@endsection