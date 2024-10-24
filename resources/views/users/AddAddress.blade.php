@extends('layouts.app')

@section('section-principal')  
    <div class="flex justify-center" >
        
        
        
        <div class="card shadow-2xl col-6  my-10">
            @if (session('mensaje'))
                <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                    <strong>Atención!</strong> {{ session('mensaje') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif 
            <div class=" flex items-center border pr-2 justify-center">

                <img src="{{ asset('assets/img/logo.png') }}" alt="" draggable="false">
                <h1 class=" px-2  underline">Datos de residencia</h1>
            </div>


            <div class="card-body pb-0">
                <form method="POST" action="{{ route('agregar_direccion') }}" >
                    @csrf

                    <div class="row ">
                        <div class="flex justify-center">
                            <div class="col-md-9 flex justify-between">

                                <div class="form-floating mb-3 col-md-5 " style="">
                                    <input type="text" class="form-control   @error('nombre') is-invalid @enderror" id="floatingInput" placeholder=""  name="calle"  required  autofocus>
                                    <label for="floatingInput">Calle (*)</label>
                                </div>



                                <div class="col-md-6">

                                    <div class="form-floating mb-3  ">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder=""  name="distrito"  required  autofocus>
                                        <label for="email">Ciudad de Residencia (*)</label>
                                    </div>

                                </div>





                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="flex justify-center">
                            <div class="col-md-9 flex justify-between">
                                <div class="form-floating mb-3 col-md-4 ">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="provincia" placeholder=""  name="provincia"  required  autofocus>
                                    <label for="provincia">Provincia (*)</label>
                                </div>


                                <div class="form-floating mb-3 col-md-3 ">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" 
                                        id="cod_postal" name="cod_postal" placeholder="" 
                                        required autofocus maxlength="10" 
                                        oninput="this.value = this.value.toUpperCase();"
                                    >
                                    <label for="email">Cód. postal (*)</label>
                                </div>


                                <div class="form-floating mb-3 col-md-4 mx-1">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder=""  name="pais"    autofocus required>
                                    <label for="email">País (*)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="flex justify-center">
                            <div class="col-md-9 flex justify-center">
                                <div class="form-floating mb-3 col-md-4 ">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder=""  name="barrio"    autofocus>
                                    <label for="email">Barrio</label>
                                </div>

                                <div class="form-floating mb-3 col-md-3 mx-1">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder=""  name="dpto"    autofocus>
                                    <label for="email">Depto</label>
                                </div>

                                <div class="form-floating mb-3 col-md-2 mx-1">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder=""  name="piso"    autofocus>
                                    <label for="email">Piso</label>
                                </div>



                            </div>
                        </div>
                    </div>




                    <div class="flex justify-center mb-0">
                        <div class="col-md-4 grid">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Registrar') }}
                            </button>

                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <a href=" {{route('home')}} " class="text-sm my-2 text-center btn btn-secondary btn-sm">Pág. de inicio</a> <br>
                    </div>
                    <div class="mt-0">

                        <p class="text-center text-gray-600 text-xs p-2 px-5">
                            Los datos de residencia son obligatorios para poder entregar los productos a domicilio -en caso de que correspondiera. La tienda de Sportivo rige en San Nicolás de los Arroyos y alrededores.
                        </p>
                    </div>




                </form>
            </div>
        </div>
    </div>
    

@endsection