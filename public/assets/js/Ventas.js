$(document).ready(function() {

    // Evento de cambio en el select de artículo
    $("#articulo").change(function() {
        // Obtener el precio del artículo seleccionado
        var precio = $(this).find("option:selected").data("precio");
        // Actualizar el valor del input de precio unitario
        $("#precio_unitario").val(precio);
 
    });

    var ventasArray = []; // Array para almacenar las ventas
    var sumatoria = 0;

    // Evento de clic en el botón "Añadir"
    $(".btn-primary").click(function() {
        var precio_unitario = parseFloat($("#precio_unitario").val());
        var unidades = parseFloat($(".form-control[name='unidades']").val());
    
        // Verificar si los valores son numéricos
        if (!isNaN(precio_unitario) && !isNaN(unidades)) {
            var importe = precio_unitario * unidades;
    
            // Actualizar el total a pagar
            var totalActual = parseFloat($('#total-a-pagar').text()) || 0;
            $('#total-a-pagar').text(totalActual + importe);
    
            var articulo = $(".form-select[name='articulo']").val();
    
            // Obtener el nombre del artículo seleccionado
            var nombreArticulo = $(".form-select[name='articulo'] option:selected").text();
            // Agregar los datos a la tabla y al array
            if (articulo && unidades) {
                ventasArray.push({
                    precio_unitario: precio_unitario,
                    importe: importe,
                    articulo: articulo,
                    unidades: unidades

                });
                console.log(ventasArray);
                // Actualizar total a pagar
                actualizarTotal();
                // Agregar los datos a la tabla
                $(".tabla-ventas tbody").append(
                    "<tr>" +
                    "<td>" + articulo + "</td>" +
                    "<td>" + nombreArticulo + "</td>" +
                    "<td>" + unidades + "</td>" +
                    "<td>$ " + precio_unitario + "</td>" +
                    "<td>$ " + importe + "</td>" +
                    "<td><button class='btn btn-danger btn-sm eliminar'> <i class='fa-solid fa-trash'></i> </button></td>" +
                    "</tr>"
                );
    
                // Limpiar campos después de agregar la venta
                $("#unidades").val('1')
                $(".form-select[name='articulo']").val('');
                $("#precio_unitario").val('');
            } else {
                alert("Seleccione un producto.");
            }
        } else {
            alert("Ingrese valores numéricos válidos para precio unitario y unidades.");
        }
    });
    
    // Evento de clic en el botón de eliminar
    $(document).on('click', '.eliminar', function() {
        var rowIndex = $(this).closest('tr').index();
        ventasArray.splice(rowIndex, 1);
        $(this).closest('tr').remove();
        // Actualizar total a pagar
        actualizarTotal();
    });

    // Función para actualizar el total a pagar
    function actualizarTotal() {
        var total = 0;
        for (var i = 0; i < ventasArray.length; i++) {
            total += ventasArray[i].importe;
        }
        $('#total-a-pagar').text(total.toFixed(2)); // Mostrar total con dos decimales
        console.log('total actualizado')
        console.log(total);
    }

});
