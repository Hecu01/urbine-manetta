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
