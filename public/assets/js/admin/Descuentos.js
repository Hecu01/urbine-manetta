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

    $(document).ready(function() {
        var originalTable3 = $('#resultsTable3').html();
    
        // Búsqueda dinámica sin dar clic en buscar
        $('#searchInput3').on('input', function() {
            var searchTerm3 = $(this).val().trim();
    
            if (searchTerm3 === '') {
                $('#resultsTable3').html(originalTable3);
                return;
            }
    
            // Realiza la búsqueda si el campo no está vacío
            $.ajax({
                url: '/descuento',
                method: 'GET',
                data: { searchTerm3: searchTerm3 },
                success: function(response) {
                    // Vaciar la tabla y mantener solo los encabezados
                    $('#resultsTable3').find('tr:gt(0)').remove();
    
                    // Iterar sobre los resultados de la búsqueda
                    response.results3.forEach(function(resultado) {
                        // Formatear el precio
                        var precioFormateado = `$ ${resultado.precio.toLocaleString()}`;
    
                        // Crear fila y celda para la imagen
                        var row = $('<tr>');
                        var tdImagen = $('<td>');
                        
                        // Si tiene fotos, mostrar la primera; si no, mensaje por consola
                        if (resultado.fotos && resultado.fotos.length > 0) {
                            var primeraFoto = resultado.fotos[0];
                            var imagen2 = $('<img>')
                                .attr('src', '/productos/' + primeraFoto.ruta)
                                .attr('alt', resultado.nombre)
                                .attr('width', '70px')
                                .attr('height', '70px');
                            tdImagen.append(imagen2);
                        } else {
                            console.log(`No hay fotos disponibles para el artículo con ID ${resultado.id}`);
                        }
    
                        // Agregar las celdas a la fila
                        row.append(tdImagen);
                        row.append($('<td>').text(resultado.id));
                        row.append($('<td>').text(resultado.nombre));
                        row.append($('<td>').text(precioFormateado).addClass('precio'));
    
                        // Celda de botones según si hay descuento o no
                        var tdBotones = $('<td>');
                        var botonDescuento;
                        if (resultado.descuento_existe) {
                            botonDescuento = $('<a>')
                                .attr('href', '#')
                                .text('Activo ')
                                .addClass('btn btn-warning btn-sm')
                                .attr('title', 'Descuento está activo')
                                .append($('<i>').addClass('fa-solid fa-triangle-exclamation'))
                                .on('click', function(e) {
                                    e.preventDefault(); // Evita el comportamiento por defecto del enlace
                                    alert('¡El descuento está activo!');
                                });
                        } else {
                            botonDescuento = $('<a>')
                                .attr('href', '/admin/descuento/producto/' + resultado.id)
                                .text('Descuento ')
                                .addClass('btn btn-success btn-sm')
                                .attr('title', 'Agregar descuento')
                                .append($('<i>').addClass('fa-solid fa-pen-to-square'));
                        }
                        tdBotones.append(botonDescuento);
                        row.append(tdBotones);
    
                        // Agregar la fila a la tabla
                        $('#resultsTable3').append(row);
                    });
                },
                error: function(error) {
                    console.error('Error al realizar la búsqueda:', error);
                }
            });
        });
    });
    

    
});