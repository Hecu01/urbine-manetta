@extends('admin.layouts.plantilla_admin')

@section('section-principal')

    <div class="w-fit ">
        @include('admin.layouts.aside-left')
        <div class="flex justify-center mt-3">
            <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class=" bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
                <i class="fa-solid fa-circle-arrow-left"></i> Atrás
            </a>

        </div>
    </div>
 

    <div class="m-2" style="height: 500px; display:flex; flex-direction:column">
        <a href="#" class="btn btn-primary">Solicitar mercadería Ropa Deportiva</a>
        <a href="{{ route('solicitar-art-deport-index') }}" class="btn btn-info my-2">Solicitar mercadería Art deportivos</a>
        <a href="#" class="btn btn-success">Solicitar mercadería Suplementos deportivos</a>
    </div>
    <div class="">
        <h1>aside</h1>
    </div>
@endsection

