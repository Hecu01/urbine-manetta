@extends('admin.layouts.plantilla_admin')

@section('section-principal')
    <div class="" style="border-right: 2px solid rgb(0,0,0,0.3); margin-top:-5px; padding-right:10px">

        <div class="w-fit ">
            @include('admin.layouts.aside-left')
            <div class="flex justify-center mt-3">
                <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class=" bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
                    <i class="fa-solid fa-circle-arrow-left"></i> Atrás
                </a>
    
            </div>
        </div>
    </div>
 

    <div class="m-2" style="height: auto; display:flex; flex-direction:column; padding-bottom:20px" >
        <h3 class=" text-3xl text-center uppercase" style="font-weight: 600; margin-top: -5px ">Reposición de la mercaderia</h3>
        <div class="flex">

            <div class="">
                <article class="article0 bg-blue-500   px-2 hover:scale-105"  >
                    <a href="{{ route('solicitar-art-deport-index') }}" class="text-white no-underline">
                    <div class="top">
                        <span>
                            <i class="fa-solid fa-football"></i>
                        </span>
                        <span class="recuento">
                            <i class="fa-solid fa-up-long" style="font-size: 1em"></i>
                        </span>
                    </div>
                    <div class="bottom " style="font-size: 1.055em">
                        <p>Solicitar mercadería <br> Articulos deportivos</p>
                    </div>
                    </a>
                </article>
            </div>
            
            <div class="">
                <article class="article0 bg-cyan-500   px-2 hover:scale-105"  >
                    <a href="{{ route('solicitar-rop-deport-index') }}" class="text-white no-underline">
                    <div class="top">
                        <span>
                            <i class="fa-solid fa-shirt"></i>

                        </span>
                        <span class="recuento">
                            <i class="fa-solid fa-up-long" style="font-size: 1em"></i>
                        </span>
                    </div>
                    <div class="bottom " style="font-size: 1.055em">
                        <p>Solicitar mercadería <br> Ropa Deportiva</p>
                    </div>
                    </a>
                </article>
            </div>
            <div class="">
                <article class="article0 bg-green-500   px-2 hover:scale-105">
                    <a href="{{ route('solicitar-sup-diet-index') }}" class="text-white no-underline">
                    <div class="top">
                        <span>
                            <i class="fa-solid fa-heart"></i> 

                        </span>
                        <span class="recuento">
                            <i class="fa-solid fa-up-long" style="font-size: 1em"></i>
                        </span>
                    </div>
                    <div class="bottom " style="font-size: 1.055em">
                        <p>Solicitar mercadería <br> Suplementos y dieta</p>
                    </div>
                    </a>
                </article>
            </div>
        </div>
        



        <div class="flex">

            <div class="">
                <article class="article0 bg-blue-600   px-2 hover:scale-105"  >
                    <a href="{{ route('tablaArticulosDeportivos') }}" class="text-white no-underline">
                    <div class="top">
                        <span >
                            <i class="fa-solid fa-table mr-1"></i>
                            <i class="fa-solid fa-football" ></i>
                        </span>
                        <span class="recuento">
                            {{ $repPendArtDeport }}
                        </span>
                    </div>
                    <div class="bottom " style="font-size: 1.055em">
                        <p>Tabla de pedido <br> Articulos deportivos</p>
                    </div>
                    </a>
                </article>
            </div>
            
            <div class="">
                <article class="article0 bg-cyan-600 px-2 hover:scale-105">
                    <a href="{{ route('tablaRopasDeportivas') }}" class="text-white no-underline">
                    <div class="top">
                        <span>
                            <i class="fa-solid fa-table mr-1"></i>
                            <i class="fa-solid fa-shirt"></i>

                        </span>
                        <span class="recuento">
                            0
                        </span>
                    </div>
                    <div class="bottom " style="font-size: 1.055em">
                        <p>Tabla de pedido <br> Ropa Deportiva</p>
                    </div>
                    </a>
                </article>
            </div>
            <div class="">
                <article class="article0 bg-green-600 px-2 hover:scale-105" >
                    <a href="{{ route('tablaSupDieta') }}" class="text-white no-underline">
                    <div class="top">
                        <span>
                            <i class="fa-solid fa-table mr-1"></i>
                            <i class="fa-solid fa-heart"></i> 

                        </span>
                        <span class="recuento">
                            0
                        </span>
                    </div>
                    <div class="bottom " style="font-size: 1.055em">
                        <p>Tabla de pedido <br> Suplementos y dieta</p>
                    </div>
                    </a>
                </article>
            </div>
        </div>
    </div>

    <!-- card reponer mercaderias -->
    <div class="" style="border-left: 2px solid rgb(0,0,0,0.3); margin-top:-5px">
        
        <article class="article0 bg-yellow-500   px-2 hover:scale-105"  >
            <a href="{{ route('articulos-deportivos.index') }}" class="text-white no-underline">
            <div class="top">
                <span>
                    <i class="fa-solid fa-truck"></i>
                </span>
                <span class="recuento">
                    {{ $reposicionesPendientes }}
                </span>
            </div>
            <div class="bottom " style="font-size: 1.055em">
                <p>Reposición mercaderia <br> pendientes</p>
            </div>
            </a>
        </article>
    </div>
@endsection

