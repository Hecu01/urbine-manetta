<aside class="left-aside" id="right-aside">
    <div class="mas-informacion">
        <h3>Ultimas novedades </h3>
        <ul class="nav nav-tabs" id="myTab" role="tablist" >
            <li class="nav-item" role="presentation" >
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true" style="width: 200px">Hoy </button>
            </li>

          </ul>
          <div class="tab-content" id="myTabContent" style="min-height: 60vh; max-height:60vh; ">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
              <div class="top-border"style="border-bottom:1px solid #00000079"></div>

              <div class="p-1" style="border:1px solid #00000079; border-top:none;">
                <strong>Clientes activos</strong>: {{ $clientes }} ({{ $clientesHoy }} nuevos)
              </div>
              <div class="p-1" style="border:1px solid #00000079; border-top:none;">
                <strong>Ventas</strong>: {{ $comprasRealizadas }} ({{ $comprasHoy }} nuevas)
              </div>
              <div class="p-1" style="border:1px solid #00000079; border-top:none;">
                <strong>Suplem. deportivos</strong>: {{ $suplementos }} ({{ $suplementosHoy }} nuevos)
              </div>
              <div class="p-1" style="border:1px solid #00000079; border-top:none;">
                <strong>Art. deportivos</strong>: {{ $articulos }} ({{ $articulosHoy }} nuevos)
              </div>
              <div class="p-1" style="border:1px solid #00000079; border-top:none;">
                <strong>Ropa deportiva</strong>: {{ $ropas }} ({{ $ropasHoy }} nuevos)
              </div>
              <div class="p-1" style="border:1px solid #00000079; border-top:none;">
                <strong>Reposicion pendientes</strong>: {{ $reposicionesPendientes }} ({{ $reposicionesHoyPendientes }} nuevos)
              </div>
              <blockquote class="text-justify mx-1 "style="font-size: .9em">
                <h6 class="mt-3">Explicación</h6>
                El anterior contenido es información extra acerca de las actividades más importantes  realizadas el dia de hoy ({{$inicioDelDia->format('d/m/Y')}}). Mas información haga 
                
                <a href="#" data-bs-toggle="modal" data-bs-target="#modalInformacionExtra">
                   click aquí
                </a>.
                

              </blockquote>


            </div>

          </div>
          <hr>

        <span class="ml-1"><i class="fa-solid fa-location-dot"></i> Casa central (Gutemberg 7 Bis)</span><br>
        <span class="ml-1"><i class="fa-solid fa-screwdriver-wrench"></i> Administrador: {{ Auth::user()->name }}</span>
    </div>
</aside>



<!-- Informacion extra modal-->
<div class="modal fade"  id="modalInformacionExtra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
      <div class="modal-content" >
          <div class="modal-header">
              <h3 class="modal-title uppercase" style="font-weight: bolder" id="exampleModalLabel">Explicación</h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body  ">
            <blockquote>
              El anterior contenido es información extra acerca de las actividades más importantes (<strong>Clientes Activos, Ventas, Suplementos Deportivos, Articulos Deportivos, Ropa Deportiva y Reposiciones Pendientes</strong>) realizadas el dia de hoy... Por ejemplo "ventas: 2 (0 nuevas)" significa que en base de datos hay 2 ventas en total, y "hoy no se vendió nada. Si se elimina un dato de la Base de Datos de Sportivo, cambiará la información visible de lado derecho, ya que dicha información no será encontrada en la tabla. 
            </blockquote>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
      </div>
  </div>
</div>