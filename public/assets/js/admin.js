$(document).ready(function(){
    /* 
    |
    |--------------------------------------------------------------------------
    | Sportivo - Artículos Deportivos
    |--------------------------------------------------------------------------
    |
    */ 
    // Mostrar u ocultar el boton busqueda de articulos deportivos
    $("#formulario").on("click", function() {
        $("#busqueda-artdeport").hide();
    })
    $("#accesorios").on("click", function() {
        $("#busqueda-artdeport").show();
    })
    $("#calzados").on("click", function() {
        $("#busqueda-artdeport").show();
    })

    // Modal de "está seguro que quiere eliminarlo?"
    var modalEliminar = document.getElementById('modalEliminar');
    modalEliminar.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = document.getElementById('formEliminar');
        form.action = '/admin/articulo-deportivo/' + id; // Ruta de eliminación de productos en Laravel
    });


    // tabla
    // // dar un mensaje de que es normal el sólo lectura
    // $("#mostrarToastr").on("click", function() {
    //     toastr["error"]("Producto eliminado correctamente", "Mensaje")

    //     toastr.options = {
    //     "closeButton": false,
    //     "debug": false,
    //     "newestOnTop": false,
    //     "progressBar": false,
    //     "positionClass": "toast-bottom-center",
    //     "preventDuplicates": false,
    //     "onclick": null,
    //     "showDuration": "300",
    //     "hideDuration": "1000",
    //     "timeOut": "5000",
    //     "extendedTimeOut": "1000",
    //     "showEasing": "swing",
    //     "hideEasing": "linear",
    //     "showMethod": "fadeIn",
    //     "hideMethod": "fadeOut"
    //     }
    // });

    // // Eliminar la tupla utilizando AJAX
    // $.ajax({
    //     url: '/eliminar-tupla/ID_DE_LA_TUPLA_A_ELIMINAR',
    //     type: 'DELETE',
    //     success: function(response) {
    //         toastr.error(response.success, "Mensaje");
    //     },
    //     error: function(xhr, status, error) {
    //         // Manejar el error si la eliminación falla
    //         console.error(xhr.responseText);
    //     }
    // });

    // Calzados niños y adultos
    $('#publico-dirigido').change(function () {
        var opcion_elegida = $(this).val();

        if (opcion_elegida === "adultos"){
            $('#calzados-ninios').hide();
            $('#separador').hide();
            $('#calzados-adultos').show();
            $('#msj').hide();
        }else if(opcion_elegida === "niños"){
            $('#calzados-adultos').hide();
            $('#calzados-ninios').show();
            $('#msj').hide();
        }else if(opcion_elegida === "ambos"){
            $('#calzados-ninios').show();
            $('#separador').show();
            $('#calzados-adultos').show();
            $('#msj').hide();
        }else{
            $('#calzados-ninios').hide();
            $('#separador').hide();
            $('#calzados-adultos').hide();
            $('#msj').show();
        }

    });
    // Formulario 
    // Selecciona el tipo de producto
    $('#SelectTypeProduct').change(function () {

        var selectedOption = $(this).val();
        if (selectedOption === 'calzado') {
            // valor true
        
            // muestra el btn agregar calzados
            $('#agregar-calzados').show();

            // activa sólo lectura el stock principal 
            $("#stock_input").prop('readonly', true).val('');
            $("#stock_input").addClass('estilo-readonly');

            // dar un mensaje de que es normal el sólo lectura
            $("#stock_input").on("click", function() {
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
                    toastr["info"]("El campo STOCK es la sumatoria de todos los calzados, no se puede editar", "Información");
                }
            });


        } else {
            $('#agregar-calzados').hide();
            $("#stock_input").prop('readonly', false).val('');
            $("#stock_input").removeClass('estilo-readonly');
            $(".input-suma").val('');
        }

    });

    $(".input-suma").on("input", function(){
        var suma = 0;
        $(".input-suma").each(function(){
            if(!isNaN(this.value) && this.value.length != 0) {
                suma += parseFloat(this.value);
            }
        });
        $("#stock_input").val(suma);
        $("#stock_input_ropa").val(suma);
    });

    /* 
    |
    |--------------------------------------------------------------------------
    | Sportivo - ropa deportiva
    |--------------------------------------------------------------------------
    |
    */ 
    $("#stock_input_ropa").prop('readonly', true).val('');

    

});
function eliminarArticulo() {
    var form = $('#deleteForm');
    var id = form.data('id');

    $.ajax({
        method: 'DELETE',
        url: '/admin/agregar-articulo-deportivo/' + id,
        data: form.serialize(), // Puedes enviar datos adicionales si es necesario
        success: function(response) {
            // Manejar la respuesta del servidor
            console.log(response);
            // Puedes actualizar la interfaz de usuario aquí según sea necesario
        },
        error: function(error) {
            console.error(error);
        }
    });
}


// Asegúrate de que este código se ejecute después de que se haya cargado la página
document.addEventListener("DOMContentLoaded", function() {
    // Obtén todos los checkboxes
    var checkboxes = document.querySelectorAll('input[type="checkbox"][name^="calzados"]');

    // Agrega un evento change a cada checkbox
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // Obtén el ID del calzado correspondiente
            var calzadoId = checkbox.id.split('-')[1];

            // Obtén el campo de texto correspondiente
            var stockInput = document.getElementById('stock-' + calzadoId);

            // Habilita o deshabilita el campo de texto según el estado del checkbox
            stockInput.disabled = !checkbox.checked;
        });
    });
});
// Asegúrate de que este código se ejecute después de que se haya cargado la página
document.addEventListener("DOMContentLoaded", function() {
    // Obtén todos los checkboxes
    var checkboxes2 = document.querySelectorAll('input[type="checkbox"][name^="talles"]');

    // Agrega un evento change a cada checkbox
    checkboxes2.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // Obtén el ID del calzado correspondiente
            var talleId = checkbox.id.split('-')[1];

            // Obtén el campo de texto correspondiente
            var stockInput = document.getElementById('stock-' + talleId);

            // Habilita o deshabilita el campo de texto según el estado del checkbox
            stockInput.disabled = !checkbox.checked;
        });
    });
});



// Espera a que el contenido HTML esté completamente cargado
// Agrega el script para controlar la visibilidad del popover para cada tupla -->
document.addEventListener("DOMContentLoaded", function() {
    // Agrega un evento clic a todos los enlaces para alternar la visibilidad del popover
    document.querySelectorAll('[id^="popoverButton-"]').forEach(function(popoverButton) {
        var popoverContentId = popoverButton.id.replace('popoverButton-', 'popoverContent-');
        var popoverContent = document.getElementById(popoverContentId);

        popoverButton.addEventListener('click', function() {
            // Oculta todos los popovers antes de mostrar el actual
            document.querySelectorAll('[id^="popoverContent-"]').forEach(function(element) {
                element.classList.add('hidden');
            });

            // Muestra el popover actual
            popoverContent.classList.toggle('hidden');
        });
    });

    // Cierra el popover si se hace clic fuera de él
    document.addEventListener('click', function(event) {
        var isPopoverButton = event.target.matches('[id^="popoverButton-"]');
        var isPopoverContent = event.target.matches('[id^="popoverContent-"]');

        if (!isPopoverButton && !isPopoverContent) {
            document.querySelectorAll('[id^="popoverContent-"]').forEach(function(element) {
                element.classList.add('hidden');
            });
        }
    });
});