@extends('layouts.app')
@section('section-principal')

    <div class="">
        {{-- <h1>hombres</h1> --}}
    </div>
    <div class="row" style="height: 550px; background:rgb(177, 145, 145);">
        @foreach ($articulo as $hombre)        
            <div class="card" style="width: 18rem;">
                <div class="" style="width: 200px; margin:auto">
                    <img src="{{ url('producto/' . $hombre->foto) }}" class="card-img-top" alt="..." > 
                </div>
                <div class="card-body">
                <h5 class="card-title">{{ $hombre->nombre}}</h5>
                <p class="card-text"> {{ $hombre->genero}} </p>
                <p class="card-text"> {{ $hombre->marca}} </p>
                <p class="card-text"> {{ $hombre->color}} </p>
                <p class="card-text"> {{ $hombre->stock}} </p>
                <p class="card-text"> {{ $hombre->precio}} </p>

                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        @endforeach 
    </div>
@endsection
