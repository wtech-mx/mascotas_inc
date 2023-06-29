    <!-- Modal -->
    <div class="modal fade" id="modal_ticket{{$servicio->id}}" tabindex="-1" aria-labelledby="modal_ticket{{$servicio->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-body" style="background: {{$configuracion->color_principal}}">
                    <div class="row">
                        <div class="col-12">
                            <p class="text-center text-white"><strong>Ver Historial Clinico</strong></p>

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
                                           <b>Mascota</b>
                                        </div>
                                        <div class="col-4 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>Raza</b>
                                        </div>
                                        <div class="col-4 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>Estatus</b>
                                        </div>
                                        <div class="col-4 text-white"  style="font-size: 13px;">
                                            {{$servicio->tipo}}
                                        </div>
                                        <div class="col-4 text-white" style="font-size: 13px;">
                                            {{$servicio->folio}}
                                        </div>
                                        <div class="col-4 text-white" style="font-size: 13px;">
                                            {{$servicio->estatus}}
                                        </div>

                                        <div class="col-4 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                            <b>Peso KG</b>
                                         </div>
                                         <div class="col-4 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                            <b>Temperatura</b>
                                         </div>
                                         <div class="col-4 mt-3" style="color: {{$configuracion->color_iconos_cards}}">

                                         </div>
                                         <div class="col-4 text-white"  style="font-size: 13px;">
                                             {{$servicio->marca}}
                                         </div>
                                         <div class="col-4 text-white" style="font-size: 13px;">
                                             {{$servicio->modelo}}
                                         </div>
                                         <div class="col-4 text-white" style="font-size: 13px;">

                                        </div>
                                    {{-- E N D  D A T O S  G E N E R A L E S --}}

                                    {{-- D A T O S  P R O D U C T O S --}}
                                        <hr class="mt-3 mb-3" style="background-color: {{$configuracion->color_boton_close}}; height: 5px;">

                                        <div class="col-12 mt-2 mb-3" style="color: {{$configuracion->color_boton_close}}">
                                            <strong>Estado de la mascota</strong>
                                        </div>
                                        <div class="col-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>Analisis</b>
                                        </div>
                                        <div class="col-3" style="color: {{$configuracion->color_iconos_cards}}">
                                            <b>Ultra</b>
                                         </div>
                                        <div class="col-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>RX</b>
                                        </div>
                                        <div class="col-3" style="color: {{$configuracion->color_iconos_cards}}">
                                            <b>Extra</b>
                                        </div>
                                        <div class="col-3 text-white" style="font-size: 13px;">
                                            <a  href="{{ asset('fotos_bicis/'.$servicio->foto1) }}" download="analisisi-{{ $servicio->foto1 }}" style="color:#ffffff;">
                                                Ver
                                            </a>
                                        </div>
                                        <div class="col-3 text-white" style="font-size: 13px;">
                                            <a  href="{{ asset('fotos_bicis/'.$servicio->foto2) }}" download="analisisi-{{ $servicio->foto1 }}" style="color:#ffffff;">
                                                Ver
                                            </a>
                                        </div>
                                        <div class="col-3 text-white" style="font-size: 13px;">
                                            <a  href="{{ asset('fotos_bicis/'.$servicio->foto3) }}" download="analisisi-{{ $servicio->foto1 }}" style="color:#ffffff;">
                                                Ver
                                            </a>
                                        </div>
                                        <div class="col-3 text-white" style="font-size: 13px;">
                                            <a  href="{{ asset('fotos_bicis/'.$servicio->foto4) }}" download="analisisi-{{ $servicio->foto1 }}" style="color:#ffffff;">
                                                Ver
                                            </a>
                                        </div>

                                    {{-- E N D  D A T O S  P R O D U C T O S --}}
                                    <hr class="mt-3 mb-3" style="background-color: {{$configuracion->color_boton_close}}; height: 5px;">
                                    {{-- D A T O S  T O T A L --}}
                                        <div class="col-12 mt-2 mb-3" style="color: {{$configuracion->color_boton_close}}">
                                            <strong>Total</strong>
                                        </div>
                                        <div class="col-9 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>Servicio</b>
                                        </div>

                                        <div class="col-2 text-white">
                                            <input type="text" style="width: 50px;
                                            background: #fff;
                                            border-radius: 10px;
                                            border: solid 3px transparent;" value="{{ $servicio->precio_servicio }}">
                                        </div>
                                        <div class="col-9 mt-3" style="color: {{$configuracion->color_iconos_cards}}">
                                           <b>A favor</b>
                                        </div>

                                        <div class="col-2 text-white">
                                            <input type="text" style="width: 50px;
                                            background: #fff;
                                            border-radius: 10px;
                                            border: solid 3px transparent;" value="{{ $servicio->subtotal }}">
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
