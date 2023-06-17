    <!-- Modal -->
    <div class="modal fade" id="modal_ticket{{$servicio->id}}" tabindex="-1" aria-labelledby="modal_ticket{{$servicio->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-body" style="background: {{$configuracion->color_principal}}">
                    <div class="row">
                        <div class="col-12">
                            <p class="text-center text-white"><strong>Ver Ticket</strong></p>

                            <div class="d-flex ">
                                <div class="row">
                                    {{-- D A T O S  G E N E R A L E S --}}
                                        <div class="col-12 mt-2 mb-3" style="color: {{$configuracion->color_boton_close}}">
                                            <strong>Datos Generales</strong>
                                        </div>
                                        <div class="col-4" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>Nombre</b>
                                        </div>
                                        <div class="col-4" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>Telefono</b>
                                        </div>
                                        <div class="col-4" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>Fecha Ing.</b>
                                        </div>
                                        <div class="col-4 text-white" style="font-size: 13px;">
                                            {{$servicio->Cliente->nombre}}
                                        </div>
                                        <div class="col-4 text-white" style="font-size: 13px;">
                                            {{$servicio->Cliente->telefono}}
                                        </div>
                                        <div class="col-4 text-white" style="font-size: 13px;">
                                            {{$servicio->fecha}}
                                        </div>

                                        <div class="col-4 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>Servicio</b>
                                        </div>
                                        <div class="col-4 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>Folio</b>
                                        </div>
                                        <div class="col-4 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>Estatus</b>
                                        </div>
                                        <div class="col-4 text-white"  style="font-size: 13px;">
                                            {{$servicio->servicio}}
                                        </div>
                                        <div class="col-4 text-white" style="font-size: 13px;">
                                            {{$servicio->folio}}
                                        </div>
                                        <div class="col-4 text-white" style="font-size: 13px;">
                                            {{$servicio->estatus}}
                                        </div>
                                    {{-- E N D  D A T O S  G E N E R A L E S --}}

                                    {{-- D A T O S  P R O D U C T O S --}}
                                        <hr class="mt-3 mb-3" style="background-color: {{$configuracion->color_boton_close}}; height: 5px;">

                                        <div class="col-12 mt-2 mb-3" style="color: {{$configuracion->color_boton_close}}">
                                            <strong>Componentes</strong>
                                        </div>
                                        <div class="col-2 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>sku</b>
                                        </div>
                                        <div class="col-8 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>Producto</b>
                                        </div>
                                        <div class="col-2 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>Precio</b>
                                        </div>
                                        @php $suma=0; @endphp
                                        @if(!empty($servicio->TallerProductos->id ))
                                            @foreach ($taller_productos as $taller_producto)
                                                @if($taller_producto->id_taller == $servicio->id)
                                                <div class="col-2">
                                                    <p class="text-white" style="font-size: 11px;">{{$taller_producto->sku}}</p>
                                                    <form action="{{ route('products_taller.destroy', $taller_producto->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" style="background: transparent;border: solid 1px transparent;">
                                                            <img style="width:25px" src="{{ asset('assets/admin/img/icons/bote-de-basura.png') }}" alt="">
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-8">
                                                   <a class="text-white" style="font-size: 11px;" href="{{$taller_producto->permalink}}" target="_blank">
                                                    {{$taller_producto->producto}}
                                                   </a>
                                                </div>
                                                <div class="col-2 text-white" >
                                                    <form action="{{ route('taller.precio_product', $taller_producto->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        {{-- <input type="hidden" value="{{$taller_producto->id}}"> --}}
                                                        <input type="number" id="price" name="price" value="{{$taller_producto->price}}" style="width: 50px;
                                                            background: #fff;
                                                            border-radius: 10px;
                                                            border: solid 3px transparent;">
                                                        <button type="submit" style="background: transparent;border: solid 1px transparent;">
                                                            <img style="width:25px" src="{{ asset('assets/admin/img/icons/disquete.png') }}" alt="">
                                                        </button>
                                                    </form>
                                                </div>
                                                @php $suma+=$taller_producto->price @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                    {{-- E N D  D A T O S  P R O D U C T O S --}}
                                    <hr class="mt-3 mb-3" style="background-color: {{$configuracion->color_boton_close}}; height: 5px;">
                                    {{-- D A T O S  T O T A L --}}
                                        <div class="col-12 mt-2 mb-3" style="color: {{$configuracion->color_boton_close}}">
                                            <strong>Total Sugerido</strong>
                                        </div>
                                        <div class="col-10 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>Servicio</b>
                                        </div>
                                        <div class="col-2 text-white">
                                            <form action="{{ route('taller.precio_servicio', $servicio->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                {{-- <input type="hidden" value="{{$taller_producto->id}}"> --}}
                                                <input type="number" id="precio_servicio" name="precio_servicio" value="{{$servicio->precio_servicio}}" style="width: 50px;
                                                    background: #fff;
                                                    border-radius: 10px;
                                                    border: solid 3px transparent;">
                                                <button type="submit" style="background: transparent;border: solid 1px transparent;">
                                                    <img style="width:25px" src="{{ asset('assets/admin/img/icons/disquete.png') }}" alt="">
                                                </button>
                                            </form>                                        </div>
                                        <div class="col-10 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>Componentes</b>
                                        </div>
                                        <div class="col-2 text-white">
                                            ${{$suma}}
                                        </div>
                                        <div class="col-10 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>SubTotal</b>
                                        </div>
                                        @php $subtotal=$suma + $servicio->precio_servicio @endphp
                                        <div class="col-2 text-white">
                                            <input type="text" value="{{$subtotal}}" style="width: 50px;
                                            background: #fff;
                                            border-radius: 10px;
                                            border: solid 3px transparent;">
                                        </div>
                                        <div class="col-10 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>Total</b>
                                        </div>
                                        @php $total=$subtotal - $servicio->subtotal @endphp
                                        <div class="col-2 text-white">
                                            <input type="text" value="{{$total}}" style="width: 50px;
                                            background: #fff;
                                            border-radius: 10px;
                                            border: solid 3px transparent;" disabled>
                                        </div>
                                    {{-- E N D  D A T O S  T O T A L --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <a type="button" class="btn btn-secondary btn_close_modal" data-bs-dismiss="modal" style="">
                        <i class="fas fa-times-circle"></i>
                    </a>
            </div>
        </div>
    </div>
