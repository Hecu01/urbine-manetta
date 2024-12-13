@extends('admin.layouts.plantilla_admin')

@section('section-principal')

    <div class="w-fit mb-5">
        @include('admin.layouts.aside-left')
        <div class="flex justify-center mt-3">

            @php
                $articulo = $reposicion->articulos->first();
                $id_categoria = $articulo ? $articulo->id_categoria : null;
            @endphp
            @switch($id_categoria)
                @case(1)
                    <a href="{{ route('tablaArticulosDeportivos') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
                        <i class="fa-solid fa-circle-arrow-left"></i> Atrás
                    </a>
                    @break
                @case(2)
                    <a href="{{ route('tablaRopasDeportivas') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
                        <i class="fa-solid fa-circle-arrow-left"></i> Atrás
                    </a>
                    @break
                @case(3)
                    <a href="{{ route('tablaSupDieta') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
                        <i class="fa-solid fa-circle-arrow-left"></i> Atrás
                    </a>
                    @break
                @default
                    
            @endswitch
        </div>
    </div>
    <div class="">
        
        @if (session('success'))
            @include('admin.partials.MsjDelSistema.ArtAgregConExito') 
        @endif 
        <h1>Verificacion de la reposicion ID: {{$reposicion->id}} </h1>
        

        {{-- categoria_id 2 --}}
        <div class="flex justify-between">
            <form action="{{ route('articulos.aceptar', $reposicion->id) }}" method="POST">
                @csrf
                @method('PUT')
                <table class="table table-bordered" style="min-width: 350px">
                    <thead class="text-center">
                        <td>Talle </td>
                        <td>Solicitados</td>
                        <td>Llegaron</td>
                    </thead>
                    <tbody>
                        @foreach ($reposicion->articulos as $articulo)
                            @php
                                $foto = $articulo->fotos->first()->ruta;
                                $nombre = $articulo->nombre;
                            @endphp
                            <tr class="text-center"> 
                                <td> {{ $articulo->pivot->valor_calzado_talle }} </td>
                                <td> {{ $articulo->pivot->cantidad }} </td>
                                <td class="flex justify-center">
                                    <div class="">
                                        <input type="number" oninput="validar(this);" min="0" max="{{ $articulo->pivot->cantidad }}" value="{{ $articulo->pivot->cantidad }}" class="form-control" name="cantidadRecibida[]" style="width:50px">
                                        
                                        <input type="hidden"  name="tipo_producto" value="ropa">
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
        
                </table>
                <div class="flex justify-between">
                    <div class="">
                        <button type="submit" class="btn btn-success">Verificar</button>
                    </div>
                    <div>
                        <h3 class="flex">
                            Llegaron: 
                            <div id="cantidad-llegada" class="mx-1">...</div>
                            unidades
                        </h3> 
                    </div>
                </div>
            </form>
            <div class=""style="max-width:130px">
                <img src="{{ url('productos/'. $foto) }}" alt="{{ $nombre }}" draggable="false">
                <p>{{$nombre}}</p>
            </div>
        </div>

        

        {{-- @switch($articulos->tipo_producto)
            @case('calzado')
                <div class="flex justify-between">
                    <ul>
                        <li><strong>Usuario ID: </strong>{{ $articulos->id }}</li>
                        <li><strong>Nombre: </strong>{{ $articulos->nombre }}</li>
                        <li><strong>Stock: </strong>{{ $articulos->stock }}</li>
                    </ul>

                </div>
                <form method="POST" action="{{ route('reponer_mercaderia', $articulos->id) }}" class="p-1">
                    @csrf
                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="id_categoria" style="width:70px" value="{{ $articulos->id_categoria }}" hidden>

                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="id_articulo" style="width:70px" value="{{ $articulos->id }}" hidden>

                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="tipo_producto" style="width:70px" value="calzado" hidden>
                    


                    <div class="" style="overflow-y :scroll; max-height:250px; padding-right:10px">

                        @foreach ($calzados as $calzado)
                            @php
                                $calzadoAsociado = $articulos->calzados->firstWhere('pivot.calzado_id',$calzado->id);
                            @endphp
    
                            @if ($calzadoAsociado)
                                <div class="flex" style="width: 100%; ">
    
                                    <input type="hidden" name="art_id_muchos_a_muchos[]" value="{{ $calzadoAsociado->id }}">
                                    <input type="hidden" name="valorCalzadoTalle[]" value="{{ $calzadoAsociado->t }}">
                                    <input type="hidden" name="muchos_a_muchos_bool" value="true">
                                    
                                    <table class="table table-bordered text-center">
                                        <thead class="font-semibold uppercase">
                                            <td>Talle</td>
                                            <td>Disponibles</td>
                                            <td>solicitar</td>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td >
                                                    {{ $calzadoAsociado->calzado }}
                                                </td>
                                                <td >
                                                    <div class="flex justify-center">

                                                        <input type="text" disabled id="stock-{{ $calzadoAsociado->id }}" class="text-center form-control text-small my-1 input-suma p-0 px-2" style="width:50px;height:28px;" value="{{ $calzadoAsociado->pivot->stocks }}">
                                                    </div>
                                                    
                                                </td>
    
                                                <td style="">
                                                    <div class="flex justify-center">

                                                        <input type="text" name="stock_solicitado_muchos_a_muchos[]"  id="stock-{{ $calzadoAsociado->id }}" class="border-1 form-control border-cyan-600/[0.5] text-small my-1 input-suma p-0 px-2" style="width:50px;height:28px;" >
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
    
                                
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="mb-5 mt-1">

                        @if($reposicionPendiente)
                            <button class="btn btn-success btn-lg mt-2" type="submit" disabled>Encargado</button>
                            <div class="d-grid mt-4">
                                <a class="btn btn-primary" href="{{ route('tablaArticulosDeportivos') }}">TABLA DE PEDIDOS</a>
                            </div>
                        @else
                            <button class="btn btn-success btn-lg mt-2" type="submit">Encargar</button>
                        @endif
                    </div>

                </form>
                @break


           
            @case($articulos->id_categoria == 2) 
                <div class="flex justify-between">
                    <ul>
                        <li><strong>Usuario ID: </strong>{{ $articulos->id }}</li>
                        <li><strong>Nombre: </strong>{{ $articulos->nombre }}</li>
                        <li><strong>Stock: </strong>{{ $articulos->stock }}</li>
                    </ul>

                </div>
                <form method="POST" action="{{ route('reponer_mercaderia', $articulos->id) }}" class="p-1">
                    @csrf
                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="id_categoria" style="width:70px" value="{{ $articulos->id_categoria }}" hidden>

                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="id_articulo" style="width:70px" value="{{ $articulos->id }}" hidden>

                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" name="tipo_producto" style="width:70px" value="ropa" hidden>
                    <div class="" style="overflow-y :scroll; max-height:250px; padding-right:10px">

                        @foreach ($talles as $talle)
                            @php
                                $talleAsociado = $articulos->talles->firstWhere('pivot.talle_id',$talle->id);
                            @endphp
    
                            @if ($talleAsociado)
                                <div class="flex" style="width: 100%; ">
    
                                    <input type="hidden" name="art_id_muchos_a_muchos[]" value="{{ $talleAsociado->id }}">
                                    <input type="hidden" name="valorCalzadoTalle[]" value="{{ $talleAsociado->talle_ropa }}">
                                    <input type="hidden" name="muchos_a_muchos_bool" value="true">

                                    
                                    
                                    <table class="table table-bordered text-center">
                                        <thead class="font-semibold uppercase">
                                            <td>Talle</td>
                                            <td>Genero</td>
                                            <td>Disponibles</td>
                                            <td>solicitar</td>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td >
                                                    {{ $talleAsociado->talle_ropa }}
                                                </td>
                                                <td class="uppercase">
                                                    {{ $talleAsociado->genero }}
                                                </td>
                                                <td >
                                                    <div class="flex justify-center">

                                                        <input type="text" disabled id="stock-{{ $talleAsociado->id }}" class="text-center form-control text-small my-1 input-suma p-0 px-2" style="width:50px;height:28px;" value="{{ $talleAsociado->pivot->stocks }}">
                                                    </div>
                                                    
                                                </td>
    
                                                <td style="">
                                                    <div class="flex justify-center">

                                                        <input type="text" name="stock_solicitado_muchos_a_muchos[]"  id="stock-{{ $talleAsociado->id }}" class="border-1 form-control border-cyan-600/[0.5] text-small my-1 input-suma p-0 px-2" style="width:50px;height:28px;" >
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
    
                                
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="mb-5 mt-1">

                        @if($reposicionPendiente)
                            <button class="btn btn-success btn-lg mt-2" type="submit" disabled>Encargado</button>
                            <div class="d-grid mt-4">
                                <a class="btn btn-primary" href="{{ route('tablaRopasDeportivas') }}">TABLA DE PEDIDOS</a>
                            </div>
                        @else
                            <button class="btn btn-success btn-lg mt-2" type="submit">Encargar</button>
                        @endif
                    </div>
                </form>
                @break
            @default
                
        @endswitch --}}


    </div>

    <!-- card reponer mercaderias -->
    @include('admin.reponerMercaderia.partials.CardReposicion')
    

    <script>

        function validar(input) {
            // Obtener los valores mínimo y máximo del input
            const min = parseInt(input.min, 10); // 0
            const max = parseInt(input.max, 10); // $articulo->pivot->cantidad
            let value = input.value;

            // Eliminar ceros iniciales, excepto si el valor es "0"
            if (value.length > 1 && value.startsWith("0")) {
                value = value.replace(/^0+/, '');
            }

            // Convertir el valor a número entero
            const numericValue = parseInt(value, 10);

            // Validar que el valor sea un número válido
            if (isNaN(numericValue)) {
                input.value = min; // Si no es un número, asignar el valor mínimo
                actualizarSumatoria();

                return;
            }

            // Validar que el número esté dentro del rango permitido
            if (numericValue < min) {
                input.value = min; // Ajustar al mínimo si es menor
                actualizarSumatoria();

            } else if (numericValue > max) {
                input.value = max; // Ajustar al máximo si es mayor
            } else {
                input.value = numericValue; // Asignar el valor ajustado
            }
            
            // Actualizar la sumatoria
            actualizarSumatoria();
        }

        function actualizarSumatoria() {
            // Seleccionar todos los inputs con el nombre 'cantidadLlegada[]'
            const inputs = document.querySelectorAll('input[name="cantidadRecibida[]"]');
            let sumatoria = 0;

            // Recorrer los inputs y sumar sus valores numéricos
            inputs.forEach(input => {
                const value = parseInt(input.value, 10);
                if (!isNaN(value)) {
                    sumatoria += value;
                }
            });

            // Actualizar el contenido del div con la sumatoria
            document.getElementById('cantidad-llegada').textContent = sumatoria;
        }

        // Llamar a la sumatoria al cargar la página
        document.addEventListener('DOMContentLoaded', () => {
            actualizarSumatoria();
        });

    </script>

@endsection