{{-- ORDENAR POR --}}
<form id="sortForm"  style="position: absolute; right: 2%;">
    <div>
        <span class="font-semibold">Ordenar por</span>
        {{-- <div class="form-check ml-3">
            <input class="form-check-input" type="radio" name="orderDirection" id="orderAsc" value="asc"
                {{ $orderDirection == 'asc' ? 'checked' : '' }}>
            <label class="form-check-label" for="orderAsc">
                Menor a Mayor
            </label>
        </div>
        <div class="form-check ml-3">
            <input class="form-check-input" type="radio" name="orderDirection" id="orderDesc" value="desc"
                {{ $orderDirection == 'desc' ? 'checked' : '' }}>
            <label class="form-check-label" for="orderDesc">
                Mayor a Menor
            </label>
        </div> --}}
        <select id="selectForm" class="control-field filter-field form-control" style="width: 100%" name="orderDirection" onchange="this.form.submit()">
            <option value="asc"
                        {{ $orderDirection == 'asc' ? 'selected' : '' }}>Menor precio</option>
            <option value="desc"
                        {{ $orderDirection == 'desc' ? 'selected' : '' }}>Mayor precio</option>
          </select>
    </div>
</form>



<div style="height:100vh;display: flex; flex-direction: column border-right:1px solid rgb(100,100,100,0.2)">
    {{-- FILTRADO --}}
    <div class="panel" data-df-offset="-220px" data-df-animation-speed="280">
        <div id="menulink" class="menu-button">
            <a href="#" class="text-center">FILTROS <i id="icon-arrow" class="arrow"></i></a>
        </div>

        {{-- <form action="{{ url('/buscar') }}" method="GET" id="filterForm"> --}}
        {{-- <h5 class="font-bold m-3">FILTROS</h5> --}}
        <form id="filterForm">
            <input type="hidden" name="articulo-buscado" value="{{ $query }}">

            <div class="form-group">

                <span class="font-semibold">Filtrar por género</span>
                @foreach ($allGeneros as $genero)
                    <div class="form-check ml-3">
                        <input class="form-check-input" type="checkbox" name="generos[]" id="genero_{{ $genero }}"
                            value="{{ $genero }}" {{ in_array($genero, $selectedGeneros) ? 'checked' : '' }}>
                        <label class="form-check-label" for="genero_{{ $genero }}">
                            {{ $genero }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <span class="font-semibold">Filtrar por marca</span>
                {{-- @foreach ($resultados as $articulo)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="brands[]" id="brand_{{ $articulo->marca }}" value="{{ $articulo->marca }}" {{ in_array($articulo->marca, $selectedBrands) ? 'checked' : '' }}>
                        <label class="form-check-label" for="brand_{{ $articulo->marca }}">
                            {{ $articulo->marca }}
                        </label>
                    </div>
                @endforeach --}}

                @foreach ($allBrands as $brand)
                    <div class="form-check ml-3">
                        <input class="form-check-input" type="checkbox" name="brands[]" id="brand_{{ $brand }}"
                            value="{{ $brand }}" {{ in_array($brand, $selectedBrands) ? 'checked' : '' }}>
                        <label class="form-check-label" for="brand_{{ $brand }}">
                            {{ $brand }}
                        </label>
                    </div>
                @endforeach

            </div>

            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function() {
        try {
            if (jQuery(".panel").length) {
                // Abrir/Cerrar menu filtro
                jQuery(".menu-button").click(function() {
                    var pannel = jQuery(".panel"),
                        hidden = pannel.data("hidden"),
                        speed = pannel.attr("data-df-animation-speed"),
                        offset = pannel.attr("data-df-offset");

                    if (hidden) jQuery(".panel").animate({
                        left: offset
                    }, speed);
                    else jQuery(".panel").animate({
                        left: "0"
                    }, speed);

                    jQuery(".panel").data("hidden", !hidden);
                });

                // Giro de flecha al abrir el menu filtro
                jQuery("#menulink").click(function() {
                    jQuery("#icon-arrow").toggleClass("open");
                });
            }
        } catch (e) {
            console.log(e);
        }
    });

    jQuery(document).ready(function() {
    // Al enviar el formulario de filtros o el de ordenar, combinar ambos
    $('#filterForm, #sortForm').on('change', function() {
        // Obtener los valores del formulario de filtro
        let filterData = $('#filterForm').serialize();
        // Obtener los valores del formulario de ordenamiento
        let sortData = $('#sortForm').serialize();
        
        // Redirigir con ambos valores
        window.location.href = "/buscar?" + filterData + "&" + sortData;
    });
});

</script>