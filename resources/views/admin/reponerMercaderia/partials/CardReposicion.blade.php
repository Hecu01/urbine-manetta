<div class="">

    <article class="article0 bg-yellow-500   px-2 hover:scale-105"  >
        <a href="{{ route('reposicion-mercaderia.index') }}" class="text-white no-underline">
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
    <ul style=" padding:0; margin:0; margin-top:20px;"  class="grid items-center ">
        <li class="mb-3"><a href="{{ route('solicitar-art-deport-index') }}" class="bg-blue-600 block mx-5 px-2 py-2 text-white no-underline rounded-full hover:bg-blue-700"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Reponer Articulos</a></li>
        <li class="mb-3"><a href="{{ route('solicitar-rop-deport-index') }}" class=" bg-cyan-600 block mx-5 px-2 py-2 text-white no-underline rounded-full hover:bg-cyan-700"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Reponer Ropa </a></li>
        <li class="mb-3"><a href="{{ route('solicitar-sup-diet-index') }}" class="bg-green-600 block mx-5 px-2 py-2 text-white no-underline rounded-full hover:bg-green-700"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Reponer suplementos</a></li>     
    </ul>
</div>
