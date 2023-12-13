@extends('layouts.app')

@section('section-principal')  
    <h1>Contenido del Carrito</h1>
    
    @foreach ($cartItems as $item)
        <div>
            <p>ID: {{ $item['id'] }}</p>
            <p>Nombre: {{ $item['name'] }}</p>
            <p>Precio: {{ $item['price'] }}</p>
            <p>Cantidad: {{ $item['quantity'] }}</p>
            <hr>
        </div>
    @endforeach
@endsection