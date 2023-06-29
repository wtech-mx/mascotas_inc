@extends('layouts.app_admin')

@section('content')

<section class="dashboard" style="background: {{$configuracion->color_principal}}!important;min-height: 800px;">
    <div class="row">


        <div class="col-12 mt-5">
            <h1 class="text-white">¡Hola! {{ Auth::user()->name }} </h1>
        </div>

        <div class="row">
            @can('servicios-list')
                <div class="col-12 col-md-6 py-3">
                    <div class="row">
                        <div class="col-9">
                            <a href="{{ route('taller.index') }}">
                                <div class="btn_bg_primario" style="background: {{$configuracion->color_boton_close}}!important">
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/lista-de-verificacion.png') }}" alt="">
                                    <p class="text-white d-inline-block">Historial Clínico</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-3">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('taller.create') }}">
                                    <div class="btn_border_primario" style="border-color: {{$configuracion->color_boton_close}}!important">
                                        <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/boton-circular-plus.png') }}" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('client-list')
                <div class="col-12 col-md-6 py-3">
                    <div class="row">
                        <div class="col-9">
                            <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                                <a href="{{ route('clients.index') }}">
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/biker.png') }}" alt="">
                                    <p class="text-white d-inline-block">Clientes</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="d-flex justify-content-center">
                                    @can('client-create')
                                        <a href="" data-bs-toggle="modal" data-bs-target="#modal_creat_user">
                                        @else
                                        <a>
                                    @endcan
                                    <div class="btn_border_primario" style="border-color: {{$configuracion->color_boton_close}}!important">
                                        <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/boton-circular-plus.png') }}" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('productos-list')
                <div class="col-12 col-md-6 py-3">
                    <div class="row">
                        <div class="col-9">
                            <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                                <a href="{{route('scanner_products.index')}}">
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/manivela.png') }}" alt="">
                                    <p class="text-white d-inline-block">Productos</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="d-flex justify-content-center">
                                <a href="" data-bs-toggle="modal" data-bs-target="#modal_creat_product">
                                    <div class="btn_border_primario" style="border-color: {{$configuracion->color_boton_close}}!important">
                                        <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/boton-circular-plus.png') }}" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            <div class="col-12 col-md-6 py-3">
                <div class="row">
                    <div class="col-9">
                        <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                            <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/recordatorio.png') }}" alt="">
                            <p class="text-white d-inline-block">Recordatorio</p>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="d-flex justify-content-center">
                            <div class="btn_border_primario" style="border-color: {{$configuracion->color_boton_close}}!important">
                                <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/boton-circular-plus.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @can('reportes')
                <div class="col-12 col-md-6 py-3">
                    <div class="row">
                        <div class="col-9">
                            <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                                <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/pie-chart.png') }}" alt="">
                                <p class="text-white d-inline-block">Reportes</p>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('scanner.index') }}">
                                    <div class="btn_border_primario" style="border-color: {{$configuracion->color_boton_close}}!important">
                                        <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/barcode.png') }}" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('usuarios-list')
                <div class="col-12 col-md-6 py-3">
                    <div class="row">
                        <div class="col-9">
                            <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                                <a href="/users">
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/mechanic.png') }}" alt="">
                                    <p class="text-white d-inline-block">Usuarios</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('users.create') }}">
                                    <div class="btn_border_primario" style="border-color: {{$configuracion->color_boton_close}}!important">
                                        <img class="btn_img_icon_plus" src="{{ asset('assets/admin/img/icons/boton-circular-plus.png') }}" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            <div class="col-12 col-md-6 py-3">
                <div class="row">
                    <div class="col-12">
                        <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                            <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/mascotas/pets.png') }}" alt="">
                            <p class="text-white d-inline-block">Mascotas</p>
                        </div>
                    </div>
                </div>
            </div>

            @can('caja')
                <div class="col-12 col-md-6 py-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                                <a href="{{ route('index.caja') }}">
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/point-of-sale.png') }}" alt="">
                                    <p class="text-white d-inline-block">Caja</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan



            <div class="col-12 col-md-6 py-3">
                <div class="row">
                    <div class="col-12">
                        <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                            <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/llantas.png') }}" alt="">
                            <p class="text-white d-inline-block">Pedidos Taller</p>
                        </div>
                    </div>
                </div>
            </div>

            @can('configuracion')
                <div class="col-12 col-md-6 py-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                                <a href="{{ route('index.configuracion') }}">
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/reparar.png') }}" alt="">
                                    <p class="text-white d-inline-block">Configuración</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('role-list')
                <div class="col-12 col-md-6 py-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                                <a href="{{ route('roles.index') }}">
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/papel.png') }}" alt="">
                                    <p class="text-white d-inline-block">Roles y Permisos</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan


                <div class="col-12 col-md-6 py-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="btn_bg_primario " style="background: {{$configuracion->color_boton_close}}!important">
                                <a href="" data-bs-toggle="modal" data-bs-target="#modal_costosfijos">
                                    <img class="btn_img_icon" src="{{ asset('assets/admin/img/icons/presupuesto.png') }}" alt="">
                                    <p class="text-white d-inline-block">Costos Fijos</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


        </div>

    </div>
</section>
@include('admin.productos.modal_create_product')
@include('admin.productos.modal_costosfijos')
@include('admin.cliente.create')
@endsection

@section('select2')
<script>
  $('#costo').on('input', calcularValores);
  $('#margen').on('input', calcularValores);
  $('#valor-costo-fijo').on('input', calcularValores);

  function calcularValores() {
    var costo = parseFloat($('#costo').val());
    var iva = costo * 0.16; // Calcula el 16% del costo
    var costoTotal = costo - iva; // Realiza la resta
    var margen = parseFloat($('#margen').val());
    var utilidad = costoTotal * margen; // Calcula la utilidad
    var valorCostoFijo = parseFloat($('#valor-costo-fijo').val());
    var subtotal = costoTotal + utilidad + valorCostoFijo; // Realiza la suma
    var ivaPa = subtotal * 0.16; // Calcula el 16% del subtotal
    var total = subtotal + ivaPa; // Realiza la suma

    $('#iva').val(iva.toFixed(2));
    $('#costo-total').val(costoTotal.toFixed(2));
    $('#utilidad').val(utilidad.toFixed(2));
    $('#subtotal').val(subtotal.toFixed(2));
    $('#iva-pa').val(ivaPa.toFixed(2));
    $('#total').val(total.toFixed(2));
  }

  function calcularValoresMedicina() {
    var costo2 = parseFloat($('#costo2').val());
    var costUnit = parseFloat($('#cost-unit').val());
    var empaque = parseFloat($('#empaque').val());

    var costoSinIVA = costo2 * 0.84; // Calcula el costo sin IVA
    var ivaAcre = costo2 - costoSinIVA; // Realiza la resta
    var costBase = costoSinIVA + costUnit; // Realiza la suma
    var valorCostoFijo = costBase * 0.16; // Calcula el valor del costo fijo
    var costoIntegrado = costBase + valorCostoFijo; // Realiza la suma
    var costoML = empaque / costoIntegrado; // Realiza la división

    $('#costo-ml').val(costoML.toFixed(2));
    $('#costo-integrado').val(costoIntegrado.toFixed(2));
    $('#valor-venta').val(valorCostoFijo.toFixed(2));
    $('#costo-sin-iva').val(costoSinIVA.toFixed(2));
    $('#iva-acre').val(ivaAcre.toFixed(2));
    $('#cost-base').val(costBase.toFixed(2));
}
</script>
@endsection
