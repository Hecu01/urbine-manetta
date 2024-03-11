@extends('admin.layouts.plantilla_admin')
@section('section-principal')
  <style>
    table tr th, table tr td{
      text-align: center;
    }
  </style>

  <div class="w-fit">

    <article class="article0    px-2 bg-green-500 "  >
      <a href="{{ route('nuevo_articulo') }}" class="text-white no-underline">
        <div class="top">
          <span>
            <i class="fa-solid fa-chart-line"></i>
          </span>
          <span class="recuento">
          +35k
          </span>
        </div>
        <div class="bottom">
          <p>Ventas realizadas</p>
        </div>
      </a>
    </article>
    <div class="flex justify-center mt-3">
      <a href="{{ route('ir_admin') }}" id="boton-regresar-atras" class="bg-cyan-500  px-3 text-white rounded-full no-underline hover:scale-105 hover:shadow" style="font-size: 2.5em">
        <i class="fa-solid fa-circle-arrow-left"></i> Atrás
      </a>

    </div>
  </div>
 

    <div class="" >
      <div class="">
        <div class="flex">

          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1" style="font-size:1.2em">
              Cliente registrado
            </label>
          </div>
          <div class="form-check mx-5">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
            <label class="form-check-label" for="flexRadioDefault2" style="font-size:1.2em">
              Cliente registrado no
            </label>
          </div>
        </div>
      
        {{-- Cliente registrado formulario --}}
        <form action="" class="  border  pt-2" style="margin: 0px 30px">
          <div class="flex">
            <div class="left">
              <div class="">
                <label for="">Cliente</label><br>
                <select name="cliente" id="" class="form-select">
                  <option value="" selected hidden>Selecione al cliente</option>
                  @foreach ($usuarios as $usuario)
                    <option value="{{$usuario->id}}"> {{ $usuario->name }} </option>
                  @endforeach
                </select>
              </div>
              <div class=" p-1 mt-1 ">
                {{-- <label for="browser">Choose your browser from the list:</label>
                <input list="browsers" id="browser" name="browser" class="form-control">
                <datalist id="browsers" style="background: #ec0c0c">
                  <option value="Chrome">
                  <option value="Firefox">
                  <option value="Edge">
                  <option value="Safari">
                  <option value="Opera">
                </datalist> --}}
                <label for="">Articulo</label><br>
                <select name="articulo" id="articulo" class="form-select">
                  <option value="" selected hidden>Seleccione artículo o ropa</option>

                  @foreach ($articulos as $articulo)
                    @if($articulo->tipo_producto == "calzado")
                      @foreach ($articulo->calzados as $calzado)
                        <option value="{{$calzado->id}}" data-precio="{{$calzado->pivot->precio}}">{{$articulo->nombre}} - {{$articulo->marca}} - Calzado n°{{$calzado->calzado}}</option>
                      @endforeach
                      
                    @else
                      <option value="{{$articulo->id}}" data-precio="{{$articulo->precio}}">{{$articulo->nombre}}</option>

                    @endif
                  @endforeach

                </select>
                <div class="col-12 flex justify-between mt-2 mb-4">
                  <div class="col-5">
                    <label for="">Unidades</label>
                    <input type="text" name="unidades" id="unidades"  class="form-control" value="1">
                  </div>
                  <div class="col-6 ">
                    <label for="">Precio unitario (AR)</label>
                    <div class="input-group">
                      <span class="input-group-text">$</span>
                      <input type="number" name="precio_unitario" id="precio_unitario" class="form-control">
                    </div>
                    <style>
                      .input-group-text {
                        border-top-left-radius: .25rem;
                        border-bottom-left-radius: .25rem;
                      }
                    </style>
                  </div>
                </div>
                <div class="grid">
                  <button type="button" class="btn btn-primary mx-1" id="boton-aniadir">Añadir</button>
                </div>
              </div>
            </div>
            <div id="contenedor-de-venta" class="border ml-3" style="width:100%;">
                <!-- Tabla de ventas -->
              <table class="tabla-ventas table  p-0 m-0">
                <thead>
                    <tr style="background: red">
                      <th class="border border-slate-300 px-0" style="width: 20px;">Id</th>
                      {{-- <th class="border border-slate-300 px-0" style="width: 20px;">Cod_barras</th> --}}
                      <th class="border border-slate-300" style="width: 200px;">Producto</th>
                      <th class="border border-slate-300 px-0" style="width: 65px">Cantidad</th>
                      <th class="border border-slate-300" style="width: 45px">Unitario</th>
                      <th class="border border-slate-300" style="width: 65px">Importe</th> 
                      <th class="border border-slate-300 px-0" style="width: 65px">Quitar</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se agregan las ventas dinámicamente -->
                </tbody>
              </table>
           </div>
          </div>

          <div class=" mt-5">
            <div class="right">
              <h2>TOTAL A PAGAR: $ <span id="total-a-pagar"></span></h2>
            </div>
            <div class="left">
              <button class="btn btn-success">VENDER</button>
            </div>

          </div>
        </form>
      </div>

    </div>

@endsection

