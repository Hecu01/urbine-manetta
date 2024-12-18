@extends('layouts.app')
@section('section-principal')
    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
            <strong>Atención!</strong> {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('creado'))
        <div class="alert alert-success">
            {{ session('creado') }}
        </div>
    @endif
    <section class="section-bienvenida">
        <div class="contenedor d-flex">
            <div class="mensaje-bienvenida font-">
                <h1>
                    Sportivo<br>
                    Tu tienda deportiva
                </h1>
                <h2>Compras online y en el local</h2>
                {{-- <img src="{{ url('usuario/' . Auth::user()->foto) }}" alt=""> --}}
            </div>

        </div>

        {{-- @if ($publicidades->isNotEmpty())
            <div class="slider">
                <div class="slide_viewer">
                    <div class="slide_group">
                        @foreach ($publicidades as $publicidad)
                            <div class="slide text-center content-center ml-10">
                                <a href="{{ $publicidad->url }}">
                                    <img src="{{ asset($publicidad->foto) }}" alt="{{ $publicidad->nombre }}"
                                        style="width: auto; height:auto;
    object-fit: contain;   
    display: block;     
    margin: 0 auto;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>



                <div class="slide_buttons">
                </div>

                <div class="directional_nav">
                    <div class="previous_btn" title="Previous">
                        <img src="assets/img/previous_btn.svg" alt="Previous">
                    </div>
                    <div class="next_btn" title="Next">
                        <img src="assets/img/next_btn.svg" alt="Next">
                    </div>
                </div><!-- End // .directional_nav -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            </div><!-- End // .slider -->
        @endif --}}



        @guest
            <div class="container-fluid banner bg-blue-600 py-5 px-2 my-2 flex justify-between items-center">

                <div class="div-left ml-3">
                    <div class="text-white  ">
                        <h5 class="uppercase mb-2">
                            <strong>
                                EN SPORTIVO ESTÁ TODO LO QUE NECESITÁS
                            </strong>
                        </h5>
                        <h4 class="">Inicia sesión o registrate así podés comprar <br> y agregar comentarios a nuestros
                            productos</h4>
                        <div class=" mt-3 flex">

                            <a href=" {{ route('login') }} "
                                class="block text-white no-underline rounded-lg py-2 text-center px-3 bg-red-500 hover:scale-105">Entrar</a>
                            <a href="{{ route('register') }}"
                                class="block text-white no-underline rounded-lg py-2 mx-2  text-center px-3 bg-red-500 hover:scale-105">Registrarse</a>
                        </div>


                    </div>

                </div>
                <div class="right-banner">
                    <h1 class="title-right-banner">SPORTIVO E-COMMERCE</h1>
                </div>

            </div>

            {{-- BANNER LOGUEADO --}}
        @else
            {{-- <div class="container-fluid bg-blue-600 py-5 px-2 my-2 flex justify-between ">

                <div class="div-left">
                    <div class="text-white  ">
                        <h5 class="uppercase mb-2">
                            <strong>
                                EN SPORTIVO ESTÁ TODO LO QUE NECESITÁS
                            </strong>
                        </h5>
                        <h4 class="">Ya iniciaste sesión. Ahora podés comprar <br> y agregar comentarios a nuestros
                            productos</h4>
                        <div class=" mt-3 flex">

                            <a href=" {{ route('login') }} "
                                class="block text-white no-underline rounded-lg py-2 text-center px-3 bg-red-500 hover:scale-105">Entraste</a>
                            <a href="{{ route('register') }}"
                                class="block text-white no-underline rounded-lg py-2 mx-2  text-center px-3 bg-red-500 hover:scale-105">Registrado</a>
                        </div>


                    </div>

                </div>

                

            </div> --}}
        @endguest
        {{-- <div class=" " style="height: 550px">


        </div> --}}

        <script>
            /*Slider imagenes*/
            $('.slider').each(function() {
                var $this = $(this);
                var $group = $this.find('.slide_group');
                var $slides = $this.find('.slide');
                var bulletArray = [];
                var currentIndex = 0;
                var timeout;

                function move(newIndex) {
                    var animateLeft, slideLeft;

                    advance();

                    if ($group.is(':animated') || currentIndex === newIndex) {
                        return;
                    }

                    bulletArray[currentIndex].removeClass('active');
                    bulletArray[newIndex].addClass('active');

                    if (newIndex > currentIndex) {
                        slideLeft = '100%';
                        animateLeft = '-100%';
                    } else {
                        slideLeft = '-100%';
                        animateLeft = '100%';
                    }

                    $slides.eq(newIndex).css({
                        display: 'block',
                        left: slideLeft
                    });
                    $group.animate({
                        left: animateLeft
                    }, function() {
                        $slides.eq(currentIndex).css({
                            display: 'none'
                        });
                        $slides.eq(newIndex).css({
                            left: 0
                        });
                        $group.css({
                            left: 0
                        });
                        currentIndex = newIndex;
                    });
                }

                function advance() {
                    clearTimeout(timeout);
                    timeout = setTimeout(function() {
                        if (currentIndex < ($slides.length - 1)) {
                            move(currentIndex + 1);
                        } else {
                            move(0);
                        }
                    }, 4000);
                }

                $('.next_btn').on('click', function() {
                    if (currentIndex < ($slides.length - 1)) {
                        move(currentIndex + 1);
                    } else {
                        move(0);
                    }
                });

                $('.previous_btn').on('click', function() {
                    if (currentIndex !== 0) {
                        move(currentIndex - 1);
                    } else {
                        move(3);
                    }
                });

                $.each($slides, function(index) {
                    var $button = $('<a class="slide_btn">&bull;</a>');

                    if (index === currentIndex) {
                        $button.addClass('active');
                    }
                    $button.on('click', function() {
                        move(index);
                    }).appendTo('.slide_buttons');
                    bulletArray.push($button);
                });

                advance();
            });
        </script>

    </section>
@endsection
