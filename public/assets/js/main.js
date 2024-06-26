
$(document).ready(function() {


  $("#btn1").click(function(){
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-bottom-center",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };

    toastr.success('Agregaste al carrito');
  
  });
  /* 
  |
  |--------------------------------------------------------------------------------
  | Sportivo - búsqueda
  |--------------------------------------------------------------------------------
  |
  */ 
  $('#imageModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var imageUrl = button.data('image'); // Extrae la información de los datos

    var modal = $(this);
    modal.find('.modal-body #modalImage').attr('src', imageUrl);
  });  

  $('#talle').on('change', function () {
    var selectedTalle = $(this).find('option:selected');
    var maxStock = selectedTalle.data('stock');
    updateUnidadesOptions(maxStock);
  });

  function updateUnidadesOptions(maxStock) {

    var unidadesSelect = $('#unidades');
    unidadesSelect.empty();
    for (var i = 1; i <= maxStock; i++) {
        var option = $('<option></option>').attr('value', i).text(i + ' unidades');
        unidadesSelect.append(option);
    }
}
});

