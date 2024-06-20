@extends('admin.layouts.plantilla_admin')

@section('section-principal')

    <div class="w-fit mb-5">
        @include('admin.layouts.aside-left')
        <div class="flex justify-center mt-3">
            <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
                <i class="fa-solid fa-circle-arrow-left"></i> Atrás
            </a>

        </div>
    </div>
    <div class="">
        <h1>Solicitar mercadería de articulos deportivos</h1>
        <table class=" table-bordered text-center" id="table-art-deport-solicitar">
            <thead>
                <th>Id</th>
                <th>IMG</th>
                <th>Articulo</th>
                <th>Marca</th>
                <th>Stock <br> Actual</th>
                <th>Solicitar <br> Mercaderia</th>
            </thead>
            <tbody>
                @foreach ($artDeportivos as $artDeportivo)
                    <tr>
                        <td>{{ $artDeportivo->id }}</td>
                        <td > <img style="margin: auto" src="{{ url('producto/'. $artDeportivo->foto) }}" alt="{{ $artDeportivo->nombre }}" width="50px" height="50px"> </td>

                        <td>{{ $artDeportivo->nombre }}</td>
                        <td>{{ $artDeportivo->marca }}</td>
                        <td class="{{ $artDeportivo->stock < 20 ? 'text-rose-500' :'' }}">{{ $artDeportivo->stock }}</td>
                        <td><a href="" class="btn btn-success btn-sm">Solicitar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="">
        <h1>aside</h1>
    </div>

<style>
    #table-art-deport-solicitar {
        width: 680px
    }
</style>
@endsection


