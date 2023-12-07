@extends('layouts.app')
@section('section-principal')

    <div class="section-principal d-flex " style="justify-content: space-between;" id="seccion-recontraprincipal">
        @include('admin.layouts.aside-left')

        <section class="row" style="padding-top: 5px; justify-content: center;" >
            <!-- Clientes activos -->
            <article class="article0 article1" >
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
            </article>
            <!-- Clientes activos -->
            <article class="article0 article2" onclick="alert('Te llevare a la tabla')">
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
            </article>
            
            <!-- Sumplementos y dieta -->
            <article class="article0 article3" onclick="alert('Te llevare a la tabla')">
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
            </article>
            
            
            <!-- Artículos deportivos -->
            <article class="article0 article4"  id="redirigirBoton">
                <a href="{{ route('nuevo_articulo') }}" class="text-white no-underline">
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
            </article>
            
                        
            <!-- Ropa deportiva -->
            <article class="article0 article5" >

                <a href="{{ route('nuevo_ropa') }}" class="text-white no-underline">
                    <div class="top">
                        <span>
                            <i class="fa-solid fa-shirt"></i>
                        </span>
                        <span class="recuento">
                            0
                        </span>
                    </div>
                    <div class="bottom">
                        <p>Ropa deportiva</p>
                    </div>
                </a>

            </article>
            
            <!-- Productos dieteticos -->
            <article class="article0 article6" onclick="alert('Te llevare a la tabla')">
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
            </article>
            
                
            <!-- Artículos deportivos -->
            <article class="article0 bg-cyan-500" onclick="alert('Te llevare a la tabla')" >
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
            </article>
            <!-- Artículos deportivos -->
            <article class="article0 bg-purple-500 border-purple-500" onclick="alert('Te llevare a la tabla')" >
                <div class="top">
                    <span>
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </span>
                    <span class="recuento">
                        0
                    </span>
                </div>
                <div class="bottom">
                    <p>Admins</p>
                </div>
            </article>
            <!-- Artículos deportivos -->
            <article class="article0 bg-red-500 border-red-500" onclick="alert('Te llevare a la tabla')" >
                <div class="top">
                    <span class="mt-3 text-3xl">
                        OFF %
                    </span>
                    <span class="recuento">
                        0
                    </span>
                </div>
                <div class="bottom">
                    <p>Descuentos</p>
                </div>
            </article> 
        </section>
        @include('admin.layouts.aside-right')
    </div>

   
    <style>
        .article0:hover{
            transform: scale(1.1);
        }
    </style>
    

@endsection
