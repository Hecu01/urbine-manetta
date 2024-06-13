@extends('layouts.app')

@section('section-principal')  
    <div class=""style="min-height:500px">
        <h1>Pagina descuento especial</h1>
        @if (session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                <strong>Atención!</strong> {{ session('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif 
        <div class="m-4 p-2" style="width: 500px; border: 1px solid rgb(0,0,0,0.2)">

            <form method="POST" action="{{ route('store-descuento-usuario') }}" enctype="multipart/form-data">
                @csrf
                <div class="row ">

                    <div class="container d-flex justify-content-center shadow-sm border-2 my-2" style="height: 250px;width:250px;  display:flex; justify-content: center;align-items:center;  background:#fff">
                        <!-- Carrusel para previsualizar imágenes -->
                        <div id="imagePreviewCarousel" class="carousel slide" data-bs-ride="carousel"  data-bs-interval="3000">
                            <div class="carousel-inner " id="imagePreviewInner"  style="height: 100%">
                                <!-- Las imágenes previsualizadas se mostrarán aquí -->
                            </div>

                        </div>
                    </div>
        
                </div>
                <div class="flex justify-center mb-3">
                    <label class="bg-blue-500 py-2 px-4 text-white hover:bg-blue-600" style="cursor: pointer" for="imageInput" >
                        <input type="file" name="foto" id="imageInput" multiple accept="image/*">
                        Cargar certificado
                    </label>
                </div>
                <div class="row mb-3">
                  <label for="profesion" class="col-sm-2 col-form-label">Profesion</label>
                  <div class="col-sm-10">
                    <select name="profesion" id="profesion" class="form-select">
                        <option value="Personal Trainer">Personal Trainer</option>
                        <option value="Profesor de Ed. Física">Profesor de Ed. Física</option>
                        <option value="Maestro Kickboxing">Maestro Kickboxing</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="motivo" class="col-sm-2 col-form-label">Motivo</label>
                  <div class="col-sm-10">
                    <textarea name="motivo" class="form-control" id="motivo" cols="30" placeholder="Explicá por qué te correspondería un descuento especial, explayate lo que necesites. " rows="3"></textarea>
                  </div>
                </div>
                
                <div class="row mb-3">
                  <div class="col-sm-10 offset-sm-2">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label" for="gridCheck1">
                        Acepto términos de contrato
                      </label>
                    </div>
                  </div>
                </div>
                <div class="grid mb-2">
                    
                    <button type="submit" class="btn btn-primary">Enviar Formulario</button>
                </div>
            </form>
        </div>
    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            // Manejar cambios en el campo de entrada de imágenes
            document.getElementById('imageInput').addEventListener('change', handleImagePreview);
        });

        function handleImagePreview(event) {
            // Limpiar el carrusel de previsualización
            document.getElementById('imagePreviewInner').innerHTML = '';

            // Obtener archivos seleccionados
            const files = event.target.files;

            // Mostrar previsualización de imágenes
            for (const file of files) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('d-block');
                    img.style.height= '250px';

                    const item = document.createElement('div');
                    item.classList.add('carousel-item');

                    // Marcar el primer elemento como activo
                    if (document.getElementById('imagePreviewInner').childElementCount === 0) {
                        item.classList.add('active');
                    }

                    item.appendChild(img);
                    document.getElementById('imagePreviewInner').appendChild(item);
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection