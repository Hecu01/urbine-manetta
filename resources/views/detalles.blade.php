@extends('layouts.app')
@section('section-principal')
    <div class=" section" style="padding: 10px">
        <div class="container">

            <div class=""  style="display: flex;">
                <div class=""  style="background: white; width:min-content; ">
                    <img src="{{ url('producto/' . $elemento->foto) }}" class="card-img-top" alt="..." style="width: 300px" >
                </div>
                <div class="" style="background: white;  margin:0px 10px; width:850px;">
    
                    <h1 >{{ $elemento->nombre}}</h1>
                    <p >Disponibles: {{ $elemento->stock}} </p>
                    <p >Precio: ${{number_format($elemento->precio, 0, ',', '.')}} </p>

        
                </div>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">volver</a>
        </div>
    </div>
@endsection