@extends('layouts.app')
@section('section-principal')
    {{-- @include('partials/admin/formulario1') --}}

    <div class="section-principal d-flex " style="justify-content: space-between;">
        <aside class="left-aside">
            <h5>TiendaFit</h5>
        </aside>
        <section class="row " style="padding-top: 5px; justify-content:center">
            <!-- Clientes activos -->
            <article class="article" onclick="alert('Te llevare a la tabla')">
                <div class="top">
                    <span>
                        <i class="fa-solid fa-user-plus"></i>
                    </span>
                    <span class="recuento">
                        56k
                    </span>
                </div>
                <div class="bottom">
                    <p>Clientes activos</p>
                    <a href="#" class="button-gestionar">Gestionar</a>
                </div>
            </article>
            
            <!-- Clientes activos -->
            <article class="article article2" onclick="alert('Te llevare a la tabla')">
                <div class="top">
                    <span>
                        <i class="fa-solid fa-chart-line"></i>
                    </span>
                    <span class="recuento">
                        325k
                    </span>
                </div>
                <div class="bottom">
                    <p>Ventas realizadas</p>
                    <a href="#" class="button-gestionar">Gestionar</a>
                </div>
            </article>
            
            <!-- Productos dieteticos -->
            <article class="article article3" onclick="alert('Te llevare a la tabla')">
                <div class="top">
                    <span>
                        <i class="fa-solid fa-heart"></i>
                    </span>
                    <span class="recuento">
                        325k
                    </span>
                </div>
                <div class="bottom">
                    <p>Stock: sumplementos y dieta</p>
                    <a href="#" class="button-gestionar">Gestionar</a>
                </div>
            </article>
            
            <!-- Artículos deportivos -->
            <article class="article article3" onclick="alert('Te llevare a la tabla')">
                <div class="top">
                    <span>
                        <i class="fa-solid fa-heart"></i>
                    </span>
                    <span class="recuento">
                        325k
                    </span>
                </div>
                <div class="bottom">
                    <p>Stock: sumplementos y dieta</p>
                    <a href="#" class="button-gestionar">Gestionar</a>
                </div>
            </article>


            
            
            
        </section>
        <aside class="left-aside" style="margin-left: 30px;">
            <h5>TiendaFit</h5>
        </aside>
    </div>
    <script>
        // mostrar imagen en el form
        function previewImage(event, querySelector){
    
        //Recuperamos el input que desencadeno la acción
        const input = event.target;
    
        //Recuperamos la etiqueta img donde cargaremos la imagen
        $imgPreview = document.querySelector(querySelector);
    
        // Verificamos si existe una imagen seleccionada
        if(!input.files.length) return
    
        //Recuperamos el archivo subido
        file = input.files[0];
    
        //Creamos la url
        objectURL = URL.createObjectURL(file);
    
        //Modificamos el atributo src de la etiqueta img
        $imgPreview.src = objectURL;
                
        }
    </script>


@endsection