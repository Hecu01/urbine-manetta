@extends('layouts.app')
@section('section-principal')
    @if (session('message'))
        <p> {{ session('message') }} </p>
    @endif
    <div class="section" style=" background:none; min-height:600px; height:auto">

        {{-- <x-orden /> --}}

        <section class="flex justify-center">

            <aside class="col-2">
                <x-filter :query="$query" :orderDirection="$orderDirection" :resultados="$resultados" :selectedBrands="$selectedBrands" :selectedDeporte="$selectedDeporte"
                    :allBrands="$allBrands" :selectedGeneros="$selectedGeneros" :allGeneros="$allGeneros" />
            </aside>
            <div class="contenedor-resultados col-8 flex flex-wrap gap-4">
                {{-- Resultados de la búsqueda --}}
                @foreach ($resultados as $resultado)
                    <div class="w-min bg-white shadow-lg p-3 h-fit position-relative">
                        <form method="POST" class="w-min">
                            @if (isset($resultado->descuento) && $resultado->descuento->activo == true)
                                <span class="bg-red-500 text-white"
                                    style="padding: 0px 3px ;font-size:13px;position:absolute; right:38px; top:106px; font-family:'Times New Roman', Times, serif">
                                    -{{ str_replace('.', ',', number_format($resultado->descuento->porcentaje, $resultado->descuento->porcentaje == round($resultado->descuento->porcentaje) ? 0 : 2)) }}%
                                    OFF


                                </span>
                            @endif


                            @guest
                            @else
                                {{-- Botones admin --}}
                                @if (Auth::user()->administrator)
                                
                                    <div class="position-absolute right-1 rounded-full flex m-1">
                                        <div class="hover:scale-125 mr-1.5">

                                            <a href="{{ route('articulos-deportivos.edit', $resultado->id) }}"
                                                class="btn-success p-1 px-2 rounded-full border-3 border-white shadow-sm hover:shadow-lg hover:mr-1 no-underline"
                                                title="Editar producto: ID {{ $resultado->id }}">Editar <i
                                                    class="fa-solid fa-pen"></i></a>
                                        </div>
                                        <div class="hover:scale-125">
                                            <button type="button" onclick="eliminarProducto({{ $resultado->id }})" class="btn-danger p-1 px-2 rounded-full">
                                                Eliminar <i class="fa-solid fa-trash"></i>
                                            </button>
                                            
                                            
                                        </div>
                                    </div>

                                @endif
                            @endguest
                            <div class="flex font-sans mt-3">

                                <div class="flex w-48 relative content-center">
  
                                    <div id="carousel-{{ $resultado->id }}" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000" style="background: rgba(0, 0, 0, 0.404); display:flex; align-items:center;width: 200px;">
                                        <div class="carousel-inner">
                                            @foreach($resultado->fotos as $index => $foto)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <img src="{{ url('productos/' . $foto->ruta) }}" alt="{{ $resultado->nombre }}" style="width: 200px; height: auto;">

                                                </div>
                                            @endforeach
                                        </div>
                            
                                        <!-- Controles del carrusel -->
                                        <button class="carousel-control-prev" style="color: red" type="button" data-bs-target="#carousel-{{ $resultado->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true" style="color: red"></span>
                                            <span class="visually-hidden" style="color: red">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $resultado->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>                                    
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

                                                    <span style="text-decoration:line-through">$
                                                        {{ number_format($resultado->precio, 0, ',', '.') }}</span>

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
                                    {{--  Elegir la cantidad --}}
                                    <div class="flex">
                                        {{-- Si es relación muchos a muchos --}}
                                        @if ($resultado->tipo_producto == 'calzado' && count($resultado->calzados) > 0)
                                            <div class="bg-gray-100 my-2 w-min   hover:cursor ">
                                                <div class="inline-block relative " style="width:120px">

                                                    <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline hover:cursor-pointer calzadoTalle" id="talle">
                                                        <option value="0"selected hidden>Elija talle</option>
                                                        @foreach ($resultado->calzados as $calzado)
                                                            @if ($calzado->pivot->stocks > 0)
                                                                <option value="{{ $calzado->calzado }}" data-id=""
                                                                    data-stock="{{ $calzado->pivot->stocks }}">Talle
                                                                    {{ $calzado->calzado }} </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <input type="text" class="tieneTalleCalzado" value="true" hidden>
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Si no lo es --}}
                                        <div class="w-fit my-2 mx-3">
                                            <div class="flex items-center">
                                                <button type="button" class="decrement bg-gray-200 px-3 py-1 rounded-l hover:bg-gray-300">-</button>

                                                <input type="number" id="cantidad" name="cantidad" value="1" min="1" max="{{ $resultado->stock }}" class="text-center w-12 border border-gray-300 h-10 mx-1" style="width: 50px;" />

                                                <button type="button" class="increment bg-gray-200 px-3 py-1 rounded-r hover:bg-gray-300">+</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex space-x-4 mb-6 text-sm font-medium ">
                                        <div class="flex-auto flex space-x-4">
                                            {{-- Invitado --}}
                                            @guest
                                                <!-- Botón para abrir el modal -->
                                                <a href=" {{ route('producto.show', $resultado->id) }} ">
                                                    <button type="button"  class="hover:scale-105 hover:shadow-xl h-10 px-6 font-semibold rounded-md bg-black text-white">
                                                        Detalles
                                                    </button>

                                                </a>

                                                <button data-bs-toggle="modal" data-bs-target="#miModal" type="button" class="hover:scale-105 hover:shadow-md hover:cursor-pointer w-max h-10 px-6 font-semibold rounded-md border border-slate-200 text-slate-900 ">
                                                    <a href="#" class="text-black no-underline">
                                                        Agregar al carrito
                                                    </a>
                                                </button>


                                                <!-- Modal - registrarse -->
                                                <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-xl" id="miModalLabel">Atención!</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Cerrar"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <!-- Contenido del modal -->

                                                                <p class="text-xl  ">Inicia sesión o regístrate para poder
                                                                    comprar o
                                                                    agregar al carrito</p>
                                                                <a class="btn btn-primary"
                                                                    href="{{ route('login') }}">Entrar</a>
                                                                <a class="btn btn-primary"
                                                                    href="{{ route('register') }}">Registrarse</a>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Logueado --}}
                                            @else
                                                <button class="hover:scale-105 hover:shadow-xl h-10 px-6 font-semibold rounded-md bg-black text-white" type="button" >
                                                    <a href="{{ route('producto.show', $resultado->id) }}" class="text-white no-underline">
                                                        Detalles
                                                    </a>
                                                </button>

                                                @csrf
                                                <input type="hidden" name="producto_id" value="{{ $resultado->id }}" class="producto_id">
                                                <input type="hidden" name="nombre" value="{{ $resultado->nombre }}" class="nombre">

                                                @if (isset($resultado->descuento) && $resultado->descuento->activo == true)
                                                    <input type="hidden" name="precio" value="{{ $resultado->precio - $resultado->descuento->plata_descuento }}" class="precio">
                                                @else
                                                    <input type="hidden" name="precio" value="{{ $resultado->precio }}" class="precio">
                                                @endif

                                                <input type="hidden" name="imagen" value="{{ $resultado->foto }}" class="imagen">
                                                
                                                <!-- Cambiado a visible para que el usuario pueda seleccionar la cantidad -->
                                                <button type="submit"
                                                    class="hover:scale-105 hover:shadow-md hover:cursor-pointer w-max h-10 px-6 font-semibold rounded-md border border-slate-200 text-slate-900 agregarAlCarrito">
                                                    Agregar al carrito
                                                </button>

                                            @endguest

                                        </div>
                                        <button class="hover:scale-105 hover:shadow-md hover:cursor-pointer flex-none flex items-center justify-center w-9 h-9 rounded-md text-slate-300 border border-slate-200" type="button" aria-label="Like">
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
                        </form>

                    </div>
                @endforeach
                @if ($contar_resultados < 1)
                    <p style="width:fit-content;  padding:10px; font-size:1.5em" class="uppercase font-semibold">
                        No se ha encontrado resultados de la búsqueda
                        <i class="fa-solid fa-ghost"></i>
                    </p>
                @endif
            </div>
          
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

            // Obtener el valor de la clase que indica si el producto tiene talle o no
            var tieneTalleCalzado = formulario.find('.tieneTalleCalzado').val();

            // Variable para almacenar el talle (si existe)
            var calzadoTalle = null;

            // Validar si se necesita seleccionar un talle para este producto
            if (tieneTalleCalzado === "true") {
                calzadoTalle = formulario.find('.calzadoTalle').val();

                if (!calzadoTalle || calzadoTalle == 0) {
                    alert('Por favor, elige un talle antes de agregar al carrito.');
                    return; // Detener la ejecución si no se seleccionó un talle
                }
            }

            // Obtener los valores de otros campos del formulario
            var productoId = formulario.find('.producto_id').val();
            var nombre = formulario.find('.nombre').val();
            var precio = formulario.find('.precio').val();
            var imagen = formulario.find('.imagen').val();
            var cantidad = formulario.find('#cantidad').val() ||
                1; // Si no se especifica cantidad, usar 1 por defecto
            var descuento = $('.descuento').val();

            // Hacer la solicitud AJAX
            $.ajax({
                url: "{{ route('carrito.añadir') }}", // Ruta a la que se envía la petición
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Asegúrate de enviar el token CSRF
                    producto_id: productoId,
                    nombre: nombre,
                    precio: precio,
                    imagen: imagen,
                    descuento: descuento,
                    cantidad: cantidad,
                    calzadoTalle: calzadoTalle // Incluir el talle en la petición si está disponible
                },
                success: function(response) {
                    // Mostrar un mensaje de éxito o actualizar la interfaz
                    alert(response.message);

                    // Actualizar la cantidad de productos en el carrito
                    $('#carrito-de-compras .badge').text(response.carrito.length);

                    // Actualizar el contenido del carrito (el dropdown)
                    let carritoContent = '';
                    response.carrito.forEach(function(item) {
                        const removeUrl = `/carrito/remove/${item.id}`;
                        carritoContent += `
                        <div class="flex h-fit m-1 mt-3 mx-3">
                            <div class="pb-2">
                                <img src="{{ url('producto/') }}/${item.imagen}" alt="" width="100px" height="100px">
                            </div>
                            <div>
                                <ul class="font-semibold">
                                    <li>${item.name}</li>
                                    <li>Precio: $${item.price.toLocaleString()}</li>
                                    ${item.calzadoTalle ? `<li>Talle: ${item.calzadoTalle}</li>` : ''} <!-- Mostrar solo si calzadoTalle tiene un valor -->

                                    <li>Cantidad: ${item.quantity}</li>
                                    ${item.talle ? `<li>Talle: n°${item.talle}</li>` : ''} <!-- Mostrar talle si está disponible -->
                                    <div class="mx-1 inline">
                                        <form action="${removeUrl}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-dark btn-sm" style="font-size: .67rem" type="submit">
                                                <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <hr>`;
                    });

                    if (response.carrito.length > 0) {
                        $('#carrito-de-compras .dropdown-menu').html(`
                        <div class="">
                            <h1 class="text-lg text-center shadow-sm  uppercase bg-slate-500  text-white hover:bg-black-600">Carrito de compras</h1>
                        </div>
                        ${carritoContent}
                        <div class="flex justify-center">
                            <a href="{{ route('carrito.index') }}" class="shadow-sm border-t no-underline bg-rose-500 text-white hover:bg-rose-600 p-1 px-3 rounded text-lg" style="display: block; text-align: center;">Entrar al carrito</a>
                        </div>
                    `);
                    } else {
                        $('#carrito-de-compras .dropdown-menu').html(
                            '<h1 class="text-lg text-center">El carrito está vacío</h1>');
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



        // Disponibilidad según stock
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener todos los contenedores de productos
            const productos = document.querySelectorAll('.contenedor-resultados > div');

            // Recorrer cada producto para aplicar los eventos individualmente
            productos.forEach(producto => {
                const inputCantidad = producto.querySelector('input[name="cantidad"]');
                const maxStock = parseInt(inputCantidad.getAttribute('max'));

                // Evento de input para ajustar el valor si excede el stock
                inputCantidad.addEventListener('input', function() {
                    if (this.value > maxStock) {
                        this.value = maxStock;
                    }
                });
            });
        });
        // Botón de incremento
        document.querySelectorAll('.increment').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                let value = parseInt(input.value);
                let max = parseInt(input.getAttribute('max'));

                if (value < max) {
                    input.value = value + 1;
                }
            });
        });

        // Botón para disminuir
        document.querySelectorAll('.decrement').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.nextElementSibling;
                let value = parseInt(input.value);
                let min = parseInt(input.getAttribute('min'));

                if (value > min) {
                    input.value = value - 1;
                }
            });
        });

        function eliminarProducto(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                fetch(`/eliminar/articulo/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remueve el producto de la vista
                        document.getElementById(`producto-${id}`).remove();
                    } else {
                        alert('Error al eliminar el producto');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

    </script>
@endsection
