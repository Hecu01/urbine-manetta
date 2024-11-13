@extends('layouts.app')

@section('section-principal')
    <h1>Compras Realizadas</h1>

    @if ($compras->isEmpty())
        <p>No has realizado ninguna compra.</p>
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="vertical-align: middle">
                                <td>{{ $compra->id }}</td>
                                <td>${{ number_format($compra->total, 2) }}</td>
                                <td>{{ $compra->created_at->format('d/m/Y') }}</td>

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
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            font-weight: 600;
            color: #555;
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
