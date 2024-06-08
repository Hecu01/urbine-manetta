@extends('layouts.app')
@section('section-principal')

    <section class="section-bienvenida" >
    
        <div class="" style="height: 550px">
            <h1>Hola! {{ Auth::user() }}</h1>
            <h2>Bienvenido a sportivo</h2>
        </div>
        

    </section>


      

  
@endsection

