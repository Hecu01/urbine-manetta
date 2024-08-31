<aside  id="left-aside" class="left-aside bg-slate-100 rounded-xl " style="max-width:231px"  >
    <a href="{{ route('ir_admin') }}" style="color: currentColor; text-decoration:none; " draggable="false">

        <div class="foto-local-y-admin" style="position: relative">
            <div class="local rounded-xl">
                <img src="{{ asset('assets/img/local.jpg')}}" class="rounded-xl" alt="" style="width: 100%;" draggable="false">
            </div>
            <button class="btn btn-primary btn-sm" style="position:absolute; font-size:0.56em; font-weight:bold; right:34px; bottom:-44px">PERFIL</button>

            <div id="foto-admin">
                <img src="{{ url('usuario/' . Auth::user()->foto) }}" alt="" draggable="false">
            </div>
        </div>
        <div class="mas-informacion">
            <h3 class="text-3xl">Sportivo</h3>
            <ul style="margin: 3px 0px 0px 10px;padding:0">
                <li><i class="fa-solid fa-screwdriver-wrench"></i> Admin: <strong class="capitalize">{{ Auth::user()->name }}</strong></li>
                <li style><i class="fa-solid fa-location-dot"></i> Gutemberg 7 bis, San Nicolás.</li>
            </ul>
        </div>
    </a>

</aside>

