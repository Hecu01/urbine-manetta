@extends('admin.layouts.plantilla_admin')
@section('section-principal')

    @include('admin.layouts.aside-left')

    <section class="row" style="padding-top: 5px; justify-content: center;" >
        <!-- Clientes activos -->
        
        <a href="{{ route('clientes-activos.index') }}" class="text-white no-underline article0 article1">
            <div class="top">
                <span>
                    <i class="fa-solid fa-user-plus"></i>
                </span>
                <span class="recuento">
                    {{ $clientes }}
                </span>
            </div>
            <div class="bottom">
                <p>Clientes activos</p>
            </div>
        </a>
        <!-- Ventas realizadas -->
        <a href="{{ route('compras.index') }}" class="text-white no-underline article0 article2">
            <div class="top">
                <span>
                    <i class="fa-solid fa-chart-line"></i>
                </span>
                <span class="recuento">
                    {{ $comprasRealizadas }}
                </span>
            </div>
            <div class="bottom">
                <p>Compras de clientes</p>
            </div>
        </a>
        
        <!-- Sumplementos y dieta -->
        <a href="{{ route('suplementos-dieta.index') }}" class="text-white no-underline article0 article3">
            <div class="top">
                <span>
                    <i class="fa-solid fa-heart"></i>
                </span>
                <span class="recuento">
                    {{ $suplementos }}
                </span>
            </div>
            <div class="bottom">
                <p>Sumplementos deportivos</p>
            </div>
        </a>
        
        
        <!-- Artículos deportivos -->
        <a href="{{ route('articulos-deportivos.index') }}" class="text-white no-underline article0 article4">
            <div class="top">
                <span>
                    <i class="fa-solid fa-football"></i>
                </span>
                <span class="recuento">
                    {{ $articulos }}
                </span>
            </div>
            <div class="bottom">
                <p>Artículos deportivos</p>
            </div>
        </a>
        
                    
        <!-- Ropa deportiva -->

        <a href="{{ route('ropa-deportiva.index') }}" class="text-white no-underline  article0 article5">
            <div class="top">
                <span>
                    <i class="fa-solid fa-shirt"></i>
                </span>
                <span class="recuento">
                    {{ $ropas }}
                </span>
            </div>
            <div class="bottom">
                <p>Ropa deportiva</p>
            </div>
        </a>

        
        <!-- Reposición de mercadería -->
        <a href="{{ route('reposicion-mercaderia.index') }}" class="text-white no-underline article0 bg-yellow-500">

            <div class="top">
                <span>
                    <i class="fa-solid fa-truck"></i>
                </span>
                <span class="recuento">
                    {{ $reposicionesPendientes }}
                </span>
            </div>
            <div class="bottom">
                <p>Reposicion de mercadería</p>
            </div>
        </a>
        
            


        <!-- Subir publicidad -->
        <a href="{{ route('publicidad.index') }}" class="text-white no-underline article0 bg-purple-500">
            <div class="top">
                <span>
                    <i class="fa-solid fa-bullhorn"></i>
                </span>
            </div>
            <div class="bottom">
                <p>Subir Publicidad</p>
            </div>
        </a>
      
                
        <a href="{{ route('descuentos') }}" class="text-white no-underline article0 bg-red-500 border-red-500">
            <div class="top">
                <span class="mt-3 text-3xl">
                    OFF %
                </span>
                <span class="recuento">
                    {{ $descuentosActivos }}
                </span>
            </div>
            <div class="bottom">
                <p>Descuentos</p>
            </div>
        </a> 

        <a href="{{ route('AdminesActivos.index') }}" class="text-white no-underline article0 bg-slate-500 border-purple-500">
            <div class="top">
                <span>
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </span>
                <span class="recuento">
                    {{ $adminesActivos }}
                </span>
            </div>
            <div class="bottom">
                <p>Admins</p>
            </div>
        </a>

    </section>
    @include('admin.layouts.aside-right')

   
    <style>
        .article0:hover{
            transform: scale(1.1);
        }
    </style>

@endsection
