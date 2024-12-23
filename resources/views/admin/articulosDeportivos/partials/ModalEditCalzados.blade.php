<!-- calzados disponibles -->
<div class="modal fade" id="editar-calzados-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 400px; max-width:700px">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title uppercase" style="font-weight: bolder" id="exampleModalLabel">
                    Calzados disponibles</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body  ">
                <div class="flex justify-center">

                    <!-- Para adultos-->
                    <div id="calzados-adultos">
                        <h3 class="text-center">Para Adultos</h3>

                        @foreach ($calzados as $calzado)
                            @php
                                $calzadoAsociado = $articulo->calzados->firstWhere('pivot.calzado_id',
                                    $calzado->id,
                                );
                            @endphp

                            <div class="mx-3 my-1">
                                @if ($calzado->calzado < 47)
                                    @if ($calzadoAsociado)
                                        {{-- Calzado existente --}}
                                        <input type="hidden" name="calzado_ids[]" value="{{ $calzadoAsociado->id }}">
                                        <input type="checkbox" checked name="calzados[]" id="calzado-{{ $calzadoAsociado->id }}" value="{{ $calzadoAsociado->calzado }}" class="form-check-input">
                                        <label for="calzado-{{ $calzadoAsociado->id }}" class="mx-1">N° {{ $calzadoAsociado->calzado }}</label>

                                        <input type="text" name="stocks[]" id="stock-{{ $calzadoAsociado->id }}" class="border-1  border-cyan-600/[0.5] text-small input-suma p-0 px-2" style="width:70px;height:30px;" value="{{ $calzadoAsociado->pivot->stocks }}">
                                    @else
                                        {{-- Calzado no existente --}}
                                        <input type="hidden" name="calzado_ids[]" value="{{ $calzado->id }}">

                                        <input type="checkbox" name="calzados[]" id="calzado-{{ $calzado->id }}" value="{{ $calzado->calzado }}" class="form-check-input">

                                        <label for="calzado-{{ $calzado->id }}" class="mx-1">N° {{ $calzado->calzado }}</label>
                                        <input type="text" name="stocks[]" id="stock-{{ $calzado->id }}" disabled class="border-1 text-center border-cyan-600/[0.5] text-small input-suma p-0" style="width:70px;height:30px;">

                                    @endif
                                @endif
                            </div>
                        @endforeach




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