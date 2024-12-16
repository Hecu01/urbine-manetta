<footer class="navbar mt-3" id="footer-admin" style="">
    <div class="informacion-footer flex justify-between w-100" style="position: relative; ">
        <div class="w-64 mx-2 ">
            <div class="center">
                <!-- Logo y nombre -->
                <div class="logo-y-nombre">
                    <div class="imagen-logo mr-6">

                        <img src="{{asset('assets/img/sportivo-logo.svg')}} " alt="" draggable="false" style="min-width: 150px; min-height: 150px; max-width: 200px; max-height: 200px; background: #fff; padding:3px; border: 1px solid black; border-radius:50%">
                    </div>
                    <span class="text-black font-weight-bold" style="font-size:3.5em; text-decoration: none; text-shadow:1px 1px 0 #fdfdfd, 4px 4px 0 rgba(81, 81, 81, 0.5), 0 0 1px #fdfdfd;">
                        Sportivo
                    </span>
                </div>
            </div>

            {{-- <span>
                Nosotros somos Sportivo, una tienda que vende articulos deportivos. Hacemos venta tanto online como presencial. Hacemos envíos gratis dentro de San Nicolás de los arroyos, te esperamos.
            </span> --}}
        </div>
        <div class="redes-sociales justify-between" style="width: 300px">
            <h1 class="text-2xl "> Nuestras redes sociales</h1>
            <ul class="" style="width: 300px">
                <li >
                    <a class="text-white" href="https://www.instagram.com/valcel_macetas/" target="_BLANK"><i class="fa-brands fa-square-instagram"></i> - Sportivo</a>
                </li>
                <li >
                    <a class="text-white"href="https://web.facebook.com/valcel.macetas" target="_BLANK"><i class="fa-brands fa-square-facebook"></i> - Tienda deportiva Sportivo Online</a>
                </li>
                <li >
                    <a class="text-white" style="align-items: flex-start" href="https://api.whatsapp.com/send?phone=5493364036241&text=Hola,%20me%20comunico%20desde%20la%20tienda%20sportivo,%20tengo%20una%20consulta" target="_BLANK">
                        <i class="fa-brands fa-square-whatsapp"></i> - Atención al cliente (3364036241)
                    </a>
                </li>
            </ul>
        </div>
        <div class="preguntas-frecuentes" style="width: 300px">
            <h1 class="text-2xl"> Ayuda</h1>
            <ol class="" style="width: 300px">
                <li><a class="text-white text-base" href="{{ route('preg-frecuentes') }}">Preguntas frecuentes</a></li>
                <li><a class="text-white text-base" href="">Manual de usuario </a></li>
            </ol>
        </div>
        {{-- <div class="utilidades" >
            <h1 class="text-2xl "> Otras acciones</h1>
            <ul class="" style="width: 300px">
                
                <li><a class="text-white"href="">Acceder a un reembolso</a></li>
                <li><a class="text-white" href="">Tabla de talles</a></li>

            </ul>
        </div> --}}



        <span class="bg-slate-500 mx-2 px-2 py-1 text-lg" style="position: absolute;bottom:-15px;right: 0px">Sportivo 2023 &copy; todos los derechos reservados</span>
    </div>
</footer>