@extends('layouts.app')
@section('section-principal')
    <main>

        <div class="w-fit">

            <div class="flex justify-center mt-3">
                <a href="{{ route('ir_admin') }}" id="boton-regresar-atras"
                    class="bg-cyan-500 m-1 mb-4 px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow"
                    style="font-size: 1.5em;">
                    <i class="fa-solid fa-circle-arrow-left"></i> Atrás
                </a>

            </div>

        </div>

        @if (session('mensaje'))
            @include('admin.partials.MsjDelSistema.ArtAgregConExito')
        @endif
        @if (session('eliminado'))
            @include('admin.partials.MsjDelSistema.ProductoEliminado')
        @endif

        <section class="mb-2 mx-3">
            <div class=" py-4 border-y-2">
                <h1 class="text-3xl font-bold text-center text-gray-800 tracking-wider mb-6 shadow-md shadow-black px-4 py-2 rounded-lg"
                    style="background-color: #06B6D4;">Publicidades</h1>

                <!-- Formulario para subir nueva publicidad -->
                <form class="row g-3 p-3" action="{{ route('publicidad.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex align-items-center mt-3">
                        <p class="mt-1 mr-3 text-base">Seleccione una imagen:</p>
                        <label
                            class="p-2 px-3 mb-2 text-white shadow-md shadow-black transition-all duration-200 hover:shadow-md hover:shadow-black hover:scale-110"
                            style="background-color:#06B6D4; border-radius: 10px;" for="imageInput">Adjuntar imagen
                            <input type="file" name="foto" id="imageInput" required onchange="updateImageName()"
                                accept="image/*">
                        </label>
                        <p id="image-name" class="text-sky-700 ml-2 mt-2 mb-0"></p>
                    </div>
                    <div class="absolute mt-3" style="left: 50%">
                        <label for="public_titulo" class="text-base">Titulo de publicacion</label>
                        <input type="text" name="titulo" id="public_titulo" size="30" placeholder="Escribe aquí..."
                            class="placeholder-opacity-60 placeholder-slate-400" style="font-size: 14px">
                    </div>
                    <div class="mt-5">
                        <label for="url" class="text-base">URL direccional</label>
                        <input type="url" id="url" name="url" style="spellcheck:false; font-size: 14px"
                            class="px-3 ml-2 placeholder-opacity-60 placeholder-slate-400" placeholder="https://ejemplo.com"
                            pattern="http://.*" title="Direccion a la que llevará la imagen" size="30" required />
                    </div>
                    <button
                        class="mt-5 p-1.5 px-5 text-lg tracking-wider shadow-black shadow-md w-auto mx-auto transition-all duration-200 hover:shadow-md hover:shadow-black hover:scale-110"
                        style="background-color:#06B6D4; color:white; border-radius: 10px;" type="submit"
                        id="cargar-publi">Subir Publicidad</button>
                </form>
            </div>

            <div class="py-4 border-b-2">
                <h2 class="text-3xl font-bold text-center text-gray-800 tracking-wider mb-6 shadow-md shadow-black px-4 py-2 rounded-lg"
                    style="background-color: #06B6D4;">Listado de publicaciones</h2>
                <table class="table border-collapse border border-gray-300 table-hover font-sans" id="publicados">
                    <thead class="bg-gray-200 border-gray-300 text-center">
                        <th>Foto</th>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Url</th>
                    </thead>
                    <tbody id="publicidad_publicada" style="border:1px solid text-align:center">
                        @foreach ($publicidades as $publicidad)
                            <tr class="text-center">
                                <td class="border border-gray-300 px-4 py-2"> <img
                                        src="{{ url('publicidades/' . $publicidad->foto) }}" alt="{{ $publicidad->nombre }}"
                                        width="70px" height="70px"> </td>
                                <td class="border border-gray-300 px-4 py-2">{{ $publicidad->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $publicidad->nombre }}</td>
                                <td class="border border-gray-300 px-4 py-2"><a
                                        href="{{ $publicidad->id }}">{{ $publicidad->url }}</a></td>

                                <td class="acciones border border-gray-300 px-4 py-2">
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('publicidad.destroy', $publicidad->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm eliminar-btn mx-1"
                                                onclick="return confirm('¿Estás seguro de que deseas eliminar esta publicidad?');">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>



                </table>
                {{-- <div class="publicidad-list">
                    <table>

                    @foreach ($publicidades as $publicidad)
                        <div>
                            <img src="{{ $publicidad->foto }}" alt="{{ $publicidad->url }}">
                            <!-- Botones para futuras funcionalidades -->
                            <!-- Formulario de eliminación -->
                            <form action="{{ route('publicidad.destroy', $publicidad->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta publicidad?');">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div> --}}
            </div>




            <script>
                function updateImageName() {
                    const input = document.getElementById('imageInput');
                    const imageNameDisplay = document.getElementById('image-name');

                    // Verifica si hay archivos seleccionados
                    if (input.files && input.files[0]) {
                        // Muestra el nombre del primer archivo
                        imageNameDisplay.textContent = input.files[0].name;
                    } else {
                        imageNameDisplay.textContent = ''; // Limpia el texto si no hay archivo
                    }
                }
            </script>
        </section>
    @endsection
