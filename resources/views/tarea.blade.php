<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto</title>
</head>
<body>
    <div>
        <div>
            <h2>Calendario Academico</h2>
        </div>
        <div>
            <h2>Inicio y finalizacion de cursada por cuatrimestres</h2>
            <a href="{{ route('calendario') }}">Calendario</a>
        </div>
    </div>
    <br>
    <div>
        <div>
            <h2>Carreras</h2>
        </div>
        <div>
            <h2>Ofertas Academica 2023</h2>
            <a href="{{ route('carreras') }}">Carreras</a>
        </div>
    </div>
</body>
</html>