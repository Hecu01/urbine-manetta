@extends('layouts.app')
@section('section-principal')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('assets/css/asked.css') }}">
        <title>askedQuestions</title>
    </head>

    <body>
        <div class="container">
            <h2>Preguntas Frecuentes</h2>
            <div class="accordion px-1">
                <div class="accordion-item">
                    <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">¿Cómo compro
                            online?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>Para realizar una compra en nuestro sitio, primero debes estar registrado y haber iniciado
                            sesión. Luego, busca el artículo que deseas comprar y agrégalo a tu carrito de compras. En la
                            página del carrito, se especificará el monto total a pagar. </p>
                        <p>Puedes realizar el pago de forma
                            segura utilizando tarjetas de crédito Visa, MasterCard o American Express.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-2" aria-expanded="false"><span class="accordion-title">¿Cómo creo un
                            usuario?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>Para registrarte, haz clic en el botón "Registrar" ubicado en la parte superior izquierda de
                            nuestra página. Durante el registro, se te pedirá que subas una foto y proporciones tu nombre,
                            apellido, DNI, un correo electrónico válido y una contraseña.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-3" aria-expanded="false"><span class="accordion-title">¿Qué es agregar al
                            carrito?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>Agregar al carrito te permite seleccionar los artículos que deseas comprar y guardarlos
                            temporalmente mientras sigues navegando por el sitio. Una vez que termines de elegir, podrás
                            revisar tu carrito y completar la compra de todos los artículos juntos.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-4" aria-expanded="false"><span class="accordion-title">¿Cuál es mi número
                            de
                            calzado?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>A continuación te dejamos una guía rápida para talles de calzado:</p>
                        <p><span style="font-weight: bold;">Talle 38:</span> 24.5 cm</p>
                        <p><span style="font-weight: bold;">Talle 39:</span> 25 cm</p>
                        <p><span style="font-weight: bold;">Talle 40:</span> 25.5 cm</p>
                        <p><span style="font-weight: bold;">Talle 41:</span> 26.5 cm</p>
                        <p><span style="font-weight: bold;">Talle 42:</span> 27 cm</p>
                        <p><span style="font-weight: bold;">Talle 43:</span> 27.5 cm</p>
                        <p><span style="font-weight: bold;">Talle 44:</span> 28.5 cm</p>
                        <p>Recuerda medir tu pie desde el talón hasta la punta del dedo más largo para obtener la medida
                            exacta.
                        </p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">¿Cuál es mi talle de
                            pantalón?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>Para medir correctamente tu talle de pantalón, sigue estos pasos:</p>
                        <img src="{{ asset('assets/img/talles-pantalon.png') }}" alt="tallas" style="width: 40em">
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">¿Cómo sé qué talle
                            de remera soy?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>Para saber tu talle de remera, campera o camiseta, mide lo siguiente:</p>

                        <p><span style="font-weight: bold;">Ancho/busto:</span> Coloca la cinta métrica sobre la parte
                            delantera más ancha de tu pecho, debajo de
                            los
                            brazos.</p>
                        <p><span style="font-weight: bold;">Largo:</span> Mide desde tu hombro hasta el largo deseado.</p>
                        <p>Guía de talles de ropa (en cm):</p>
                        <img src="{{ asset('assets/img/talla-remera.png') }}" alt="">
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">¿Cuánto tarda en
                            llegar mi pedido?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>El tiempo de entrega varía según la ubicación. En general, los envíos dentro de la ciudad entre 2
                            a 5 dias. En zonas más alejadas, puede demorar hasta 10 días hábiles. </p>
                        {{-- <p>Una vez que tu pedido sea
                                enviado, recibirás un número de seguimiento para verificar el estado de la entrega en cualquier
                                momento.</p> --}}
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">¿Qué debo hacer si
                            mi pago no funciona?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>Existen diferentes razones para que tu pago genere un error: </p>
                        <p><span style="font-weight: bold;">Información incorrecta:</span> comprueba que toda la información
                            que ingreses sea correcta (Nombre en la
                            tarjeta, número de tarjeta, fecha de vencimiento y código de seguridad).</p>
                        <p><span style="font-weight: bold;">Bloqueo de Tarjeta:</span> En caso de que el problema persista,
                            a pesar de haber validado tu información,
                            por favor comunícate con tu entidad bancaria, para garantizar que no exista ninguna restricción
                            para
                            compras en línea con tu tarjeta o que tu tarjeta no cuente con los fondos necesarios.</p>
                        <p><span style="font-weight: bold;">Método de pago inválido:</span> verifica que tu método de pago
                            sea aceptada en nuestro sitio. Recuerda que
                            únicamente aceptamos VISA, MasterCard y American Express.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">¿Qué pasa si mi
                            producto tiene un defecto o no cumple con los estándares de calidad?</span><span class="icon"
                            aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>Comprobamos exhaustivamente todos nuestros productos en condiciones reales para asegurarnos de
                            que están en óptimas condiciones para soportar los usos para los que han sido diseñados. Sin
                            embargo, a veces resulta inevitable que se entregue un producto defectuoso. </p>
                        <p>Por ello, si tu producto no cumple con los estándares y sufre algun daño durante su uso NORMAL:
                        </p>
                        <p><span style="font-weight: bold;">1. </span>Tienes un plazo de hasta 180 días para comunicarte con
                            nuestro Servicio de Atención a Clientes</p>
                        <p><span style="font-weight: bold;">2. </span> Si al momento de tu solicitud: </p>
                        <p><span style="font-weight: bold; font-style:italic">2.1 </span> Contamos con el inventario para reemplazar tu
                            producto, te haremos llegar uno nuevo.</p>
                        <p><span style="font-weight: bold;font-style:italic">2.2 </span> Si no contamos con el inventario disponible, haremos
                            el reembolso íntegro de tu artículo(s).</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">¿Puedo realizar
                            cambios en Tienda?</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>Sí, es posible realizar cambios de talle o de artículo en tienda, siempre y cuando:</p>
                        <p><span style="font-weight: bold;">1. </span>El artículo este nuevo, con etiquetas y con su empaque original.</p>
                        <p><span style="font-weight: bold;">2. </span> Se encuentre dentro de los 30 días desde la fecha de recepción del pedido. </p>
                        <p><span style="font-weight: bold;">3. </span> Se presente la factura impresa/ electrónica de la compra.</p>
                        <p><span style="font-weight: bold;">4. </span> El valor del artículo para cambio sea del mismo o de mayor valor (pagando la diferencia) al de la compra original.</p>
                        <p>Recordá que no hay reembolsos de efectivo en la tienda.</p>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const items = document.querySelectorAll(".accordion button");

            function toggleAccordion() {
                const itemToggle = this.getAttribute('aria-expanded');

                for (i = 0; i < items.length; i++) {
                    items[i].setAttribute('aria-expanded', 'false');
                }

                if (itemToggle == 'false') {
                    this.setAttribute('aria-expanded', 'true');
                }
            }

            items.forEach(item => item.addEventListener('click', toggleAccordion));
        </script>

    </body>

    </html>
@endsection
