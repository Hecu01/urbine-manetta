@extends('layouts.app')
@section('section-principal')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/asked.css') }}">
    <title>Documentación</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            font-size: 2rem;
            color: #444;
            margin-bottom: 20px;
            text-align: center;
        }

        .container {
            max-width: 700px;
            margin: 20px auto;
            padding: 20px;
            /* background-color: #fff; */
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .section {
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            background-color: #fafafa;
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
        }

        .section:hover {
            background-color: #f0f0f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .section a {
            text-decoration: none;
            color: #555;
            font-size: 1.2rem;
            font-weight: 500;
        }

        .section a:hover {
            color: #333;
        }

        .toggle-list {
            font-size: 1.2rem;
            font-weight: 500;
            color: #555;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .collapsible-list {
            font-size: 1rem;
            color: #555;
            padding-left: 20px;
            display: none;
        }

        .collapsible-list li {
            margin-bottom: 8px;
        }

        .collapsible-list a {
            text-decoration: none;
            color: #555;
        }

        .collapsible-list a:hover {
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Documentación</h2>
        <div class="sections">
            <div class="section">
                <a href="{{ asset('manuales/Sportivo.pdf') }}" target="_blank">Presentación</a>
            </div>

            <div class="section">
                <a href="{{ asset('manuales/estructura.pdf') }}" target="_blank">Estructura</a>
            </div>

            <div class="section">
                <div class="toggle-list">UML</div>
                <ol class="collapsible-list">
                    <li><a href="{{ asset('manuales/clase.drawio.svg') }}" target="_blank">Diagrama de clase</a></li>
                    <li><a href="{{ asset('manuales/caso-de-uso.drawio.svg') }}" target="_blank">Diagrama de uso</a></li>
                    <li><a href="{{ asset('manuales/colaboracion-admin.drawio.svg') }}" target="_blank">Diagrama de colaboración - admin</a></li>
                    <li><a href="{{ asset('manuales/colaboracion-usuario.drawio.svg') }}" target="_blank">Diagrama de colaboración - usuario</a></li>
                    <li><a href="{{ asset('manuales/secuencia-admin.drawio.svg') }}" target="_blank">Diagrama de secuencia - admin</a></li>
                    <li><a href="{{ asset('manuales/secuencia-usuario.drawio.svg') }}" target="_blank">Diagrama de secuencia - usuario</a></li>
                    <li><a href="{{ asset('manuales/secuencia-iniciosesion.drawio.svg') }}" target="_blank">Diagrama de secuencia - inicio de sesión</a></li>
                </ol>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggles = document.querySelectorAll('.toggle-list');

            toggles.forEach(toggle => {
                toggle.addEventListener('click', function () {
                    const list = this.nextElementSibling;

                    list.style.display = list.style.display === 'none' || list.style.display === '' 
                        ? 'block' 
                        : 'none';
                });
            });
        });
    </script>
</body>

</html>
@endsection
