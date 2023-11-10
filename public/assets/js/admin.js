$(document).ready(function(){
    // Selecciona el tipo de producto
    $('#SelectTypeProduct').change(function () {

        var selectedOption = $(this).val();
        if (selectedOption === 'calzado') {
            $('#agregar-calzados').show();
            $("#stock_input").prop('disabled', true).val('');

        } else {
            $('#agregar-calzados').hide();
            $("#stock_input").prop('disabled', false).val('');
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