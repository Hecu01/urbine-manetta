$(document).ready(function(){

    $('#SelectTypeProduct').change(function () {
        var selectedOption = $(this).val();
        if (selectedOption === 'calzado') {
            $('#agregar-calzados').show();
        } else {
            $('#agregar-calzados').hide();
        }
    });

});