<!-- Talles disponibles -->
<div class="modal fade"  id="editar-descripcion-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Actualizá la descipción</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body  ">
                


                <div class="">
                    <textarea name="descripcion" id="" class="form-control" cols="40" rows="5" placeholder="">{{$articulo->descripcion}} </textarea>
                </div>
                <hr>
                <div class="">
                    <h6>Descripción actual:</h6>
                    <blockquote>
                        "{{$articulo->descripcion}}"
                    </blockquote>
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