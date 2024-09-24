{{-- ORDENAR POR --}}
<form id="sortForm" style="position: absolute; right: 2%;">
    <div>
        <span class="font-semibold">Ordenar por</span>
        <select id="selectForm" class="control-field filter-field form-control" style="width: 100%" name="orderDirection" onchange="this.form.submit()">
            <option value="asc" {{ $orderDirection == 'asc' ? 'selected' : '' }}>Menor precio</option>
            <option value="desc" {{ $orderDirection == 'desc' ? 'selected' : '' }}>Mayor precio</option>
        </select>
    </div>
</form>


<div style="height:100vh;display: flex; flex-direction: column;border-right:1px solid rgb(100,100,100,0.2)">
    {{-- FILTRADO --}}
    <div class="panel" data-df-offset="-220px" data-df-animation-speed="280">
        <div id="menulink" class="menu-button">
            <a href="#" class="text-center">FILTROS <i id="icon-arrow" class="arrow"></i></a>
        </div>

        <form id="filterForm">
            <input type="hidden" name="articulo-buscado" value="{{ $query }}">

            <div class="form-group">
                {{-- FILTRO POR GENERO --}}
                <span class="font-semibold">Filtrar por género</span>
                @foreach ($allGeneros as $genero)
                    <div class="form-check ml-3">
                        <input class="form-check-input" type="checkbox" name="generos[]" id="genero_{{ $genero }}" value="{{ $genero }}" {{ in_array($genero, $selectedGeneros) ? 'checked' : '' }}>
                        <label class="form-check-label" for="genero_{{ $genero }}">{{ $genero }}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                {{-- FILTRO POR MARCA --}}
                <span class="font-semibold">Filtrar por marca</span>
                @foreach ($allBrands as $brand)
                    <div class="form-check ml-3">
                        <input class="form-check-input" type="checkbox" name="brands[]" id="brand_{{ $brand }}" value="{{ $brand }}" {{ in_array($brand, $selectedBrands) ? 'checked' : '' }}>
                        <label class="form-check-label" for="brand_{{ $brand }}">{{ $brand }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Filtrar</button>
            <button type="button" id="clean" class="btn btn-secondary">Limpiar</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function() {
        let panel = jQuery(".panel");
        let hidden = true; // Estado inicial de la solapa

        // Abrir/cerrar menu filtro
        jQuery(".menu-button").click(function() {
            if (hidden) {
                panel.animate({ left: "0" }, panel.attr("data-df-animation-speed"));
            } else {
                panel.animate({ left: panel.data("df-offset") }, panel.attr("data-df-animation-speed"));
            }
            hidden = !hidden; // Cambiar el estado
        });

        // Giro de flecha al abrir el menu filtro
        jQuery("#menulink").click(function() {
                    jQuery("#icon-arrow").toggleClass("open");
                });

        // Al cambiar el orden, solo se envían los datos de ordenamiento
        $('#sortForm').on('change', function() {
            let filterData = $('#filterForm').serialize();
            let sortData = $(this).serialize();
            window.location.href = "/buscar?" + filterData + "&" + sortData;
        });

        // Al enviar el formulario de filtros
        $('#filterForm').on('submit', function(event) {
            event.preventDefault(); // Prevenir el envío predeterminado
            let filterData = $(this).serialize();
            let sortData = $('#sortForm').serialize();
            window.location.href = "/buscar?" + filterData + "&" + sortData; // Redirigir con ambos valores
        });

        // Limpiar los checkboxes sin cerrar la solapa
        $('#clean').on('click', function() {
            $('#filterForm input[type="checkbox"]').prop('checked', false); 
            // let filterData = $('#filterForm').serialize(); 
            // let sortData = $('#sortForm').serialize(); // 
            // window.location.href = "/buscar?" + filterData + "&" + sortData; 
        });

        // Recuperar el estado de la solapa al cargar la página
        if (sessionStorage.getItem('filterPanelState') === 'open') {
            panel.css('left', '0'); 
            hidden = false; 
        }

        // Guardar el estado de la solapa en sessionStorage
        window.addEventListener("beforeunload", function() {
            sessionStorage.setItem('filterPanelState', hidden ? 'closed' : 'open');
        });
    });
</script>
