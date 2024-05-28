$(document).ready(function(){
    // Mostrar u ocultar el boton busqueda de articulos deportivos

    $(".boton-categoria").hover(function(){
        $("#contenedor-hombres").stop().fadeIn();;
    }, function(){
        $("#contenedor-hombres").stop().fadeOut();;
    });
});