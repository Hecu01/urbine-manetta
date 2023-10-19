@extends('layouts.app')
@section('section-principal')

    <div class="section-principal d-flex " style="justify-content: space-between;" id="seccion-recontraprincipal">
        @include('admin.layouts.aside-left')

        <section class="row" style="padding-top: 5px; justify-content: center;" >
            <!-- Clientes activos -->
            <article class="article" >
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
            <article class="article article2" onclick="alert('Te llevare a la tabla')">
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
            <article class="article article3" onclick="alert('Te llevare a la tabla')">
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
            <article class="article article4"  id="redirigirBoton">
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
            <article class="article article5" onclick="alert('Te llevare a la tabla')">
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
            </article>
            
            <!-- Productos dieteticos -->
            <article class="article article6" onclick="alert('Te llevare a la tabla')">
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
            <article class="article not-defined" onclick="alert('Te llevare a la tabla')" >
                <div class="top">
                    <span>
                        <i class="fa-solid fa-question"></i>
                    </span>
                    <span class="recuento">
                        0
                    </span>
                </div>
                <div class="bottom">
                    <p>Compras online pendiente</p>
                </div>
            </article>
            <!-- Artículos deportivos -->
            <article class="article not-defined" onclick="alert('Te llevare a la tabla')" >
                <div class="top">
                    <span>
                        <i class="fa-solid fa-question"></i>
                    </span>
                    <span class="recuento">
                        0
                    </span>
                </div>
                <div class="bottom">
                    <p>Lorem, ipsum dolor.</p>
                </div>
            </article>
            <!-- Artículos deportivos -->
            <article class="article not-defined" onclick="alert('Te llevare a la tabla')" >
                <div class="top">
                    <span>
                        <i class="fa-solid fa-question"></i>
                    </span>
                    <span class="recuento">
                        0
                    </span>
                </div>
                <div class="bottom">
                    <p>Lorem, ipsum dolor.</p>
                </div>
            </article> 
        </section>
        @include('admin.layouts.aside-right')
    </div>

   
    
    

@endsection
