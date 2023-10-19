<aside  id="left-aside" class="left-aside bg-slate-100 rounded-xl  w-fit"  >
    <a href="{{ route('ir_admin') }}" style="color: currentColor; text-decoration:none; ">

        <div class="foto-local-y-admin">
            <div class="local rounded-xl">
                <img src="{{ asset('assets/img/local.jpg')}}" class="rounded-xl" alt="" style="width: 100%;">
            </div>
            <div id="foto-admin">
                <img src="{{ asset('assets/img/mi-foto.jpg')}}" alt="foto de ..." >
            </div>
        </div>
        <div class="mas-informacion">
            <h3 class="text-3xl">Sportivo</h3>
            <span><i class="fa-solid fa-location-dot"></i> Casa central</span><br>
            <span><i class="fa-solid fa-screwdriver-wrench"></i> {{ Auth::user()->name }} </span>
        </div>
    </a>
    
    @if ($volver == true)
        <button class="btn btn-secondary btn-sm mx-2" id="volver-admin">
            VOLVER
        </button>
    @endif
</aside>

