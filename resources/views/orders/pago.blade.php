<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/pago.css') }}">
    <!-- Agregar Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Pago</title>
</head>

<div class="container">
    <!-- Tarjeta -->
    <section id="card" class="card">
        <div class="front-card">
            <div id="logo-card" class="logo-card"></div>
            <img src="https://firebasestorage.googleapis.com/v0/b/fire-fotos-8e3f9.appspot.com/o/img%2Fchip-tarjeta.png?alt=media&token=489dc6be-d75d-47db-b544-e7020041cc90"
                alt="Chip" title="Chip" class="chip">

            <div class="info-card-front">
                <div id="group-number-card" class="group-number-card">
                    {{-- <p class="label-card">
						Número Tarjeta
					</p> --}}

                    <p class="number-card">
                        #### #### #### ####
                    </p>
                </div>

                <div class="flexbox">
                    <div id="group-name-card" class="group-name-card">
                        {{-- <p class="label-card">
							Nombre Tarjeta
						</p> --}}

                        <p class="name-card">
                            Nombre y Apellido
                        </p>
                    </div>

                    <div id="group-expiration-card" class="group-expiration-card">
                        {{-- <p class="label-card">
							Expiración
						</p> --}}

                        <p class="expiration-card">
                            <span class="mounth-expiration-card">
                                MM
                            </span>
                            /
                            <span class="year-expiration-card">
                                AA
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="back-card">
            <div class="magnetic-bar-card"></div>

            <div class="info-card-back">
                <div id="group-firm-card" class="group-firm-card">
                    <p class="firmaCard">
                        For emergency service call USA & Canada 1-800-396-9665 and call collect int'11(303)967-1098
                    </p>

                    <div class="firm-card">
                        {{-- <p>
							Nombre Apellido
						</p> --}}
                    </div>
                </div>

                <div id="group-ccv-card" class="group-ccv-card">
                    <p class="label-card">
                        CCV
                    </p>

                    <p class="ccv-card"></p>
                </div>
            </div>

            {{-- <p class="legend-card">
                Lorem ipsum dolor sit amet consectetur
            </p> --}}

            <a class="link-bank-card" href="javascript:void(0);">
                Gracias por comprar con Sportivo.
            </a>
        </div>
    </section>

    <!-- Contenedor botón abrir formulario -->
    <div class="ctn-btn">
        <button type="button" id="btn-open-form-card" class="btn-open-form-card">
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>

    <!-- Formulario Tarjeta -->

    {{-- <form action="javascript:void(0);" id="form-card" class="form-card active"> --}}
    <form action="{{ route('processPayment') }}" method="POST" id="form-card" class="form-card active">

        @csrf
        <!-- Número de Tarjeta -->
        <div>
            <label for="number-card-form">Número Tarjeta</label>
            @if ($errors->has('cardNumber'))
                <div class="error-message">{{ $errors->first('cardNumber') }}</div>
            @endif
            <input type="text" id="number-card-form" name="cardNumber" maxlength="19" autocomplete="off"
                class="{{ $errors->has('cardNumber') ? 'border-red' : '' }}" value="{{ old('cardNumber') }}">
        </div>

        <!-- Nombre en la tarjeta -->
        <div style="margin-top: 3%;">
            <label for="name-card-form">Nombre y Apellido</label>
            @if ($errors->has('cardName'))
                <div class="error-message">{{ $errors->first('cardName') }}</div>
            @endif
            <input type="text" id="name-card-form" name="cardName" maxlength="50" autocomplete="off"
                class="{{ $errors->has('cardName') ? 'border-red' : '' }}" value="{{ old('cardName') }}">
        </div>

        <!-- Fecha de expiración -->
        <div class="flexbox" style="margin-top: 3%;">
            <div class="group-expiration-card-form">
                <label for="mounth-expiration-card-form">Expiración</label>
                <div class="flexbox">
                    <div class="group-select">
                        <!-- Opciones de mes -->
                        <select id="mounth-expiration-card-form" name="cardExpiryMonth"
                            class="{{ $errors->has('cardExpiryMonth') ? 'border-red' : '' }}">
                            <option disabled="disabled" selected="selected">Mes</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ sprintf('%02d', $i) }}"
                                    {{ old('cardExpiryMonth') == sprintf('%02d', $i) ? 'selected' : '' }}>
                                    {{ sprintf('%02d', $i) }}
                                </option>
                            @endfor
                        </select>
                        @if ($errors->has('cardExpiryMonth'))
                            <div class="error-message">{{ $errors->first('cardExpiryMonth') }}</div>
                        @endif
                    </div>
                    <div class="group-select">
                        <!-- Opciones de año -->
                        <select id="year-expiration-card-form" name="cardExpiryYear"
                            class="{{ $errors->has('cardExpiryYear') ? 'border-red' : '' }}">
                            <option disabled="disabled" selected="selected">Año</option>
                            @for ($i = date('Y'); $i <= date('Y') + 8; $i++)
                                <option value="{{ $i }}"
                                    {{ old('cardExpiryYear') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                        @if ($errors->has('cardExpiryYear'))
                            <div class="error-message">{{ $errors->first('cardExpiryYear') }}</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- CCV -->
            <div class="group-ccv-card-form">
                <label for="ccv-card-form">CCV</label>

                <input type="text" id="ccv-card-form" name="cardCvv" maxlength="3" autocomplete="off"
                    class="{{ $errors->has('cardCvv') ? 'border-red' : '' }}" value="{{ old('cardCvv') }}">
                @if ($errors->has('cardCvv'))
                    <div class="error-message">{{ $errors->first('cardCvv') }}
                    </div>
                @endif
            </div>
        </div>

        <button type="submit" class="btn-send-form-card">Pagar</button>
    </form>


</div>

<script>
    // Tarjeta
    const card = document.querySelector('#card');
    const logoCard = document.getElementById('logo-card');
    const numberCard = document.querySelector('#card .number-card');
    const nameCard = document.querySelector('#card .name-card');
    const mounthExpirationCard = document.querySelector('#card .mounth-expiration-card');
    const yearExpirationCard = document.querySelector('#card .year-expiration-card');
    const firmCard = document.querySelector('#card .firm-card p');
    const ccvCard = document.querySelector('#card .ccv-card');

    // Formulario Tarjeta
    const btnOpenForm = document.getElementById('btn-open-form-card');
    const formCard = document.getElementById('form-card');
    const numberCardForm = document.getElementById('number-card-form');
    const nameCardForm = document.getElementById('name-card-form');
    const selectMounthCardForm = document.getElementById('mounth-expiration-card-form');
    const selectYearCardForm = document.getElementById('year-expiration-card-form');
    const ccvCardForm = document.getElementById('ccv-card-form');

    const showFrontCard = () => {
        if (card.classList.contains('active')) {
            card.classList.remove('active');
        }
    }

    // Rotación de la tarjeta
    card.addEventListener('click', () => {
        card.classList.toggle('active');
    });

    // Abrir formulario
    btnOpenForm.addEventListener('click', () => {
        btnOpenForm.classList.toggle('active');
        formCard.classList.toggle('active');
    });

    // Llenar el select del mes dinamicamente
    for (let i = 1; i <= 12; i++) {
        let option = document.createElement('option');
        option.value = i < 10 ? '0' + i : i; //Esto es lo que asegura que el mes tenga dos digitos
        option.innerText = option.value;
        selectMounthCardForm.appendChild(option);
    }

    // Llenar el select del año dinamicamente
    let currentYear = new Date().getFullYear();

    for (let i = currentYear; i <= currentYear + 8; i++) {
        let option = document.createElement('option');
        option.value = i;
        option.innerText = i;
        selectYearCardForm.appendChild(option);
    }

    // Número de tarjeta
    numberCardForm.addEventListener('keyup', e => {
        let valueNumberCardForm = e.target.value
            // Eliminar espacios en blanco
            .replace(/\s/g, '')
            // Eliminar todos los caracteres que no sean números del 0 al 9
            .replace(/\D/g, '')
            // Colocamos espacio cada cuatro caracteres
            .replace(/([0-9]{4})/g, '$1 ')
            .trim();
        numberCardForm.value = valueNumberCardForm;

        numberCard.textContent = valueNumberCardForm;

        if (valueNumberCardForm === '') {
            numberCard.textContent = '#### #### #### ####';
            logoCard.innerHTML = '';
        }

        if (valueNumberCardForm[0] === '4') {
            logoCard.innerHTML = '';
            let imgLogo = document.createElement('img');
            imgLogo.src = '{{ asset('assets/img/visa.png') }}';
            // 'https://firebasestorage.googleapis.com/v0/b/fire-fotos-8e3f9.appspot.com/o/img%2Fvisa.png?alt=media&token=d1324d01-81f6-42d4-a37c-1edc19e1e0b1';
            imgLogo.style.width = '150px';
            imgLogo.style.height = 'auto';
            logoCard.appendChild(imgLogo);
        } else if (valueNumberCardForm[0] === '5') {
            logoCard.innerHTML = '';
            let imgLogo = document.createElement('img');
            imgLogo.src = '{{ asset('assets/img/master_card.png') }}';
            // 'https://firebasestorage.googleapis.com/v0/b/fire-fotos-8e3f9.appspot.com/o/img%2Fmastercard.png?alt=media&token=1a5347d2-a282-436f-87a8-f193458830f4';
            imgLogo.style.width = '150px';
            imgLogo.style.height = 'auto';
            logoCard.appendChild(imgLogo);
        } else if (valueNumberCardForm[0] === '3') {
            logoCard.innerHTML = '';
            let imgLogo = document.createElement('img');
            imgLogo.src = '{{ asset('assets/img/american_express.png') }}';
            imgLogo.style.width = '150px';
            imgLogo.style.height = 'auto';
            // 'https://firebasestorage.googleapis.com/v0/b/fire-fotos-8e3f9.appspot.com/o/img%2Fmastercard.png?alt=media&token=1a5347d2-a282-436f-87a8-f193458830f4';
            logoCard.appendChild(imgLogo);
        }

        // Voltear la tarjeta para que el usuario vea el frente
        showFrontCard();

    });

    // Formulario nombre tarjeta
    nameCardForm.addEventListener('keyup', e => {
        let valueNameCardForm = e.target.value.replace(/[0-9]/g, '');

        nameCardForm.value = valueNameCardForm;
        nameCard.textContent = valueNameCardForm;
        firmCard.textContent = valueNameCardForm;

        if (valueNameCardForm === '') {
            nameCard.textContent = 'Nombre y apellido';
        }

        showFrontCard();
    });

    // Select mes
    selectMounthCardForm.addEventListener('change', e => {
        mounthExpirationCard.textContent = e.target.value;
        showFrontCard();
    });


    // Select año
    selectYearCardForm.addEventListener('change', e => {
        yearExpirationCard.textContent = e.target.value.slice(2);
        showFrontCard();
    });

    // Ccv
    ccvCardForm.addEventListener('keyup', e => {
        if (!card.classList.contains('active')) {
            card.classList.add('active');
        }

        ccvCardForm.value = ccvCardForm.value
            // Eliminar espacios en blanco
            .replace(/\s/g, '')
            // Eliminar todos los caracteres que no sean números del 0 al 9
            .replace(/\D/g, '');

        ccvCard.textContent = ccvCardForm.value;
    });


    // Lo siguiente utiliza el old para mantener los errores en la tarjeta hasta que se modifiquen
    document.addEventListener('DOMContentLoaded', () => {
        const oldCardNumber = "{{ old('cardNumber') }}".trim();
        if (oldCardNumber) {
            numberCard.textContent = oldCardNumber;
            numberCardForm.value = oldCardNumber;
        }

        const oldCardName = "{{ old('cardName') }}".trim();
        if (oldCardName) {
            nameCard.textContent = oldCardName;
            nameCardForm.value = oldCardName;
            firmCard.textContent = oldCardName;
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const oldCardExpiryMonth = "{{ old('cardExpiryMonth') }}".trim();
        if (oldCardExpiryMonth) {
            selectMounthCardForm.value = oldCardExpiryMonth;
            mounthExpirationCard.textContent = oldCardExpiryMonth;
        }

        const oldCardExpiryYear = "{{ old('cardExpiryYear') }}".trim();
        if (oldCardExpiryYear) {
            selectYearCardForm.value = oldCardExpiryYear;
            yearExpirationCard.textContent = oldCardExpiryYear.slice(
                2); // Mostrar los últimos 2 dígitos del año
        }
    });
    document.addEventListener('DOMContentLoaded', () => {
        const oldCcvCard = "{{ old('cardCvv') }}".trim();
        if (oldCcvCard) {
            ccvCard.textContent = oldCcvCard;
            ccvCardForm.value = oldCcvCard;
        }
    });
</script>
