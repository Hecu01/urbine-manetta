@extends('layouts.app')
@section('section-principal')

    @if (session('mensaje'))
        <!-- Modal -->
        <div class="modal fade  "id="art-agreg-con-exito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="header flex items-center justify-center">
                        <img src="{{ asset('assets/img/sportivo-logo.svg') }}" draggable="false" alt="Logo"
                            style="width:130px" class="mr-1 opacity-70">
                        <h2 class="mb-1 uppercase" style="font-size: 3em;">Sportivo</h2>
                    </div>
                    <div class="p-3 center text-center border-t" style="position: relative;">
                        <p class="mb-2" style="font-size: 2em;">¡{{ session('success') }}!</p>
                        <span>
                            <i class="fa-solid fa-circle-check text-[#22c55e]" style="font-size:2.5em"></i>
                        </span>
                    </div>




                </div>
            </div>
        </div>
    @endif

    <form class='container-1 ' method="POST" action="{{ route('carrito.añadir2') }}">
        {{-- @if (Auth::user()->administrator)
            <div class="position-absolute right-1 rounded-full flex m-1">
                <div class="hover:scale-125 mr-1.5">

                    <a href="{{ route('articulos-deportivos.edit', $articulo->id) }}"
                        class="btn-success p-1 px-2 rounded-full border-3 border-white shadow-sm hover:shadow-lg hover:mr-1 no-underline"
                        title="Editar producto: ID {{ $articulo->id }}">Editar <i
                            class="fa-solid fa-pen"></i></a>
                </div>
                <div class="hover:scale-125">
                    {{-- <button class="btn btn-danger btn-sm eliminar-btn mx-1" data-id="{{ $resultado->id }}" data-bs-toggle="modal" data-bs-target="#modalEliminar">Eliminar <i class="fa-solid fa-trash"></i></button> --}}
        {{-- <a href=""
                        class="btn-danger p-1 px-2 rounded-full border-3 hover:ml-1 border-white shadow-sm hover:shadow-lg no-underline"
                        title="Eliminar producto: ID {{ $articulo->id }}">Eliminar <i
                            class="fa-solid fa-trash"></i></a> --}}


        {{-- <div class="articulo" data-id="{{ $resultado->id }}">
                            <button class="btn btn-danger eliminar-btn"
                                onclick="eliminarArticulo({{ $resultado->id }})">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </div> --}}

        {{-- </div>
            </div>
        @endif --}}
        <div class='highlight-window py-5' id='product-img'>
            <div class='highlight-overlay' id='highlight-overlay'>
                <div class="flex  relative content-center" style="z-index: 13">

                    <div id="carousel-{{ $articulo->id }}" class="carousel slide" data-bs-ride="carousel"
                        style="background: rgba(0, 0, 0, 0.404); display:flex; align-items:center;width: 300px;z-index:13">

                        <div class="carousel-inner">
                            @foreach ($articulo->fotos as $index => $foto)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img 
                                src="{{ url('productos/' . $foto->ruta) }}" 
                                alt="{{ $articulo->nombre }}" 
                                class="carousel-image"
                                style="width: 300px; height: auto; cursor: pointer;"
                                data-bs-toggle="modal" 
                                data-bs-target="#imageModal" 
                                data-image="{{ url('productos/' . $foto->ruta) }}">

                                </div>
                            @endforeach
                        </div>

                        <!-- Controles del carrusel -->

                        <button class="carousel-control-prev"
                            style="margin-top: 40vh;height: 50px;background:black; margin-left: -47px" type="button"
                            data-bs-target="#carousel-{{ $articulo->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            style="margin-top: 40vh;height: 50px;background:black; margin-right: -47px"
                            data-bs-target="#carousel-{{ $articulo->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para la imagen ampliada -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body">
                <img id="modalZoomImage" src="" alt="Zoom Image" class="img-fluid" style="cursor: zoom-in;">
            </div>
        </div>
    </div>
</div>
        <div class='window'>
            <div class='main-content'>
                <h2 class="uppercase">{{ $articulo->nombre }}</h2>
                <h1 class="uppercase">{{ $articulo->genero }}</h1>
                <h3 class="uppercase">Marca: {{ $articulo->marca }}</h3>
                <div class='description' id='description'>

                    {{ $articulo->descripcion }}
                </div>

                <div class='options'>
                    <div class='color-options'>
                        Unidades:
                        {{-- <div class="col-5">
                            <button type="button" class="decrement bg-gray-200 px-3 py-1 rounded-l hover:bg-gray-300">-</button>
                            <input type="number" id="cantidad" class="form-control" min="1" max="{{ $articulo->stock }}"  value="1"  oninput="validarCantidad(this, {{ $articulo->stock }})" name="cantidad">
                            <button type="button" class="increment bg-gray-200 px-3 py-1 rounded-r hover:bg-gray-300">+</button>
                        </div> --}}
                        <div class="w-fit my-2 mx-3">
                            <div class="flex items-center">
                                <button type="button"
                                    class="decrement bg-gray-200 px-3 py-1 rounded-l hover:bg-gray-300">-</button>

                                <input type="number" id="cantidad" name="cantidad" value="1" min="1"
                                    max="{{ $articulo->stock }}" class="text-center w-12 border border-gray-300 h-10 mx-1"
                                    style="width: 50px;" />

                                <button type="button"
                                    class="increment bg-gray-200 px-3 py-1 rounded-r hover:bg-gray-300">+</button>
                            </div>
                        </div>

                        <span class="text-slate-500 text-sm">Disponible: {{ $articulo->stock }} </span>



                    </div>
                    @if($articulo->calzados->isNotEmpty() || $articulo->talles->isNotEmpty())
                        <div class='size-picker'>
                            Talle o Calzado:
                            <div class='range-picker' id='range-picker'>

                                {{-- Si es calzados: leerá éste --}}
                                @foreach ($articulo->calzados as $calzado)
                                    <div>

                                        <input type="radio" id="calzado_{{ $calzado->id }}" name="calzadoTalle_id"
                                            value="{{ $calzado->pivot->calzado_id }}" required style="display: none">
                                        <input type="radio" id="calzado_{{ $calzado->id }}" name="calzadoTalle"
                                            value="{{ $calzado->calzado }}" required style="display: none">
                                        <label for="calzado_{{ $calzado->id }}"
                                            style="background: none; border:none; transform:none">
                                            {{ $calzado->calzado }}
                                        </label>
                                    </div>
                                @endforeach

                                {{-- Si es ropa: leerá este otro --}}
                                @foreach ($articulo->talles as $talle)
                                    <div>
                                        <input type="radio" id="talle_{{ $talle->id }}" name="calzadoTalle"
                                            value="{{ $talle->talle_ropa }}" required style="display: none">
                                        <label for="talle_{{ $talle->id }}"
                                            style="background: none; border:none; transform:none">
                                            {{ $talle->talle_ropa }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            {{-- <a class='small align-right' href='#'>VIEW SIZE-CHART</a> --}}
                        </div>
                    @else
                    @endif
                </div>
                <div class='divider'></div>

                {{-- Token @CSRF --}}
                @csrf

                {{-- Valores cargados al carrito --}}
                <input type="hidden" name="producto_id" value="{{ $articulo->id }}" class="producto_id">
                <input type="hidden" name="nombre" value="{{ $articulo->nombre }}" class="nombre">

                {{-- ¿Tiene descuento? de ser así, carga el precio con descuento --}}
                @if (isset($resultado->descuento) && $resultado->descuento->activo == true)
                    <input type="hidden" name="precio"
                        value="{{ $articulo->precio - $articulo->descuento->plata_descuento }}" class="precio">
                @else
                    <input type="hidden" name="precio" value="{{ $articulo->precio }}" class="precio">
                @endif

                {{-- Carga la imagen --}}
                <input type="hidden" name="imagen" value="{{ $articulo->foto }}" class="imagen">

                <div class='purchase-info'>
                    <div class='price'>$ {{ number_format($articulo->precio, 0, ',', '.') }}</div>
                    <button type="submit" class="button">AÑADIR AL CARRO</button>
                </div>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/elevatezoom/jquery.elevatezoom.js"></script>
    <script>
        function validarCantidad(input, maxStock) {
            // Asegurarse de que el valor sea un número válido y no supere el stock disponible
            if (input.value < 1) {
                alert('Recuerde: Sólo se admite números (mayores a 0)');
                input.value = 1;
            } else if (input.value > maxStock) {
                input.value = maxStock;
            }
        }
        // 

        document.addEventListener('DOMContentLoaded', function() {
            var modal = new bootstrap.Modal(document.getElementById('art-agreg-con-exito'));
            modal.show();
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

        //Zoom imagen
        $(document).ready(function() {
        // Abrir el modal con la imagen seleccionada
        $('.carousel-image').on('click', function() {
            const imageUrl = $(this).data('image');
            const $modalZoomImage = $('#modalZoomImage');

            // Configurar la URL de la imagen
            $modalZoomImage.attr('src', imageUrl);

            // Asegurar el cursor del dedo señalando
            $modalZoomImage.css('cursor', 'pointer');

            // Limpiar cualquier zoom previo
            $modalZoomImage.removeData('elevateZoom').removeData('zoomImage');
            $('.zoomContainer').remove();

            // Deshabilitar zoom y permitir cierre al hacer clic en la imagen ampliada
            $modalZoomImage.off('click').on('click', function() {
                $('#imageModal').modal('hide'); // Cierra el modal
            });
        });

        // Limpiar configuraciones al cerrar el modal
        $('#imageModal').on('hidden.bs.modal', function() {
            const $modalZoomImage = $('#modalZoomImage');

            // Restablecer configuraciones de la imagen
            $modalZoomImage.removeData('elevateZoom').removeData('zoomImage');
            $('.zoomContainer').remove();
        });
    });
    </script>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Muli:400,300italic,300,400italic);

        h1,
        h2,
        h3 {
            margin: 0;
        }

        .container-1 {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            height: 100%;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            background: #999;
            padding: 20px 0px;
        }

        .window {
            background: #fff;
            width: 470px;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            min-height: 450px;
            position: relative;
            box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.2);
        }

        .options {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            margin-top: 25px;
            -webkit-box-pack: justify;
            -webkit-justify-content: space-between;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }

        .main-content {
            padding: 50px 46px 25px 20px;
            box-sizing: border-box;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            color: #222;
            width: 100%;
            height: 100%;
            -webkit-flex-flow: column;
            -ms-flex-flow: column;
            flex-flow: column;
        }

        h1 {
            letter-spacing: 0px;
            letter-spacing: .02rem;
            font-size: 48px;
            font-size: 3rem;
        }

        h3 {
            color: #666;
            font-size: 19px;
            font-size: 1.2rem;
        }

        .description {
            margin-top: 20px;
            width: 100%;
        }

        .highlight-window {
            height: 550px;
            width: 400px;
            background: #ccc;
            background-size: cover;
            box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.2);
            z-index: 1;
            position: relative;
            background-position: center top;
        }

        .color {
            height: 30px;
            cursor: pointer;
            width: 30px;
            background: #eee;
            border: 1px solid #eee;
            position: relative;
        }

        .highlight-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            -webkit-transition: opacity .4s ease;
            transition: opacity .4s ease;
            background-position: center top;
            display: flex;
            justify-content: center
        }

        .background-element {
            background: #457;
            position: absolute;
            width: 120%;
            height: 400px;
            left: -50px;
            top: -80px;
            -webkit-transform: rotate(-5deg);
            -ms-transform: rotate(-5deg);
            transform: rotate(-5deg);
            -webkit-transition: background .6s ease;
            transition: background .6s ease;
        }

        .color.overlay {
            position: absolute;
            z-index: 10;
            background: transparent;
            top: -1px;
            left: -1px;
            -webkit-transform: translateX(45px);
            -ms-transform: translateX(45px);
            transform: translateX(45px);
            border: 2px solid #fff;
            outline: 2px solid #ccc;
            -webkit-transition: -webkit-transform .3s ease;
            transition: transform .3s ease;
        }

        .color-a {
            background: #333;
            margin-right: 14px;
        }

        .color-b {
            background: #457;

        }

        .color-picker {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            width: 77px;
            margin-top: 5px;
            position: relative;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
            color: #666;
        }

        .button {
            background: #333;
            border: none;
            font-weight: 400;
            height: 40px;
            margin-top: auto;
            margin-bottom: auto;
            padding-left: 25px;
            padding-right: 25px;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            -webkit-transition: all .3s ease;
            transition: all .3s ease;
        }

        .button:hover {
            background: #555;
            -webkit-transition: all .3s ease;
            transition: all .3s ease;
        }

        .divider {
            width: 80%;
            height: 1px;
            background: #ddd;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
        }

        .color-options {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            width: 50%;
            -webkit-flex-flow: column;
            -ms-flex-flow: column;
            flex-flow: column;
        }

        .size-picker {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-flow: column;
            -ms-flex-flow: column;
            flex-flow: column;
        }

        .small {
            font-size: 11px;
            font-size: .7rem;
            color: #999;
            margin-top: 10px;
        }

        .align-right {
            -webkit-align-self: flex-end;
            -ms-flex-item-align: end;
            align-self: flex-end;
        }

        .size-desc {
            -webkit-align-self: flex-end;
            -ms-flex-item-align: end;
            align-self: flex-end;
        }

        .purchase-info {
            -webkit-box-pack: justify;
            -webkit-justify-content: space-between;
            -ms-flex-pack: justify;
            justify-content: space-between;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
        }

        .price {
            font-size: 40px;
            font-size: 2.5rem;
        }


        .selection {
            background: #fff;
        }

        .range-picker {
            font-size: 16px;
            font-size: 1rem;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            margin-top: 5px;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            line-height: .9em;
        }

        .range-picker div {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            border-right: 1px solid #bbb;
            border-top: 1px solid #bbb;
            border-bottom: 1px solid #bbb;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            color: #bbb;
            width: 30px;
            box-sizing: border-box;
            cursor: pointer;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
            height: 30px;
            -webkit-transition: background .5s ease;
            transition: background .5s ease;
        }

        .range-picker .active:hover {
            background: #fff;
        }

        .range-picker .active {
            -webkit-transform: scale(1.2);
            -ms-transform: scale(1.2);
            transform: scale(1.2);
            background: #fff;
            margin-right: 3px;
            margin-left: 2px;
            color: #333;
            border: 1px solid #666;
            z-index: 1;
        }

        .check {
            position: absolute;
            right: 0px;
            left: 0px;
            margin-left: auto;
            margin-right: auto;
            background: transparent;
            width: 0px;
            bottom: -3px;
            border-left: 10px solid transparent;
            border-bottom: 10px solid #ccc;
            border-right: 10px solid transparent;
            height: 0px;
        }

        .range-picker div:hover {
            background: #eee;
            -webkit-transition: background .2s;
            transition: background .2s;
        }

        .range-picker div:first-child {
            border-left: 1px solid #bbb;
        }

        .range-picker div.active:first-child {
            border-left: 1px solid #333;
        }
    </style>
@endsection
