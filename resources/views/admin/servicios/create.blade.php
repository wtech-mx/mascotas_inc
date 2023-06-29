@extends('layouts.app_admin')

@section('template_title')
   Crear Historial
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/servicios.css')}}">
<style>
    .table td, .table th {
    white-space: revert!important;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 0px solid transparent !important;
        border-radius: 0px!important;
        padding: 22px;
    }

    .select2 {
        width: 380px!important;
    }

</style>
@endsection

@section('content')

<section class="servicios" style="background: {{$configuracion->color_principal}};min-height:auto;padding: 20px;">

    <div class="row">

        <div class="col-12 mt-3 mb-3">
            <h1 class="text-white text-center">¡Nuevo Historial Clínico!</h1>
        </div>

        <div class="col-12" style="padding: 0!important;">


            <form method="POST" action="{{ route('taller.store') }}" enctype="multipart/form-data" role="form" name="formulario1">
                @csrf
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-detalles" role="tabpanel" aria-labelledby="nav-detalles-tab" tabindex="0">
                        <div class="row">

                            <h4 class="text-center text-white mt-3">Detalles de la Mascota</h4>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Dueño </label>
                                <div class="input-group input-group-alternative mb-4">
                                    <span class="input-group-text" style="border-radius: 16px 0 0px 0px!important;">
                                        <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/mascotas/dog-walking.png') }}" alt="">
                                    </span>
                                    <select class="form-control cliente" data-toggle="select" id="id_cliente" name="id_cliente">
                                        <option value="">Seleccionar cliente</option>
                                        @foreach ($cliente as $item)
                                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-secondary btn-sm btn_plus_service" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>

                                    <div class="form-group ">
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body collapse_adduser">
                                                <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nombre">Nombre *</label>
                                                        <input  id="nombre" name="nombre" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nombre">Telefono *</label>
                                                        <input  id="telefono" name="telefono" type="number" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="nombre">Correo</label>
                                                        <input  id="email" name="email" type="email" class="form-control">
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Nom. Mascota </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/mascotas/happy.png') }}" alt="">
                                </span>
                                <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Mike Wazowski">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Fecha </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/calendar-days.png') }}" alt="">
                                </span>

                                <input class="form-control" type="date" value="{{$fechaActual}}" id="fecha" name="fecha">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Raza </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/mascotas/pets.png') }}" alt="">
                                </span>

                                <input class="form-control" type="text" id="folio" name="folio" placeholder="Labrador">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Peso KG </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/mascotas/dog.png') }}" alt="">
                                </span>

                                <input type="number" class="form-control" id="marca" name="marca" placeholder="46">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Temperatura </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/mascotas/veterinary.png') }}" alt="">
                                </span>

                                <input type="number" class="form-control" id="modelo" name="modelo" placeholder="35">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Dirección </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/mascotas/direction.png') }}" alt="">
                                </span>

                                <input type="text" class="form-control" id="rodada" name="rodada" placeholder="Dakota s/n, Nápoles, Benito Juárez, 03810 Ciudad de México, CDMX">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-Estado" role="tabpanel" aria-labelledby="nav-Estado-tab" tabindex="0">

                        <div class="row">

                            <h4 class="text-center text-white mt-3">Estado de la mascota</h4>

                            <div class="col-6 col-md-3 form-group ">
                                <label for="" class="form-control-label label_form_custom">Analisis </label>
                                <input type="file" class="form-control" id="foto1" name="foto1" >
                            </div>

                            <div class="col-6 col-md-3 form-group ">
                                <label for="" class="form-control-label label_form_custom">RX </label>
                                <input type="file" class="form-control" id="foto2" name="foto2" >
                            </div>

                            <div class="col-6 col-md-3 form-group ">
                                <label for="" class="form-control-label label_form_custom">Ultrasonido </label>
                                <input type="file" class="form-control" id="foto3" name="foto3" >
                            </div>

                            <div class="col-6 col-md-3 form-group ">
                                <label for="" class="form-control-label label_form_custom">PDF </label>
                                <input type="file" class="form-control" id="foto4" name="foto4" >
                            </div>

                            <label for="">
                                <p class="text-white"><strong>Motivo de la Consulta</strong></p>
                            </label>

                            <div class="input-group form-group mb-5">
                                <textarea class="form-control" rows="4" cols="6" value="3" id="observaciones" name="observaciones"></textarea>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Diagnostico </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/mascotas/stethoscope.png') }}" alt="">
                                </span>

                                <input type="text" class="form-control" id="camaras" name="camaras" placeholder="">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Indicaciones </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/mascotas/medical-report.png') }}" alt="">
                                </span>

                                <input type="text" class="form-control" id="mandos" name="mandos" placeholder="">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Tratamiento </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/mascotas/veterinary (2).png') }}" alt="">
                                </span>

                                <input type="text" class="form-control" id="eje" name="eje" placeholder="">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Medico </label>
                                <div class="input-group input-group-alternative mb-4">
                                    <span class="input-group-text" style="border-radius: 16px 0 0px 0px!important;">
                                        <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/mascotas/veterinary (1).png') }}" alt="">
                                    </span>
                                    <select class="form-control cliente" data-toggle="select" id="sprock" name="sprock">
                                        <option value="">Seleccionar medico</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="tab-pane fade" id="nav-producto" role="tabpanel" aria-labelledby="nav-producto-tab" tabindex="0">

                        <h4 class="text-center text-white mt-3">Pago</h4>

                        <div class="row">

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Saldo a favor</label>
                                <div class="input-group input-group-alternative mb-4">
                                    <span class="input-group-text" style="border-radius: 16px 0 0px 0px!important;">
                                        <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/dolar.png') }}" alt="">
                                    </span>
                                    <input type="number" class="form-control" id="subtotal" name="subtotal" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Total</label>
                                <div class="input-group input-group-alternative mb-4">
                                    <span class="input-group-text" style="border-radius: 16px 0 0px 0px!important;">
                                        <img class="img_icon_form" src="{{ asset('assets/admin/img/icons/dar-dinero.png') }}" alt="">
                                    </span>
                                    <input type="number" class="form-control" id="precio_servicio" name="precio_servicio" >
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                    </div> --}}
                </div>
            </form>

            <div class="d-flex justify-content-center">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist" style="--bs-nav-tabs-border-width: 0px!important;">
                      <button class="nav-link active" id="nav-detalles-tab" data-bs-toggle="tab" data-bs-target="#nav-detalles" type="button" role="tab" aria-controls="nav-detalles" aria-selected="true">
                        <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/lupa_list.png') }}" alt="">
                        <p class="text-center d-inline-block " style="margin-bottom: 0rem!important;">Mascota</p>
                      </button>

                      <button class="nav-link" id="nav-Estado-tab" data-bs-toggle="tab" data-bs-target="#nav-Estado" type="button" role="tab" aria-controls="nav-Estado" aria-selected="false">
                        <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/evaluacion.png') }}" alt="">
                        <p class="text-center d-inline-block " style="margin-bottom: 0rem!important;">Consulta</p>
                      </button>

                      <button class="nav-link" id="nav-producto-tab" data-bs-toggle="tab" data-bs-target="#nav-producto" type="button" role="tab" aria-controls="nav-producto" aria-selected="false">
                        <img class="img_icon_form mt-2" src="{{ asset('assets/admin/img/icons/lista-de-verificacion.png') }}" alt="">
                        <p class="text-center d-inline-block " style="margin-bottom: 0rem!important;">Documento</p>
                      </button>

                    </div>
                  </nav>
                </div>
        </div>

    </div>

</section>

@endsection

@section('columna_4')
<p class="text-center">
    <a class="btn_save"  href="javascript:enviar_formulario()" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
        Guardar <i class="fas fa-plus-circle"></i>
    </a>
</p>
    <script>
        function enviar_formulario(){
        document.formulario1.submit()
        }
    </script>
@endsection

@section('select2')

<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

    <script type="text/javascript">
            $(document).ready(function() {
                $('.cliente').select2();
            });

    </script>

@endsection
