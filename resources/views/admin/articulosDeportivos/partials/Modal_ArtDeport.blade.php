<!-- calzados disponibles -->
<div class="modal fade"  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 400px; max-width:700px">
        <div class="modal-content" >
            <div class="modal-header">
                <h3 class="modal-title uppercase" style="font-weight: bolder" id="exampleModalLabel">Calzados disponibles</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body  ">
                <div class="flex justify-center">
                    <div class="">
                        <h5 class="text-center" style="margin-right: 5px">Disponibilidad| - |Talle del Calzado| - |Cantidad Disponible</h5>

                        <div class="contenedor-tabla" style="max-height: 400px; overflow:auto; width:500px">
                            <table class="table table-bordered">
                                <thead>
                                    <td>Disponibilidad</td>
                                    <td>Talle del Calzado</td>
                                    <td>Cantidad disponible</td>
                                </thead>
                                <tbody>
                                    @foreach( $calzados as $calzado)
 
                                        <tr>
                                            <td>
                                                <input type="hidden" name="calzado_ids[]" value="{{$calzado->id}}">
                                                <input type="checkbox" name="calzados[]" id="calzado-{{$calzado->id}}" value="{{ $calzado->calzado }}" class="form-check-input" >

                                            </td>
                                            <td>
                                                <label for="calzado-{{$calzado->id}}" class="mx-1">N° {{ $calzado->calzado }}</label>

                                            </td>
                                            <td>
                                                <input type="text" value="0" min="0" disabled name="stocks[]" id="stock-{{$calzado->id}}" class="border-1  text-center border-cyan-600/[0.5] text-small input-suma p-0" style="width:40px;height:22px; "  oninput="validarCantidad(this)">

                                            </td>
                                        </tr>
                                                
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<style>
    input:disabled{
         /* Estilos para el modo de solo lectura */
        background-color: #f2f2f2; /* Cambia el color de fondo a un tono gris */
        border: 1px solid #ccc; /* Añade un borde gris */
        cursor: not-allowed; /* Cambia el cursor a 'no permitido' */
        /* Agrega otros estilos según sea necesario */
    }
</style>
<script>
        // Validar cantidad a comprar
    function validarCantidad(input) {
        const min = parseInt(input.min);
        let value = input.value;

        // Elimina caracteres no numéricos
        value = value.replace(/[^0-9]/g, '');

        // Convierte el valor a número y verifica el rango
        value = parseInt(value);
        if (isNaN(value) || value < min) {
            input.value = min;
        } else if (value > max) {
            input.value = max;
        } else {
            input.value = value;
        }
    }
</script>
