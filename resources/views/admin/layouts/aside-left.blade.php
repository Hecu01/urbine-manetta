<aside  id="left-aside" class="left-aside bg-slate-100 rounded-xl  w-fit"  >
    <a href="{{ route('ir_admin') }}" style="color: currentColor; text-decoration:none; " draggable="false">

        <div class="foto-local-y-admin">
            <div class="local rounded-xl">
                <img src="{{ asset('assets/img/local.jpg')}}" class="rounded-xl" alt="" style="width: 100%;" draggable="false">
            </div>
            <div id="foto-admin">
                <img src="{{ url('usuario/' . Auth::user()->foto) }}" alt="" draggable="false">
            </div>
        </div>
        <div class="mas-informacion">
            <h3 class="text-3xl">Sportivo</h3>
            <ul style="margin: 3px 0px 0px 5px;padding:0">
                <li><i class="fa-solid fa-location-dot"></i> De la nación 356, San Nicolás </li>
                <li><i class="fa-solid fa-screwdriver-wrench"></i> Admin: <strong class="capitalize">{{ Auth::user()->name }}</strong></li>
            </ul>
        </div>
    </a>

</aside>

