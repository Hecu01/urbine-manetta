@extends('layouts.app')

@section('section-principal')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif




    <div class="bg-neutral-50 py-12">
        <div class="container mx-auto">
            <div class="flex flex-col gap-6 flex-row">
                <!-- Columna de items del carrito -->
                <div class="flex-1 flex flex-col gap-6">
                    <h1 class="text-2xl font-bold shrink-0 rounded-sm border border-neutral-200 bg-white px-4 py-8 shadow-sm flex mb-0">
                        Contenido del Carrito
                    </h1>

                    @foreach ($cartItems as $item)
                        <div class="shrink-0 rounded-sm border border-neutral-200 bg-white px-4 py-8 shadow-sm flex mt-0">


                            {{-- Recuperar el artículo desde la base de datos usando el ID --}}
                            @php
                                $articulo = \App\Models\Articulo::find($item['id']);
                            @endphp

                            {{-- Verificar si el artículo existe y tiene fotos --}}

                            <div class="flex w-48 relative content-center">
  
                                <div id="carousel-{{ $articulo->id }}" class="carousel slide mr-5" data-bs-ride="carousel"  style="display:flex; align-items:center;width: 200px;">
                                    <div class="carousel-inner">
                                        @foreach($articulo->fotos as $index => $foto)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ url('productos/' . $foto->ruta) }}" alt="{{ $articulo->nombre }}" style="width: 200px; height: auto;">

                                            </div>
                                        @endforeach
                                    </div>
                        

                                </div>                                    
                            </div>
                        

                            <div>
                                <p><strong>ID</strong>: {{ $item['id'] }}</p>
                                <p><strong>Nombre</strong>: {{ $item['name'] }}</p>
                                <p>
                                    <strong>Precio</strong>: $ {{ number_format($item['price'], 0, ',', '.') }}
                                </p>
                                <p><strong>Cantidad</strong>: {{ $item['quantity'] }}</p>
                                @isset( $item['calzadoTalle'])
                                    <p><strong>Talle</strong>: {{ $item['calzadoTalle']  }}</p>
                                @endisset
                                <p>
                                    <strong>Total</strong>: $ {{ number_format($item['total_price'], 0, ',', '.')  }}
                                </p>

                                <div class="flex">
                                    <!-- Botón de Eliminar -->
                                    <div class="">
                                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                    <div class="mx-2">
                                        <a href="{{ route('producto.show', $item['id']) }}" class="btn btn-primary">Ver articulo</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Columna del total -->
                <div
                    class="sticky space-y-4 rounded-sm border border-neutral-200 bg-white py-6 px-4 shadow-sm sm:px-6 md:w-1/3 md:ml-6 h-fit">
                    <h4 class="text-2xl font-bold">Resumen de compra</h4>
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between text-base text-gray-900">
                            <p>Productos</p>
                            <p>$ {{ number_format($totalPrice, 0, ',', '.') }}</p>
                        </div>
                        <div class="my-2 w-full border-t border-gray-300"></div>
                        <div class="flex justify-between text-base font-bold text-gray-900">
                            <p>Total</p>
                            <p>$ {{ number_format($totalPrice, 0, ',', '.') }}</p>
                        </div>


                        <div class="mt-auto flex flex-col gap-2 pt-4">
                            @php
                                $carritoVacio = count($cartItems) === 0; // Verifica si el carrito está vacío
                            @endphp
                            {{-- <div class="mt-auto flex flex-col gap-2 pt-4"> --}}
                            {{-- <a href="{{asset('pagos')}}" --}}
                            {{-- class="flex items-center justify-center rounded-md border border-transparent bg-neutral-800 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-neutral-900 no-underline">Pagar</a> --}}
                            {{-- </div> --}}
                            <a href="{{ $carritoVacio ? '#' : asset('pagos') }}"
                                class="flex items-center justify-center rounded-md border border-transparent 
                            {{ $carritoVacio ? 'bg-gray-400 cursor-not-allowed' : 'bg-neutral-800 hover:bg-neutral-900' }} 
                            px-6 py-3 text-base font-medium text-white shadow-sm no-underline"
                                @if ($carritoVacio) onclick="return false;" @endif>
                                Pagar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
