@extends('layouts.app')

@section('section-principal')
    <h1>Compras Realizadas</h1>

    @if ($compras->isEmpty())
        <p>No has realizado ninguna compra.</p>
    @else
        <div class="tabs">
            @foreach ($compras as $index => $compra)
                <div class="tab" onclick="toggleTab(event, 'compra-{{ $compra->id }}')">
                    Compra ID: {{ $compra->id }} -> Total: ${{ number_format($compra->total, 2) }} -> Fecha: {{ $compra->created_at->format('d/m/Y') }}
                </div>
            @endforeach
        </div>

        <div class="tab-contents">
            @foreach ($compras as $compra)
                <div id="compra-{{ $compra->id }}" class="tab-content" style="display: none;">
                    <h3>Detalles de la Compra ID: {{ $compra->id }}</h3>
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #ccc; padding: 8px;">Nombre del Artículo</th>
                                <th style="border: 1px solid #ccc; padding: 8px;">Cantidad</th>
                                <th style="border: 1px solid #ccc; padding: 8px;">Precio Unitario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($compra->articulos as $articulo) {{-- Asegúrate de que la relación esté definida --}}
                                <tr>
                                    <td style="border: 1px solid #ccc; padding: 8px;">{{ $articulo->nombre }}</td>
                                    <td style="border: 1px solid #ccc; padding: 8px;">{{ $articulo->cantidad }}</td>
                                    <td style="border: 1px solid #ccc; padding: 8px;">${{ number_format($articulo->precio_unitario, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    @endif

    <style>
        .tabs {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px; /* Agrega un margen inferior */
        }
        .tab {
            padding: 10px;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            cursor: pointer;
            margin: 5px 0;
        }
        .tab-content {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 5px;
        }
    </style>

    <script>
        function toggleTab(event, tabId) {
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => {
                content.style.display = 'none'; // Ocultar todos los contenidos
            });

            const activeTabContent = document.getElementById(tabId);
            if (activeTabContent) {
                activeTabContent.style.display = 'block'; // Mostrar el contenido de la pestaña activa
            }
        }
    </script>
@endsection
