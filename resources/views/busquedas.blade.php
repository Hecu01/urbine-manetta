@extends('layouts.app')
@section('section-principal')
    <div class="section">
    
        <div class="">
            {{-- <h1>hombres</h1> --}}
        </div>
        <div class="contenedor-resultados" >
            @foreach ($resultados as $resultado)     
                <div class="">
                    <div class="card resultado" style="width: 18rem; ">
                        <a href="" style="color: currentColor; text-decoration:none">
                            <div class="" style="width: 200px; margin:auto" >
                                <img src="{{ url('producto/' . $resultado->foto) }}" class="card-img-top" alt="..."  > 
                            </div>
                            <div class="card-body descripcion" style="border-top:1px solid #000">
                                <h5 class="card-text">{{ $resultado->nombre}}</h5>
                                <p class="card-text">Disponibles: {{ $resultado->stock}} </p>
                                <p class="card-text">Precio: $ {{number_format($resultado->precio, 0, ',', '.')}}  </p>
                            </div>
                        </a>                    
                        <div class=" d-flex justify-content-center   ">
    
                            @guest
                                <a href="#" class="btn btn-primary btn-sm my-1 mx-1" onclick="alert('Debes registrarte')">Agregar al carrito</a>
                            @else   
                                <a href="#" class="btn btn-primary btn-sm my-1 mx-1" onclick="alert('Agregado al carrito')">Agregar al carrito</a>
                            @endguest
                            
                            
                            <a href="{{ route('detalles', ['id' => $resultado->id]) }}" class="btn btn-secondary btn-sm my-1 mx-1">Detalles</a>
                        </div>
                    </div>
                </div>  
            @endforeach 
        </div>
    </div>
@endsection