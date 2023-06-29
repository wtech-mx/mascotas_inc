<!-- Modal -->
<div class="modal fade" id="modal_costosfijos" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Costos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body ">
                <p>
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Agregar servicio
                    </a>
                </p>

                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <form action="{{ route('costos.create') }}" method="post" class="row"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-3">
                                <label for="limpieza">nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>

                            <div class="form-group col-3">
                                <label for="">costo</label>
                                <input class="form-control" type="number" id="costo" name="costo">
                            </div>

                            <div class="form-group col-3">
                                <label for="operatoria" style="opacity: 0;">-------</label>
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
                        </form>
                    </div>
                </div>

                <hr>

                @foreach ($costos as $item)
                <form action="{{ route('costos.update_costos',$item->id) }}" method="post" class="row"  enctype="multipart/form-data">
                  @csrf

                    <div class="form-group col-3">
                        <label for="limpieza">Nombre</label>
                        <input type="hidden" class="form-control" id="id" name="id" value="{{$item->id}}">
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$item->nombre}}">
                    </div>

                    <div class="form-group col-4">
                        <label for="limpieza">Costos</label>
                        <input type="text" class="form-control" id="costo" name="costo" value="{{$item->costo}}">
                    </div>

                    <div class="form-group col-3">
                        <label for="operatoria" style="opacity: 0;">-------</label>
                        <button type="submit" class="btn btn-primary">guardar</button>
                    </div>
                   </form>
                @endforeach
            </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">cerrar</button>
                </div>

    </div>
</div>
</div>

