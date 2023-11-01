<!-- calzados disponibles -->
<div class="modal fade"  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregá calzados disponibles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body  ">
                <h3 class="text-xl text-center"> Disponibilidad - Calzado - Unidades</h3>
                <div class="flex justify-center">
                    <!-- left-->
                    {{-- <div class="mr-3 " >
                        @foreach( $calzados as $calzado)
                            @if($calzado->calzado < 38)
                                <div class="mx-3  my-1">
                                    <input type="checkbox" name="calzados[]" id="calzado-{{$calzado->id}}" value="{{ $calzado->calzado }}" class="form-check-input" >
                                    <label for="calzado-{{$calzado->id}}" class="mx-1">Calzado {{ $calzado->calzado }}</label>
                                    <input type="text" name="stocks[]" id="stock-{{$calzado->id}}" class="border-1  text-center border-cyan-600/[0.5] text-small" style="width:25px;height:22px"> 
                                </div>
                            @endif
                        @endforeach
                    </div> --}}
                    <!-- center-->
                    <div class="mr-3 " >
                        @foreach($calzados as $calzado)
                            @if($calzado->calzado > 38)
                                <div class="mx-3  my-1">
                                    <input type="checkbox" name="calzados[]" id="calzado-{{$calzado->id}}" value="{{ $calzado->calzado }}" class="form-check-input" >
                                    <label for="calzado-{{$calzado->id}}" class="mx-1">Calzado {{ $calzado->calzado }}</label>
                                    <input type="text" name="stocks[]" id="stock-{{$calzado->id}}" class="border-1  text-center border-cyan-600/[0.5] text-small" style="width:25px;height:22px" > 
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>