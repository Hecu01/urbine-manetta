$(document).ready(function(){
    
    // Sportivo - Artículos Deportivos (edit)

    // dar un mensaje de que es normal el sólo lectura
     $("#stock_input_ropa").on("click", function() {
        // evalua si está en solo lectura
        if($(this).prop('readonly')){

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-center",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["error"]("No se puede editar, es la sumatoria de todos los talles.", "Información Sportivo");
        }
    });


    /* 
    |
    |--------------------------------------------------------------------------------
    | Sportivo - Artículos Deportivos
    |--------------------------------------------------------------------------------
    |
    */ 


    /* Checkbox calzados y stock en modal calzados */
    var checkboxes = $('input[type="checkbox"][name^="talles"]');

    // Agrega un evento change a cada checkbox
    checkboxes.each(function() {
        $(this).change(function() {
            // Obtén el ID del calzado correspondiente
            var talleId = $(this).attr('id').split('-')[1];

            // Obtén el campo de texto correspondiente
            var stockInput = $('#stock-' + talleId);

            // Habilita o deshabilita el campo de texto según el estado del checkbox
            stockInput.prop('disabled', !$(this).prop('checked'));
        });
    });


    // Agrega un evento change a cada checkbox con el nombre que comienza con "calzados"
    $('input[type="checkbox"][name^="calzados"]').change(function() {
        // Obtén el ID del calzado correspondiente
        var calzadoId = $(this).attr('id').split('-')[1];

        // Obtén el campo de texto correspondiente y deshabilítalo si el checkbox está desmarcado
        $('#stock-' + calzadoId).prop('disabled', !$(this).prop('checked'));
        $("#stock_input").prop('readonly', true).val('');

        // Habilita o deshabilita el campo de texto según el estado del checkbox
        $('#precio-' + calzadoId).prop('disabled', !$(this).prop('checked'));
    
        // Agregar evento input al input de precio
        $('#precioFinal').on('input', function() {
            var precio = parseFloat($(this).val()); // Obtener el valor del input de precio

            $('#precio-' + calzadoId).val(precio);
    
        });
    });


    // Sumatoria para el stock, en caso de calzados
    $(".input-suma-ropa").on("input", function(){
        var suma = 0;
        $(".input-suma-ropa").each(function(){
            if(!isNaN(this.value) && this.value.length != 0) {
                suma += parseFloat(this.value);
            }
        });

        // Formulario normal
        $("#stock_input_ropa").val(suma);
    });

   
});


// Seccion donde se agregan o quitan etiquetas

function agregarDeporte() {
    var select = document.getElementById("deporte");
    var textarea = document.getElementById("contenedor-etiquetas");

    // Obtener el valor seleccionado del select
    var deporte = select.options[select.selectedIndex].text;

    // Agregar el valor al textarea como etiqueta
    if (textarea.value === "") {
        textarea.value = deporte;
    } else {
        textarea.value += ", " + deporte;
    }
}

// Mostrar u ocultar el campo de opciones de calzado según el tipo seleccionado
document.querySelector('select[name="tipoProducto"]').addEventListener('change', function() {
    var opcionesCalzado = document.getElementById('contenedor-modal-calzados');
    if (this.value === 'calzado') {
        opcionesCalzado.style.display = 'block';
    } else {
        opcionesCalzado.style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Manejar cambios en el campo de entrada de imágenes
    document.getElementById('imageInput').addEventListener('change', handleImagePreview);
});

function handleImagePreview(event) {
    // Limpiar el carrusel de previsualización
    document.getElementById('imagePreviewInner').innerHTML = '';

    // Obtener archivos seleccionados
    const files = event.target.files;

    // Mostrar previsualización de imágenes
    for (const file of files) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('d-block');
            img.style.height= '250px';

            const item = document.createElement('div');
            item.classList.add('carousel-item');

            // Marcar el primer elemento como activo
            if (document.getElementById('imagePreviewInner').childElementCount === 0) {
                item.classList.add('active');
            }

            item.appendChild(img);
            document.getElementById('imagePreviewInner').appendChild(item);
        };

        reader.readAsDataURL(file);
    }
}

function agregarDeporte() {
    var select = document.getElementById("deporte");
    var etiquetasContainer = document.getElementById("etiquetas-container");
    var inputHidden = document.getElementById("etiquetas-hidden");

    var deporteId = select.value; // Capturamos el ID del deporte seleccionado
    var deporteNombre = select.options[select.selectedIndex].text; // Capturamos el nombre del deporte seleccionado

    // Crear la etiqueta visual
    var etiqueta = document.createElement("div");
    etiqueta.classList.add("etiqueta");
    etiqueta.textContent = deporteNombre; // Mostramos el nombre del deporte en la etiqueta
    etiqueta.setAttribute("data-deporte-id", deporteId); // Almacenamos el ID del deporte como un atributo personalizado

    // Crear el botón "x" para eliminar la etiqueta
    var botonEliminar = document.createElement("span");
    botonEliminar.textContent = "x";
    botonEliminar.classList.add("eliminar-etiqueta");
    botonEliminar.onclick = function() {
        etiqueta.remove();
        actualizarInputHidden();
    };

    // Agregar el botón de eliminar a la etiqueta
    etiqueta.appendChild(botonEliminar);

    // Agregar la etiqueta al contenedor de etiquetas
    etiquetasContainer.appendChild(etiqueta);

    // Actualizar el contenido del input hidden
    actualizarInputHidden();
}

function actualizarInputHidden() {
    var etiquetas = document.querySelectorAll(".etiqueta");
    var etiquetasIDs = Array.from(etiquetas).map(function(etiqueta) {
        return etiqueta.getAttribute("data-deporte-id");
    });
    var inputHidden = document.getElementById("etiquetas-hidden");
    inputHidden.value = etiquetasIDs.join(","); // Enviamos solo los IDs separados por coma
}