<!-- Talles disponibles -->
<div class="modal fade"  id="modalTalles" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Agregá talles disponibles</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body  ">
                <div class="overflow-auto"style="max-height: 300px">
                
                    <h4 class="text-xl text-center border-b-2 pb-2"> Disponibilidad - Talles - Unidades</h4>
                    <div class="flex justify-center">
                        <!-- center-->
                        <div class="mr-3 text-center" >
                            <h5>Femenino arriba</h5>
                            @foreach($talles as $talle)
                                @if($talle->genero == "femenino" && $talle->cintura_para == "arriba" )
                                    <div class="mx-3  my-1">
                                        <input type="hidden" name="talle_ids[]" value="{{$talle->id}}">
                                        <input type="checkbox" name="talles[]" id="talle-{{$talle->id}}" value="{{ $talle->talle_ropa }}" class="form-check-input" >
                                        <label for="talle-{{$talle->id}}" class="mx-1">Talle {{ $talle->talle_ropa }}</label>
                                        <input type="text" disabled name="stocks[]" id="stock-{{$talle->id}}" class="border-1  text-center border-cyan-600/[0.5] text-small input-suma p-0" style="width:40px;height:22px; " >
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        
                        <div class="mr-3 border-l-4  text-center" >
                            <h5>Masculino arriba</h5>
                            @foreach($talles as $talle)
                                @if($talle->genero == "masculino" && $talle->cintura_para == "arriba" )
                                    <div class="mx-3  my-1">
                                        <input type="hidden" name="talle_ids[]" value="{{$talle->id}}">
                                        <input type="checkbox" name="talles[]" id="talle-{{$talle->id}}" value="{{ $talle->talle_ropa }}" class="form-check-input" >
                                        <label for="talle-{{$talle->id}}" class="mx-1">Talle {{ $talle->talle_ropa }}</label>
                                        <input type="text" disabled name="stocks[]" id="stock-{{$talle->id}}" class="border-1  text-center border-cyan-600/[0.5] text-small input-suma p-0" style="width:40px;height:22px; " >
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        
                    </div>
                    <div class="flex justify-center mt-2 border-t-4 pt-2">
                    
                        <!-- center-->
                        <div class="mr-3 text-center" >
                            <h5>Femenino abajo</h5>
                            @foreach($talles as $talle)
                                @if($talle->genero == "femenino" && $talle->cintura_para == "abajo" )
                                    <div class="mx-3  my-1">
                                        <input type="hidden" name="talle_ids[]" value="{{$talle->id}}">
                                        <input type="checkbox" name="talles[]" id="talle-{{$talle->id}}" value="{{ $talle->talle_ropa }}" class="form-check-input" >
                                        <label for="talle-{{$talle->id}}" class="mx-1">Talle {{ $talle->talle_ropa }}</label>
                                        <input type="text" disabled name="stocks[]" id="stock-{{$talle->id}}" class="border-1  text-center border-cyan-600/[0.5] text-small input-suma p-0" style="width:40px;height:22px; " >
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        
                        <div class="mr-3 border-l-4  text-center" >
                            <h5>Masculino abajo</h5>
                            @foreach($talles as $talle)
                                @if($talle->genero == "masculino" && $talle->cintura_para == "abajo" )
                                    <div class="mx-3  my-1">
                                        <input type="hidden" name="talle_ids[]" value="{{$talle->id}}">
                                        <input type="checkbox" name="talles[]" id="talle-{{$talle->id}}" value="{{ $talle->talle_ropa }}" class="form-check-input" >
                                        <label for="talle-{{$talle->id}}" class="mx-1">Talle {{ $talle->talle_ropa }}</label>
                                        <input type="text" disabled name="stocks[]" id="stock-{{$talle->id}}" class="border-1  text-center border-cyan-600/[0.5] text-small input-suma p-0" style="width:40px;height:22px; " >
                                    </div>
                                @endif
                            @endforeach
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