@extends('layouts.app')
@section('section-principal')

    <div class="section-principal d-flex " style="justify-content: space-between;" id="seccion-recontraprincipal">
        @include('admin.layouts.aside-left')

        <section class="row" style="padding-top: 5px; justify-content: center;" >
            <!-- Clientes activos -->
            
            <a href="{{ route('clientes') }}" class="text-white no-underline article0 article1">
                <div class="top">
                    <span>
                        <i class="fa-solid fa-user-plus"></i>
                    </span>
                    <span class="recuento">
                        0
                    </span>
                </div>
                <div class="bottom">
                    <p>Clientes activos</p>
                </div>
            </a>
            <!-- Ventas realizadas -->
            <a href="{{ route('ventas-realizadas.index') }}" class="text-white no-underline article0 article2">
                <div class="top">
                    <span>
                        <i class="fa-solid fa-chart-line"></i>
                    </span>
                    <span class="recuento">
                        0
                    </span>
                </div>
                <div class="bottom">
                    <p>Ventas realizadas</p>
                </div>
            </a>
            
            <!-- Sumplementos y dieta -->
            <a href="{{ route('suplementos') }}" class="text-white no-underline article0 article3">
                <div class="top">
                    <span>
                        <i class="fa-solid fa-heart"></i>
                    </span>
                    <span class="recuento">
                        0
                    </span>
                </div>
                <div class="bottom">
                    <p>Sumplementos y dieta</p>
                </div>
            </a>
            
            
            <!-- Artículos deportivos -->
            <a href="{{ route('nuevo_articulo') }}" class="text-white no-underline article0 article4">
                <div class="top">
                    <span>
                        <i class="fa-solid fa-football"></i>
                    </span>
                    <span class="recuento">
                        {{ $artDeportivos }}
                    </span>
                </div>
                <div class="bottom">
                    <p>Artículos deportivos</p>
                </div>
            </a>
            
                        
            <!-- Ropa deportiva -->

            <a href="{{ route('nuevo_ropa') }}" class="text-white no-underline  article0 article5">
                <div class="top">
                    <span>
                        <i class="fa-solid fa-shirt"></i>
                    </span>
                    <span class="recuento">
                        {{ $ropaDeportivas }}
                    </span>
                </div>
                <div class="bottom">
                    <p>Ropa deportiva</p>
                </div>
            </a>

            
            <!-- Reposición de mercadería -->
            <a href="{{ route('mercaderia') }}" class="text-white no-underline article0 article6">

                <div class="top">
                    <span>
                        <i class="fa-solid fa-truck"></i>
                    </span>
                    <span class="recuento">
                        0
                    </span>
                </div>
                <div class="bottom">
                    <p>Pedidos para reponer mercadería</p>
                </div>
            </a>
            
                
            <a href="{{ route('compras_online') }}" class="text-white no-underline article0 bg-cyan-500">
                <div class="top">
                    <span>
                        <i class="fa-solid fa-coins"></i>
                    </span>
                    <span class="recuento">
                        0
                    </span>
                </div>
                <div class="bottom">
                    <p>Compras online pendiente

                        <br>
                        <span class="text-l">- Ya pagaron</span>
                    </p>
                </div>
            </a>
            
            <a href="{{ route('admins') }}" class="text-white no-underline article0 bg-purple-500 border-purple-500">
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
        </section>
        @include('admin.layouts.aside-right')
    </div>

   
    <style>
        .article0:hover{
            transform: scale(1.1);
        }
    </style>
    

@endsection
