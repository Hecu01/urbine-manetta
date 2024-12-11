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
                                        <form action="{{ route('compras.entregar', $compra->id) }}" method="POST" class="form-entregar" id="form-entregar-{{ $compra->id }}">
                                            @csrf
                                            <button type="button" class="btn btn-success mb-1" onclick="mostrarAlerta('entregar', {{ $compra->id }})">Entregar</button>
                                        </form>
                                        <form action="{{ route('compras.cancelar', $compra->id) }}" method="POST" class="form-cancelar" id="form-cancelar-{{ $compra->id }}">
                                            @csrf
                                            <button type="button" class="btn btn-danger" onclick="mostrarAlerta('cancelar', {{ $compra->id }})">Cancelar</button>
                                        </form>
                                        @else
                                            {{ in_array($compra->estado, ['Entregado', 'Cancelado']) ? $compra->updated_at->format('d/m/Y') : '-' }}
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

        function mostrarAlerta(accion, compraId) {
        // Definir el mensaje basado en la acción
        const mensaje = accion === 'entregar' ? 
            '¿Estás seguro de que deseas marcar esta compra como entregada?' : 
            '¿Estás seguro de que deseas cancelar esta compra?';

        // Crear la estructura de la alerta
        const overlay = document.createElement('div');
        overlay.classList.add('alerta-overlay');

        const alertaBox = document.createElement('div');
        alertaBox.classList.add('alerta-box');

        // Título de la alerta
        const titulo = document.createElement('h2');
        titulo.textContent = mensaje;
        alertaBox.appendChild(titulo);

        // Botones de confirmar y cancelar
        const botones = document.createElement('div');
        botones.classList.add('botones');

        const botonConfirmar = document.createElement('button');
        botonConfirmar.classList.add('boton', 'boton-confirmar');
        botonConfirmar.textContent = 'Confirmar';
        botonConfirmar.onclick = function() {
            // Enviar el formulario dependiendo de la acción
            if (accion === 'entregar') {
                document.getElementById('form-entregar-' + compraId).submit();
            } else if (accion === 'cancelar') {
                document.getElementById('form-cancelar-' + compraId).submit();
            }
            document.body.removeChild(overlay); // Cerrar la alerta
        };

        const botonCancelar = document.createElement('button');
        botonCancelar.classList.add('boton', 'boton-cancelar');
        botonCancelar.textContent = 'Cancelar';
        botonCancelar.onclick = function() {
            document.body.removeChild(overlay); // Cerrar la alerta sin hacer nada
        };

        botones.appendChild(botonConfirmar);
        botones.appendChild(botonCancelar);

        alertaBox.appendChild(botones);
        overlay.appendChild(alertaBox);
        document.body.appendChild(overlay);

        // Mostrar la alerta
        overlay.style.display = 'flex';
    }
    </script>


<style>
    /* Estilo para la alerta personalizada */
    .alerta-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    .alerta-box {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        max-width: 400px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .alerta-box h2 {
        font-size: 1.5em;
        margin-bottom: 20px;
    }
    .alerta-box .botones {
        display: flex;
        justify-content: center;
        gap: 20px;
    }
    .alerta-box .boton {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 1em;
        cursor: pointer;
    }
    .alerta-box .boton-confirmar {
        background-color: #28a745;
        color: white;
    }
    .alerta-box .boton-cancelar {
        background-color: #dc3545;
        color: white;
    }
</style>
@endsection
