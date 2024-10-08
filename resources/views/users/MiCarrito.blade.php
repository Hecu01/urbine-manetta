@extends('layouts.app')

@section('section-principal')
<div class="bg-neutral-50 py-12">
    <div class="container mx-auto">
        <div class="flex flex-col gap-6 flex-row">
            <!-- Columna de items del carrito -->
            <div class="flex-1 flex flex-col gap-6">
                <h1 class="text-2xl font-bold shrink-0 rounded-sm border border-neutral-200 bg-white px-4 py-8 shadow-sm flex mb-0">Contenido del Carrito</h1>

                @foreach ($cartItems as $item)
                    <div class="shrink-0 rounded-sm border border-neutral-200 bg-white px-4 py-8 shadow-sm flex mt-0">
                        <img src="{{ url('producto/' . $item['imagen']) }}" alt="" width="70px" height="70px" class="mr-4">
                        <div>
                            <p>ID: {{ $item['id'] }}</p>
                            <p>Nombre: {{ $item['name'] }}</p>
                            <p>Precio: $ {{ number_format($item['price'], 0, ',', '.') }}</p>
                            <p>Cantidad: {{ $item['quantity'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Columna del total -->
            <div class="sticky space-y-4 rounded-sm border border-neutral-200 bg-white py-6 px-4 shadow-sm sm:px-6 md:w-1/3 md:ml-6">
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
                        <a href="{{asset('pagos')}}"
                            class="flex items-center justify-center rounded-md border border-transparent bg-neutral-800 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-neutral-900 no-underline">Pagar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
