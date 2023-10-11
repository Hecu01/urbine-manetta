<aside class="left-aside" id="left-aside" style="width: fit-content" >
    <a href="{{ route('ir_admin') }}" style="color: currentColor; text-decoration:none; ">

        <div class="foto-local-y-admin">
            <div class="local">
                <img src="{{ asset('assets/img/local.jpg')}}" alt="" style="width: 100%;">
            </div>
            <div id="foto-admin">
                <img src="{{ asset('assets/img/mi-foto.jpg')}}" alt="foto de ..." >
            </div>
        </div>
        <div class="mas-informacion">
            <h3>Sportivo</h3>
            <span><i class="fa-solid fa-location-dot"></i> Casa central</span><br>
            <span><i class="fa-solid fa-screwdriver-wrench"></i> Valentin Urbine</span>
        </div>
    </a>
    
    @if ($volver == true)
        <button class="btn btn-secondary btn-sm mx-2" id="volver-admin">
            VOLVER
        </button>
    @endif
</aside>

