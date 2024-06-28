<!-- Artículos deportivos -->
<article class="article0 px-2 bg-blue-500 hover:scale-105" >
    <a href="{{ route('ropa-deportiva.index') }}" class="text-white no-underline">
    <div class="top">
        <span>
            <i class="fa-solid fa-shirt"></i>
        </span>
        <span class="recuento">
            {{ $ropaDeportivas }}
        </span>
    </div>
    <div class="bottom">
        <p>Ropas deportivas <br> disponibles</p>
    </div>
    </a>
</article>
<ul style="text-align: center; padding:0; margin:0; margin-top:20px;" id="nav-aside">
    <li class="mb-4"><a href="{{ route('ropa-deportiva.formulario') }}" class="bg-slate-600 px-7 pl-7 py-2 text-white no-underline rounded-full hover:bg-slate-700"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Crear nueva ropa</a></li>
    <li class="mb-4"><a href="{{ route('ropa-deportiva.tabla-talles') }}" class="bg-blue-600 px-7 py-2 text-white no-underline rounded-full hover:bg-blue-700"><i class="fa-solid fa-table" style="color: #ffffff;"></i> Tabla de talles</a></li>
    <li class="mb-4"><a href=" {{ route('ropa-deportiva.tabla') }} " class="bg-rose-600 px-7 py-2 text-white no-underline rounded-full hover:bg-rose-700"><i class="fa-solid fa-table" style="color: #ffffff;"></i> Tabla de artículos</a></li>
</ul>