
<!-- Modal -->
<div class="modal fade  "id="art-agreg-con-exito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="header flex items-center justify-center">
                    <img src="{{asset('assets/img/sportivo-logo.svg')}}"  draggable="false" alt="Logo" style="width:130px" class="mr-1 opacity-70">
                    <h2 class="mb-1 uppercase" style="font-size: 3em;">Sportivo</h2>
                </div>
                <div class="p-3 center text-center border-t" style="position: relative;">
                    <p class="mb-2" style="font-size: 2em;">¡{{ session('success') }}!</p>
                    <span>
                        <i class="fa-solid fa-circle-check text-[#22c55e]" style="font-size:2.5em"></i>
                    </span>
                </div>
        
                    
        
                <div class="modal-footer flex justify-center">
                    <button class="btn btn-success"  data-bs-dismiss="modal" type="button">Aceptar</button>
                </div>
        </div>
    </div>
  </div>
  
  
  
  <!-- JavaScript para activar el modal al cargar la página -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = new bootstrap.Modal(document.getElementById('art-agreg-con-exito'));
        modal.show();
    });
  </script>