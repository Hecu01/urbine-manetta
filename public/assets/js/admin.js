$(document).ready(function(){

    /* 
    |
    |--------------------------------------------------------------------------
    | URL - agregar-articulo-deportivo
    |--------------------------------------------------------------------------
    |
    */ 


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
    });
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