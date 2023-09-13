<div class="">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        agregar producto
    </button>
    
    <!-- Modal -->
    <form class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Todo el contenido-->
                    
                    <form action="">
                        <div class="" style="display: flex; justify-content: space-between; align-items:center; position: relative;">
            
                            <label class="custom-file-upload" style="text-align:center; margin:0px 30px; margin-right:20px;">
                                <input type="file" id="foto-aspirante" class="btn btn-secondary" name="foto_aspirante" onchange="previewImage(event, '#imgPreview')" >
                                Subir foto
                            </label>
                            <div class="container d-flex justify-content-center" style="height: 130px;width:130px;  display:flex; justify-content: center; box-shadow: 0px 0px 1px #000; background:#fff">
                                <a href="#" type="button">
                                    <img id="imgPreview" style="height: 130px; width:130px;">
                                </a>
                            </div>
                            <span style="font-size: 0.67em;position: absolute; left:15.4em;top: 12.2em; color:grey;text-align:center" >Foto 4x4 de el/la aspirante</span>
                                    
                        </div>
                
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <span class="input-group-text">0.00</span>
                            <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                        </div>
                    </form>

                    <!--Todo el contenido-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
    
</div>



<script>
    // mostrar imagen en el form

    function previewImage(event, querySelector){

    //Recuperamos el input que desencadeno la acción
    const input = event.target;

    //Recuperamos la etiqueta img donde cargaremos la imagen
    $imgPreview = document.querySelector(querySelector);

    // Verificamos si existe una imagen seleccionada
    if(!input.files.length) return

    //Recuperamos el archivo subido
    file = input.files[0];

    //Creamos la url
    objectURL = URL.createObjectURL(file);

    //Modificamos el atributo src de la etiqueta img
    $imgPreview.src = objectURL;
            
    }
</script>