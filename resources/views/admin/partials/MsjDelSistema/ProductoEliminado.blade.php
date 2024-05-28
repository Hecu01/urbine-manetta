
<!-- Modal -->
<div class="modal fade  "id="art-elim-con-exito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="header flex items-center justify-center">
                    <img src="{{ asset('assets/img/logo.png')}}"  alt="Logo" style="width:130px">
                    <h2 class="mb-1 uppercase" style="font-size: 3em;">Sportivo</h2>
                </div>
                <div class="p-3 center text-center border-t" style="position: relative;">
                    <p class="mb-2" style="font-size: 2em;">
                        ¡Artículo  eliminado!
                        <i class="fa-solid fa-trash text-[#dc2626]" ></i>
                    </p>
                </div>
        
                    
        
                <div class="modal-footer">
                    <button class="btn btn-danger"  data-bs-dismiss="modal" type="button">Aceptar</button>
                </div>
        </div>
    </div>
  </div>
  
  
  
  <!-- JavaScript para activar el modal al cargar la página -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = new bootstrap.Modal(document.getElementById('art-elim-con-exito'));
        modal.show();
    });
  </script>