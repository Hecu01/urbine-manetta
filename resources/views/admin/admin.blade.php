@extends('layouts.app')
@section('section-principal')


    {{-- @include('partials/admin/formulario1') --}}
    <div class="section-principal d-flex " style="justify-content: space-between;">
        <aside class="left-aside" id="left-aside">
            <div class="foto-local-y-admin">
                <div class="local">
                    <img src="{{ asset('assets/img/local.jpg')}}" alt="" style="width: 100%;">
                </div>
                <div id="foto-admin">
                    <img src="{{ asset('assets/img/mi-foto.jpg')}}" alt="foto de ..." >
                </div>
            </div>
            <div class="mas-informacion">
                <h3>TiendaFit</h3>
                <span><i class="fa-solid fa-location-dot"></i> Casa central</span><br>
                <span><i class="fa-solid fa-screwdriver-wrench"></i> Valentin Urbine</span>
            </div>
        </aside>
        <section class="row" style="padding-top: 5px; justify-content: center;">
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
                </div>
            </article>
            
            <!-- Sumplementos y dieta -->
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
                    <p>Sumplementos y dieta</p>
                </div>
            </article>
            
            
            <!-- Artículos deportivos -->
            <article class="article article4" onclick="alert('Te llevare a la tabla')">
                <div class="top">
                    <span>
                        <i class="fa-solid fa-football"></i>
                    </span>
                    <span class="recuento">
                        135
                    </span>
                </div>
                <div class="bottom">
                    <p>Artículos deportivos</p>
                </div>
            </article>
            
                        
            <!-- Ropa deportiva -->
            <article class="article article5" onclick="alert('Te llevare a la tabla')">
                <div class="top">
                    <span>
                        <i class="fa-solid fa-shirt"></i>
                    </span>
                    <span class="recuento">
                        13k
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
                        459
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
        <aside class="left-aside" id="right-aside">
            <div class="mas-informacion">
                <h3>Ultimas novedades</h3>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Hoy</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Semana</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Mes</button>
                    </li>

                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">...</div>
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
                  </div>
                <span><i class="fa-solid fa-location-dot"></i> Casa central</span><br>
                <span><i class="fa-solid fa-screwdriver-wrench"></i> Valentin Urbine</span>
            </div>
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