<!-- calzados disponibles -->
<div class="modal fade" id="editar-talles-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 400px; max-width:700px">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title uppercase" style="font-weight: bolder" id="exampleModalLabel">
                    Talles disponibles</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body  ">
                <div class="flex justify-center">

                    <!-- Para adultos-->
                    <div id="calzados-adultos">
                        <h3 class="text-center">Para Adultos</h3>
                        <div class="" style="max-height:400px; overflow:auto; width:500px">

                            <table class="table table-bordered">
                                <thead>
                                    <td>Activo</td>
                                    <td>Talle</td>
                                    <td>Género</td>
                                    <td>Stock</td>
                                </thead>
                                <tbody>
    
                                    @foreach ($talles as $talle)
                                        @php
                                            $talleAsociado = $articulo->talles->firstWhere('pivot.talle_id',
                                                $talle->id,
                                            );
                                        @endphp
            
                                        <tr>
                                            @if ($talleAsociado)
                                            
                                                {{-- <input type="hidden" name="generoMyF[]" value="{{ $talleAsociado->genero }}"> --}}
                                                <input type="hidden" name="talle_ids[]" value="{{ $talleAsociado->id }}">
                                                <td>
                                                    <input type="checkbox" checked name="talles[]" id="talle-{{ $talleAsociado->id }}" value="{{ $talleAsociado->id }}" class="form-check-input">
                                                </td>
                                                <td>
                                                    <label for="talle-{{ $talleAsociado->id }}" class="mx-1">
                                                        Talle {{ $talleAsociado->talle_ropa }} 
                                                        
                                                    </label>
    
                                                </td>
                                                <td class="uppercase">
                                                   {{ $talleAsociado->genero }}
                                                </td>
                                                <td>
                                                    <input type="text" name="stocks[]" id="stock-{{ $talleAsociado->id }}" class="border-1  border-cyan-600/[0.5] text-small input-suma p-0 px-2" style="width:70px;height:30px;" value="{{ $talleAsociado->pivot->stocks }}">
    
                                                </td>
                                            @else
                                                {{-- <input type="hidden" name="generoMyF[]" value="{{ $talle->genero }}"> --}}

                                                <input type="hidden" name="talle_ids[]" value="{{ $talle->id }}">
                                                <td>
                                                    <input type="checkbox" name="talles[]" id="talle-{{ $talle->id }}" value="{{ $talle->id }}" class="form-check-input">
                                                </td>
                                                <td>
                                                    <label for="talle-{{ $talle->id }}" class="mx-1">Talle {{ $talle->talle_ropa }} </label>
                                                </td>
                                                <td class="uppercase">
                                                    {{ $talle->genero }}
                                                </td>
                                                <td>
                                                    <input type="text" name="stocks[]" id="stock-{{ $talle->id }}" disabled class="border-1 text-center border-cyan-600/[0.5] text-small input-suma p-0" style="width:70px;height:30px;">
    
                                                </td>
            
    
                                                {{-- <label class="mx-1">$ </label>
    
                                                <input type="text" name="precios[]" id="precio-{{ $talle->id }}" disabled class="border-1  text-center border-cyan-600/[0.5] text-small input-sumado p-0" style="width:100px;height:30px;"> --}}
                                            @endif
    
                                        </tr>
    
                                    @endforeach
    
    
                                </tbody>
                            </table>
                        </div>






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