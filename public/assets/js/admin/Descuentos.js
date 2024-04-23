$(document).ready(function(){
    /* 
    |
    |--------------------------------------------------------------------------------
    | Sportivo - Descuentos
    |--------------------------------------------------------------------------------
    |
    */ 
    /* Pagina aplicando descuento */
    // Manejador del evento keyup para calcular la diferencia cuando se ingresa texto en el input
    $('#precio-descontando').on('keyup', function() {
        // Obtenemos el valor de los elementos
        var precioRegular = parseFloat($('#precio-regular').text());
        var precioDescontando = parseFloat($(this).val());

        // Verificamos si los valores son válidos
        if (!isNaN(precioRegular) && !isNaN(precioDescontando)) {
            // Calculamos la diferencia
            var precioDescontado = precioRegular - precioDescontando;
            // Calculamos el porcentaje de descuento
            // ("descuento del" / "precio regular") *100

            var porcentajeDescuento = ( precioDescontado/ precioRegular ) * 100;
            // Mostramos el resultado en los spans correspondientes
            $('#precio-descontado').text(precioDescontado.toFixed(2)); // Ajustamos a dos decimales
            $('#precio-porcentaje').text(porcentajeDescuento.toFixed(2)); // Ajustamos a dos decimales
        } else {
            // Si uno de los valores no es un número válido, mostramos un mensaje de error
            $('#precio-descontado').text('');
            $('#precio-porcentaje').text('');
        }
    });
    
    // Actualizar el valor del input con el valor del span al cargar la página
    $('#input_precio_descontado').val($('#precio-descontado').text());

    // Manejar cambios en el span para actualizar el valor del input
    $('#precio-descontado').on('DOMSubtreeModified', function() {
        $('#input_precio_descontado').val($(this).text());
    });

    // Actualizar el valor del input con el valor del span al cargar la página
    $('#input_precio_porcentaje').val($('#precio-porcentaje').text());

    // Manejar cambios en el span para actualizar el valor del input
    $('#precio-porcentaje').on('DOMSubtreeModified', function() {
        $('#input_precio_porcentaje').val($(this).text());
    });

    /* Página index descuentos */

    var originalTable3 = $('#resultsTable3').html();

    // Busqueda tipeando sin dar a buscar 
    $('#searchInput3').on('input', function() {
        var searchTerm3 = $(this).val();

        // está vacío el input:search?
        if (searchTerm3.trim() === '') {
            // Restaura la tabla original cuando el campo de búsqueda está vacío
            $('#resultsTable3').html(originalTable3);
            return;
        }
        else{
            $.ajax({
                url: '/descuento',
                method: 'GET',
                data: {
                    searchTerm3: searchTerm3
                },
                success: function(response) {
                    // Elimina todas las filas de datos excepto la primera (encabezados)
                    $('#resultsTable3 tr:gt(0)').remove();


                    // Actualiza la tabla con los resultados de la búsqueda
                    $.each(response.results3, function(index, resultado) {
                        // Formatear el precio con separadores de miles y el símbolo de peso
                        var precioFormateado = '$ ' + resultado.precio.toLocaleString();
                        var row = $('<tr>');
                    
                        // Agregar la imagen como una nueva celda de la tabla
                        var imagen2 = $('<img>').attr('src', '/producto/' + resultado.foto).attr('alt', resultado.nombre).attr('width', '70px').attr('height', '70px');
                        var tdImagen = $('<td>').append(imagen2);
                        row.append(tdImagen);
                        $('<td>').text(resultado.id).appendTo(row);
                        $('<td>').text(resultado.nombre).appendTo(row);
                        $('<td>').text(precioFormateado).addClass('precio').appendTo(row);




                    
                        // Verificar si el descuento existe
                        if (resultado.descuento_existe) {
                            // Crear el botón de editar
                            var botonDescuento = $('<a>').attr('href', '#')
                            .text('Activo ')
                            .addClass('btn btn-warning btn-sm')
                            .attr('title', 'Descuento está activo')
                            .append($('<i>').addClass('fa-solid fa-triangle-exclamation'))    
                            .click(function() {
                                alert('¡El descuento está activo!');
                            });
                            // Agregar los botones a la celda correspondiente
                            var tdBotones = $('<td>').append(botonDescuento);
                            
                            // Agregar la celda de botones a la fila
                            row.append(tdBotones);

                        } else {
                            // Crear el botón de editar
                            var botonDescuento = $('<a>').attr('href', '/admin/descuento/producto/' + resultado.id)
                            .text('Descuento ')
                            .addClass('btn btn-success btn-sm')
                            .attr('title', 'Descuento')
                            .append($('<i>').addClass('fa-solid fa-pen-to-square'))

                            // Agregar los botones a la celda correspondiente
                            var tdBotones = $('<td>').append(botonDescuento);
                            
                            // Agregar la celda de botones a la fila
                            row.append(tdBotones);

                        }


                        // Agregar la fila a la tabla
                        row.appendTo($('#resultsTable3'));
                    });
                    
                }
            });
        }

    });

    
});