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
        <h3>Solicitar reposicion de mercaderia</h3>
        <a href="{{ route('solicitar-art-deport-index') }}" class="btn btn-primary ">Solicitar mercadería Articulos deportivos</a>
        <button class="btn btn-info my-2" disabled>Solicitar mercadería Ropa Deportiva</button>
        <button class="btn btn-success" disabled>Solicitar mercadería Suplementos deportivos</button>
        
        <h3 class="mt-3">Gestionar reposicion de merderia</h3>

        <button class="btn btn-primary " disabled>Tabla de pedido de Ropa deportiva</button>
        <button disabled class="btn btn-info my-2">Tabla de pedido de Articulos deportivos</button>
        <button class="btn btn-success" disabled>Tabla de pedidode Suplementos deportivos</button>
    </div>
    <div class="">
        <!-- Artículos deportivos -->
        <article class="article0 bg-yellow-500   px-2"  id="redirigirBoton">
            <a href="{{ route('articulos-deportivos.index') }}" class="text-white no-underline">
            <div class="top">
                <span>
                    <i class="fa-solid fa-truck"></i>
                </span>
                <span class="recuento">
                    6
                </span>
            </div>
            <div class="bottom">
                <p>Reposicino mercaderia <br> pendientes</p>
            </div>
            </a>
        </article>
    </div>
@endsection

