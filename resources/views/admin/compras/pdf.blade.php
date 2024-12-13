<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sportivo PDF</title>
</head>
<body>
    <style>
        #nombre-empresa{
            font-family: 'consolas';
            position: absolute; 
            margin-top: -10px; 
            margin-left: 10px;
            font-size:2em; 
            font-weight: 600;
        }
        #no-valido{
            border: 1px solid #000; 
            padding: 2px 5px;
            font-size:2em;
            position: absolute;
            right: 160px;
            top: -40px;
        }
        .text-no-valido{
            position: absolute;
            width: 150px;
            right: 0px;
            top:-55px;
            font-size: 1.1em
        }
        .products tr th, .products tr td{
            font-size:1.3em;
            text-align: center;
            border: 1px solid #000
        }
        h4 {
            margin: 0;
        }
        .w-full {
            width: 100%;
        }
        .w-half {
            width: 50%;
        }
        .margin-top {
            margin-top: 1.25rem;
        }
        .footer {
            font-size: 0.875rem;
            padding: 1rem;
            background-color: rgb(241 245 249);
        }
        table {
            width: 100%;
            border-spacing: 0;
        }
        table.products {
            font-size: 0.875rem;
        }
        table.products tr {
            background-color: rgb(96 165 250);
        }
        table.products th {
            color: #ffffff;
            padding: 0.5rem;
        }
        table tr.items {
            background-color: rgb(241 245 249);
        }
        table tr.items td {
            padding: 0.5rem;
        }
        .total {
            text-align: right;
            margin-top: 1rem;
            font-size: 0.875rem;
        }
    </style>

    <div>

        <table class="w-full">
            <tr>
                <td >
                    <div class="" style="position:relative">
                        <img src="{{ public_path('assets/img/logo.jpg') }}" width="100px">
                        
                        <span id="nombre-empresa">Macetas de cemento <br>VALCEL</span>
                    </div>
                
                </td>

                <td >
                    <div class="" style="position:relative">
                        <span id="no-valido">X</span>
                        <p class="text-no-valido" >Documento no válido como factura</p>
                    </div>

                </td>
            </tr>
        </table>
        <hr>
        <h2>Operación ID: {{ $compra->id }}</h2>
    </div>

 
    <div class="margin-top">
        <table class="w-full table table-bordered">
            <tr style="font-size:1.1em;">
                <td class="w-half" >
                    <div><h4>Para:</h4></div>
                    <div><strong>Cliente</strong> {{ $compra->user->name }}</div>
                    <div>
                        {{-- {{ $compra->user->domicilios->ciudad }} --}}
                        Ciudad cliente
                    </div>
                </td>
                <td class="w-half" >
                    <div><h4>De:</h4></div>
                    <div>Valentin Urbine</div>
                    <div>San Nicolás</div>
                </td>
                <td class="w-half" style="width: 170px;">
                    <div><h4>Detalle:</h4></div>
                    <div>Fecha: {{ $compra->fecha->format('d/m/Y') }}</div>
                    <div>San Nicolás</div>
                </td>
            </tr>
        </table>
    </div>
 
    <div class="margin-top">
        <table class="products" id="tabla">
            <tr>
                <th>ID</th>
                <th>Articulo</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Precio sumado</th>
            </tr>
            @foreach($detalleVenta->articulos as $articulo)
                <tr class="items">
                    <td>#{{ $articulo->id }}</td>
                    <td>Maceta {{ $articulo->nombre }}</td>
                    <td>{{ $articulo->pivot->cantidad }}</td>
                    <td>$ {{  number_format($articulo->pivot->precio_unitario, 0, ',', '.') }}</td>
                    <td>$ {{ number_format($articulo->pivot->precio_unitario * $articulo->pivot->cantidad, 0, ',', '.') }}</td>
                    
                </tr>
            @endforeach
        </table>
    </div>
 
    <div class="total" style="font-size: 1.4em; font-weight:600">
        Total: $ {{ number_format($compra->total, 0, ',', '.') }} ARS
    </div>
 
    <div class="footer margin-top">
        <div>Muchas gracias</div>
        <div>&copy; Macetas Valcel</div>
    </div>
    <hr>
    <p style="color:grey; text-align:justify">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi dolore corporis quisquam facere? Fugit, repellendus expedita perspiciatis nostrum eius inventore deserunt quod, facilis dolorum animi saepe quia sit voluptatum, velit nemo laborum? Quisquam, reiciendis vero! Beatae libero quaerat perspiciatis iusto, rem optio. Ex, ducimus iure!
    </p>
</body>
</html>