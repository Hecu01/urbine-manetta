@extends('layouts.app')

@section('section-principal')
    <h1>Compras Realizadas</h1>

    {{-- Comprueba si el usuario es administrador --}}
    @if (Auth::user()->administrator)
        @if ($compras->isEmpty())
            <p style="text-align: center; font-size:16pt;">No se ha generado ninguna compra.</p>
        @else
            <div class="tabs mx-5">
                @foreach ($compras as $index => $compra)
                    <div class="tab" onclick="toggleTab(event, 'compra-{{ $compra->id }}')">
                        <table style="width: 100%; text-align: center;">
                            <thead>
                                <tr class="header-row">
                                    <th colspan="6">
                                        <div class="header-line">
                                            <span class="user"><span class="info">Usuario:</span>
                                                {{ $compra->user->name ?? 'N/A' }}
                                                {{ $compra->user->lastname ?? 'N/A' }}</span>
                                            <span class="address"><span class="info">Dirección:</span>
                                                {{ $compra->user->domicilio->calle ?? '' }},
                                                {{ $compra->user->domicilio->ciudad ?? '' }},
                                                {{ $compra->user->domicilio->provincia ?? '' }}</span>
                                        </div>
                                    </th>
                                    {{-- <th class="user-cell">Usuario: {{ $compra->user->name ?? 'N/A' }} {{ $compra->user->lastname ?? 'N/A' }}
                                    </th>
                                    <th class="address-cell">Dirección: {{ $compra->user->domicilio->calle ?? '' }},
                                        {{ $compra->user->domicilio->ciudad ?? '' }},
                                        {{ $compra->user->domicilio->provincia ?? '' }}</th> --}}
                                </tr>
                                <tr style="vertical-align: middle">
                                    <th>Nº de compra</th>
                                    <th>Total de la compra</th>
                                    <th>Fecha de la compra</th>
                                    <th>Estado</th>
                                    @if ($compra->estado == 'Pendiente')
                                        <th>Acción</th>
                                    @else
                                        <th>Fecha de engrega</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="vertical-align: middle">
                                    <td>{{ $compras->count() - $index }}</td>
                                    <!-- el count - index es para invertir el indice-->
                                    <td>${{ number_format($compra->total, 2) }}</td>
                                    <td>{{ $compra->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $compra->estado }}</td>
                                    <td>
                                        @if ($compra->estado == 'Pendiente')
                                            <form action="{{ route('compras.entregar', $compra->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success mb-1">Entregar</button>
                                            </form>
                                            <form action="{{ route('compras.cancelar', $compra->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Cancelar</button>
                                            </form>
                                        @else
                                            {{ in_array($compra->estado, ['Entregado', 'Cancelado']) ? $compra->updated_at->format('d/m/Y') : 'N/A' }}
                                            {{-- {{ $compra->estado == 'Entregado' ? $compra->updated_at->format('d/m/Y H:i') : 'N/A' }} --}}
                                        @endif
                                    </td>


                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <!-- Tabla de artículos de la compra -->
                    <div id="compra-{{ $compra->id }}" class="tab-content mx-40" style="display: none;">
                        <table style="width: 100%; text-align: center;">
                            <thead>
                                <tr>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($compra->articulos as $articulo)
                                    <tr>
                                        <td class="px-0">{{ $articulo->nombre }}</td>
                                        <td>{{ $articulo->pivot->cantidad }}</td>
                                        <td>${{ number_format($articulo->pivot->precio_unitario, 2) }}</td>
                                        <td>${{ number_format($articulo->pivot->cantidad * $articulo->pivot->precio_unitario, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
                {{-- Paginacion
                <div class="flex justify-center">

                    {{ $compras->links('pagination::bootstrap-4') }}
                </div> --}}
            </div>
        @endif
    @else
        {{-- Si el usuario no es admin --}}
        @if ($compras->isEmpty())
            <p style="text-align: center; font-size:16pt;">No has realizado ninguna compra.</p>
        @else
            <div class="tabs mx-5">
                @foreach ($compras as $index => $compra)
                    <div class="tab" onclick="toggleTab(event, 'compra-{{ $compra->id }}')">
                        <table style="width: 100%; text-align: center;">
                            <thead>
                                <tr style="vertical-align: middle">
                                    <th>Nº de compra</th>
                                    <th>Total de la compra</th>
                                    <th>Fecha de la compra</th>
                                    <th>Estado</th>
                                    <th>Fecha de entrega</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="vertical-align: middle">
                                    {{-- <td>{{ $index + 1 }}</td> --}}
                                    <td>{{ $compras->count() - $index }}</td>
                                    <td>${{ number_format($compra->total, 2) }}</td>
                                    <td>{{ $compra->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $compra->estado }}</td>
                                    <td>
                                        {{ in_array($compra->estado, ['Entregado', 'Cancelado']) ? $compra->updated_at->format('d/m/Y') : 'N/A' }}
                                        {{-- {{ in_array($compra->estado, ['Entregado', 'Cancelado']) ? $compra->updated_at->format('d/m/Y H:i') : 'N/A' }} --}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <!-- Tabla de artículos de la compra -->
                    <div id="compra-{{ $compra->id }}" class="tab-content mx-40" style="display: none;">
                        <table style="width: 100%; text-align: center;">
                            <thead>
                                <tr>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($compra->articulos as $articulo)
                                    <tr>
                                        <td class="px-0">{{ $articulo->nombre }}</td>
                                        <td>{{ $articulo->pivot->cantidad }}</td>
                                        <td>${{ number_format($articulo->pivot->precio_unitario, 2) }}</td>
                                        <td>${{ number_format($articulo->pivot->cantidad * $articulo->pivot->precio_unitario, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        @endif
    @endif

    <style>
        h1 {
            font-size: 26px;
            margin-top: 10px;
            margin-left: 15px;
            color: #333;
        }

        .tabs {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .tab {
            /* background-color: #f1f1f1;
                                            border: 1px solid #ccc; */
            cursor: pointer;
            margin: 5px 0;

            padding: 12px;
            background-color: #fafafa;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: background-color 0.2s;
        }

        .tab:hover {
            background-color: #f0f0f0;
        }

        table {
            width: 100%;
            text-align: center;
            border-collapse: collapse;
            max-width: 100%;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            width: auto;
        }

        th {
            font-weight: 600;
            color: #555;
            white-space: nowrap;
            /* Evita que el texto se rompa en varias líneas */
        }

        td {
            color: #444;
        }

        .tab-content {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            background-color: #86b7fe1f;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .header-line {
            display: flex;
            justify-content: space-between;
            /* border-bottom: 2px solid black; */
            padding-bottom: 5px;
        }

        .header-line .user,
        .header-line .address {
            flex: 1;
            text-align: center;
            font-size: 16px;
        }

        .info {
            color: #95a5a6;
            font-size: 18px;
            
        }
    </style>


    <script>
        function toggleTab(event, id) {
            console.log("Toggling tab for:", id); // Muestra el id que intenta abrir/cerrar
            const detailElement = document.getElementById(id);

            if (detailElement) {
                // Esto verifica si el elemento existe en el DOM
                console.log("Element found:", detailElement);

                // Alterna la visibilidad
                if (detailElement.style.display === "none" || detailElement.style.display === "") {
                    detailElement.style.display = "block";
                } else {
                    detailElement.style.display = "none";
                }
            } else {
                console.log("Element not found for ID:", id); // Informa si el elemento no está en el DOM
            }
        }
    </script>
@endsection
