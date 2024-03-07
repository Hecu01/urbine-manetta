$(document).ready(function(){

    /* 
    |
    |--------------------------------------------------------------------------------
    | Sportivo - ropa deportiva
    |--------------------------------------------------------------------------------
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