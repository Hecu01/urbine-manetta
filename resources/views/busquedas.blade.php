@extends('layouts.app')
@section('section-principal')
  @if (session('message'))
    <p> {{ session('message') }} </p>
  @endif 
  <div class="section" style=" background:none; min-height:600px">

      {{-- <x-orden /> --}}

      <section class="flex">

          <aside class="col-2">
              <x-filter :query="$query" :orderDirection="$orderDirection" :resultados="$resultados" :selectedBrands="$selectedBrands" :allBrands="$allBrands"
                  :selectedGeneros="$selectedGeneros" :allGeneros="$allGeneros" />
          </aside>
          <div class="contenedor-resultados col-9 justify-center flex flex-wrap">
            
            <!-- Cada rectangulito -->
            @foreach ($resultados as $resultado)
              <div class="w-min bg-white shadow-lg  h-fit position-relative">
                @if (isset($resultado->descuento) && $resultado->descuento->activo == true)
                  <span class="bg-red-500 text-white"
                    style="padding: 0px 3px ;font-size:13px;position:absolute; right:24px; top:76px; font-family:'Times New Roman', Times, serif">
                    -{{ str_replace('.', ',', number_format($resultado->descuento->porcentaje, $resultado->descuento->porcentaje == round($resultado->descuento->porcentaje) ? 0 : 2)) }}%
                    OFF


                  </span>
                @endif

                @guest
                @else
                  @if (Auth::user()->administrator == true)
                    <div class="position-absolute right-1 rounded-full flex">
                      <div class="hover:scale-125">
                        <a href="" class="btn-success p-1 px-2 rounded-full border-3 border-white shadow-sm hover:shadow-lg hover:mr-1 no-underline" title="Editar producto: ID {{ $resultado->id }}">Editar <i class="fa-solid fa-pen"></i></a>
                      </div>
                      <div class="hover:scale-125">
                          <a href="" class="btn-danger p-1 px-2 rounded-full border-3 hover:ml-1 border-white shadow-sm hover:shadow-lg no-underline" title="Eliminar producto: ID {{ $resultado->id }}">Eliminar <i class="fa-solid fa-trash"></i></a>
                      </div>
                    </div>
                  @endif
                @endguest
                <div class="flex font-sans ">
                  <div class="flex w-48 relative content-center">
                    <img src="{{ url('producto/' . $resultado->foto) }}" alt="{{ $resultado->nombre }}" draggable="false" class="absolute inset-0   object-cover w-full  m-auto" loading="lazy" />
                  </div>
                  <div class="flex-auto p-6">
                    <div class="flex flex-wrap">
                      <h1 class="flex-auto text-lg font-semibold text-slate-900">
                        {{ $resultado->nombre }}
                      </h1>

                      <!-- Lógica del descuento -->
                      @if (isset($resultado->descuento) && $resultado->descuento->activo == true)
                        <div class=""style=" position:relative">

                          <div class="text-lg font-semibold text-slate-500">
                            $
                            {{ number_format($resultado->precio - $resultado->descuento->plata_descuento, 0, ',', '.') }}
                            AR

                          </div>
                          <div class="text-lg font-semibold text-slate-500 text-sm"
                            style="position:absolute; right:0">
                            <span style="text-decoration:line-through">$ {{ number_format($resultado->precio, 0, ',', '.') }}</span>
                            antes

                          </div>
                        </div>
                      @else
                        <div class="text-lg font-semibold text-slate-500">
                          $ {{ number_format($resultado->precio, 0, ',', '.') }} AR
                        </div>
                      @endif

                      <div class="w-full flex-none text-sm font-medium text-slate-700 my-2">
                        Hay {{ $resultado->stock }} unidades disponibles
                      </div>
                    </div>

                    <div class="flex">

                      <!-- Verifica si es un calzado -->
                      @if ($resultado->tipo_producto == 'calzado' && count($resultado->calzados) > 0)
                        <div class="bg-gray-100 my-2 w-min   hover:cursor ">
                          <div class="inline-block relative " style="width:120px">

                            <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline hover:cursor-pointer" id="talle">
                              <option value=""selected hidden>Elija talle</option>
                              @foreach ($resultado->calzados as $calzado)
                                @if ($calzado->pivot->stocks > 0)
                                  <option value="{{ $calzado->id }}" data-stock="{{ $calzado->pivot->stocks }}">
                                    Talle {{ $calzado->calzado }} 
                                  </option>
                                @endif
                              @endforeach
                            </select>

                          </div>
                        </div>
                      @endif
                      
                      <!-- Elegir las unidades-->
                      <div class="w-fit my-2 mb-3 mr-3">
                        <select id="unidades"
                          class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline hover:cursor-pointer unidades">
                          <option value="1" selected>1 unidad</option>
                          <option value="2">2 unidades</option>
                          <option value="3">3 unidades</option>
                          <option value="4">4 unidades</option>
                          <option value="5">5 unidades</option>
                        </select>
                      </div>
                    </div>

                    <div class="flex space-x-4 mb-6 text-sm font-medium ">
                        <div class="flex-auto flex space-x-4">
                            {{-- Es invitado! --}}
                            @guest
                              <!-- Botón para abrir el modal -->
                              <button data-bs-toggle="modal" data-bs-target="#miModal" type="button"
                                  class="hover:scale-105 hover:shadow-xl h-10 px-6 font-semibold rounded-md bg-black text-white"
                                  type="button">
                                  Comprar
                              </button>

                              <button data-bs-toggle="modal" data-bs-target="#miModal" type="button"
                                  class="hover:scale-105 hover:shadow-md hover:cursor-pointer w-max h-10 px-6 font-semibold rounded-md border border-slate-200 text-slate-900"
                                  type="button">
                                  <a href="#" class="text-black no-underline">
                                      Agregar al carrito
                                  </a>
                              </button>


                              <!-- Modal - registrarse -->
                              <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="miModalLabel"
                                  aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title text-xl" id="miModalLabel">Atención!</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Cerrar"></button>
                                          </div>
                                          <div class="modal-body text-center">
                                              <!-- Contenido del modal -->

                                              <p class="text-xl  ">Inicia sesión o regístrate para poder comprar o
                                                  agregar al carrito</p>
                                              <a class="btn btn-primary" href="{{ route('login') }}">Entrar</a>
                                              <a class="btn btn-primary"
                                                  href="{{ route('register') }}">Registrarse</a>
                                          </div>

                                      </div>
                                  </div>
                              </div>
                           {{-- Logueado --}}
                          @else
                            <button class="hover:scale-105 hover:shadow-xl h-10 px-6 font-semibold rounded-md bg-black text-white" type="button" onclick="alert('te llevaré a los metodos de pago');">
                              <a href="#" class="text-white no-underline">
                                Comprar
                              </a>
                            </button>

                            <form class="w-min">
                              <input type="hidden" name="producto_id" class="producto_id" value="{{ $resultado->id }}">
                              <input type="hidden" name="nombre" class="nombre" value="{{ $resultado->nombre }}">
                              @isset($resultado->descuento)
                                  
                                <input type="hidden" name="precio" class="precio" value="{{ $resultado->precio - $resultado->descuento->plata_descuento }}">
                              @else
                                <input type="hidden" name="precio" class="precio" value="{{ $resultado->precio }}">
                              @endisset
                              <input type="hidden" name="imagen" class="imagen" value="{{ $resultado->foto }}">
                              
                              <!-- Cambiado a visible para que el usuario pueda seleccionar la cantidad -->
                              <button type="submit" class="hover:scale-105 hover:shadow-md hover:cursor-pointer w-max h-10 px-6 font-semibold rounded-md border border-slate-200 text-slate-900 agregarAlCarrito" >
                                Agregar al carrito
                              </button>
                            </form>
                          @endguest

                        </div>
                        <button
                            class="hover:scale-105 hover:shadow-md hover:cursor-pointer flex-none flex items-center justify-center w-9 h-9 rounded-md text-slate-300 border border-slate-200"
                            type="button" aria-label="Like">
                            <svg width="20" height="20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-sm text-slate-700">
                        Tiene hasta 10 días hábiles para cambiarse
                    </p>
                  </div>
                </div>
              </div>
            @endforeach
            @if ($contar_resultados < 1)
                <p style="width:fit-content; background: #ffffff8a; padding:10px">No se ha encontrado nada </p>
            @endif
          </div>
      </section>

  </div>


  <!-- Modal -->
  <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="imageModalLabel">Imagen Ampliada</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <img src="" id="modalImage" class="img-fluid" alt="Imagen Modal">
              </div>
          </div>
      </div>
  </div>





  <script>
    $(document).on('click', '.agregarAlCarrito', function(e) {
      e.preventDefault(); // Evitar que el formulario se envíe normalmente

      // Usar `$(this)` para referenciar el botón clickeado y buscar los inputs dentro del formulario
      var formulario = $(this).closest('form');
      var productoId = formulario.find('.producto_id').val();
      var nombre = formulario.find('.nombre').val();
      var precio = formulario.find('.precio').val();
      var imagen = formulario.find('.imagen').val();
      var cantidad = $('.unidades').val() || 1; // Si no se especifica cantidad, usar 1 por defecto

      $.ajax({
        url: "{{ route('carrito.añadir') }}", // Ruta a la que se envía la petición
        method: 'POST',
        data: {
          _token: '{{ csrf_token() }}', // Asegúrate de enviar el token CSRF
          producto_id: productoId,
          nombre: nombre,
          precio: precio,
          imagen: imagen,
          cantidad: cantidad
        },
        success: function(response) {
          // Mostrar un mensaje de éxito o actualizar la interfaz
          alert(response.message);
            
          // Actualizar la cantidad de productos en el carrito
          $('#carrito-de-compras .badge').text(response.carrito.length);

          // Actualizar el contenido del carrito (el dropdown)
          let carritoContent = '';
          response.carrito.forEach(function(item) {
              carritoContent += `
                  <div class="flex h-fit">
                      <div class="pb-2">
                          <img src="{{ url('producto/') }}/${item.imagen}" alt="" width="100px" height="100px">
                      </div>
                      <div>
                          <ul>
                              <li>${item.name}</li>
                              <li>Precio: $${item.price.toLocaleString()}</li>
                              <li>Cantidad: ${item.quantity}</li>
                          </ul>
                      </div>
                  </div>
                  <hr>`;
          });

          if (response.carrito.length > 0) {
            $('#carrito-de-compras .dropdown-menu').html(`
                <h1 class="text-lg text-center">Carrito de compras</h1>
                ${carritoContent}
            `);
          } else {
            $('#carrito-de-compras .dropdown-menu').html('<h1 class="text-lg text-center">El carrito está vacío</h1>');
          }
        },
        error: function(xhr, status, error) {
          var errorMessage = xhr.status + ': ' + xhr.statusText;
          alert('Error - ' + errorMessage);
        }
      });
    });



    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('input[name="orderDirection"]').forEach(function(input) {
        input.addEventListener('change', function() {
          document.getElementById('filterForm')
            .submit(); // Enviar el formulario al cambiar la opción
        });
      });
    });




  </script>
@endsection
