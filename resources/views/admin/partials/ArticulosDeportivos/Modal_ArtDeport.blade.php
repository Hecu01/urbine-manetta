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
                    <div id="msj" >
                        <h2>¡Seleccioná el público dirigido!</h2>
                    </div>
                    <!-- left-->
                    <div  id="calzados-ninios" style="display:none;">
                        <h3 class="text-center">Para Niños</h3>
                        @foreach( $calzados as $calzado)
                            @if($calzado->calzado <= 34)
                                <div class=" flex my-1">
                                    <div class="">

                                        <input type="hidden" name="calzado_ids[]" value="{{$calzado->id}}">
                                        <input type="checkbox" name="calzados[]" id="calzado-{{$calzado->id}}" value="{{ $calzado->calzado }}" class="form-check-input" >
                                        <label for="calzado-{{$calzado->id}}" class="mx-1">N° {{ $calzado->calzado }}</label>
                                        <input type="text" disabled name="stocks[]" id="stock-{{$calzado->id}}" class="border-1  text-center border-cyan-600/[0.5] text-small input-suma p-0" style="width:40px;height:22px; " >
                                    </div>
                                    <div class="mx-2">

                                        <label for="calzado-{{$calzado->id}}" class="mx-1">$ </label>
                                        <input type="text" disabled name="precios[]" id="precio-{{$calzado->id}}" class="border-1  text-center border-cyan-600/[0.5] text-small input-sumado p-0" style="width:100px;height:22px; " >

                                    </div>

                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div id="separador" class="mx-3" style="border-right:1px solid #00000096; display:none;"></div>
                    <!-- center-->
                    <div  id="calzados-adultos" style="display:none;">
                        <h3 class="text-center">Para Adultos</h3>

                        @foreach($calzados as $calzado)
                            @if($calzado->calzado > 34)
                                <div class="flex my-1">
                                    <div class="">
                                        <input type="hidden" name="calzado_ids[]" value="{{$calzado->id}}">
                                        <input type="checkbox" name="calzados[]" id="calzado-{{$calzado->id}}" value="{{ $calzado->calzado }}" class="form-check-input" >
                                        <label for="calzado-{{$calzado->id}}" class="mx-1">N° {{ $calzado->calzado }}</label>
                                        <input type="text" disabled name="stocks[]" id="stock-{{$calzado->id}}" class="border-1  text-center border-cyan-600/[0.5] text-small input-suma p-0" style="width:40px;height:22px; " >
                                        

                                    
                                    </div>
                                    <div class="mx-2">

                                        <label for="calzado-{{$calzado->id}}" class="mx-1">$ </label>
                                        <input type="text" disabled name="precios[]" id="precio-{{$calzado->id}}" class="border-1  text-center border-cyan-600/[0.5] text-small input-sumado p-0" style="width:100px;height:22px; " >

                                
                                    </div>
                                </div>        
                            @endif
                        @endforeach
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
