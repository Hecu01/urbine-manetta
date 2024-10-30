<!-- deportes disponibles -->
<div class="modal fade" id="editar-etiquetas-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 400px; max-width:700px">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title uppercase" style="font-weight: bolder" id="exampleModalLabel">
                    ETIQUETAS DEPORTIVAS</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body  ">
                <div class="flex justify-center">

                    <!-- Para adultos-->
                    <div id="deportes-adultos">
                        @foreach ($deportes as $index => $deporte)
                            @php
                                $deporteAsociado = $articulo->deportes->firstWhere('pivot.deporte_id', $deporte->id);
                            @endphp
                    
                            @if ($index % 7 == 0)
                                <div class="row" style="display: contents;">
                            @endif
                    
                            <div class="deporte-item">
                                @if ($deporteAsociado)
                                    {{-- deporte asociado existente --}}
                                    <input type="hidden" name="deporte_ids[]" value="{{ $deporteAsociado->id }}">
                                    <input type="checkbox" checked name="deportes[]" id="deporte-{{ $deporteAsociado->id }}" value="{{ $deporteAsociado->id }}" class="form-check-input">
                                    <label for="deporte-{{ $deporteAsociado->id }}" class="mx-1">{{ $deporteAsociado->deporte }}</label>
                                @else
                                    {{-- deporte no esta asociado  --}}
                                    <input type="hidden" name="deporte_ids[]" value="{{ $deporte->id }}">
                                    <input type="checkbox" name="deportes[]" id="deporte-{{ $deporte->id }}" value="{{ $deporte->deporte }}" class="form-check-input">
                                    <label for="deporte-{{ $deporte->id }}" class="mx-1">{{ $deporte->deporte }}</label>
                                @endif
                            </div>
                    
                            @if ($index % 7 == 6)
                                </div>
                            @endif
                        @endforeach
                    
                        @if ($deportes->count() % 7 != 0)
                            </div>
                        @endif
                    </div>
                    



                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<style>
    #deportes-adultos {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* Tres columnas */
        gap: 10px; /* Espacio entre elementos */
    }

    #deportes-adultos .deporte-item {
        box-sizing: border-box; /* Asegura que el padding y el border no afecten el tamaño */
        padding: 5px; /* Añade un poco de padding para el espacio entre elementos */
    }
</style>