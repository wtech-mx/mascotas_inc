@extends('layouts.app_admin')

@section('template_title')
    Configuracion
@endsection

@section('page_actuality')
Configuracion
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
            <!-- Card header -->
            <div class="card-header mt-5">
                @include('layouts.simple_alert')
              <h3 class="mb-3" style="color: #fff">Configuración Sistema</h3>
            </div>

            <div class="card-body mb-5">

                <form method="POST" action="{{ route('update.configuracion') }}" enctype="multipart/form-data" role="form">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h3 class="text-white mb-3">{{$configuracion->nombre_sistema}}</h3>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label text-white">Nombre Sistema: </label>
                                <input class="form-control" type="text" id="nombre_sistema" name="nombre_sistema" value="{{$configuracion->nombre_sistema}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label text-white">Logo:</label>
                                <input class="form-control" type="file" id="logo" name="logo" value="{{$configuracion->logo}}">
                                <img src="{{asset('favicon/'.$configuracion->logo)}}" style="width: 50%; heigth: 50%" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label text-white">Favicon: </label>
                                <input class="form-control" type="file" id="favicon" name="favicon" value="{{$configuracion->favicon}}">
                                <img src="{{asset('favicon/'.$configuracion->favicon)}}" style="width: 20%; heigth: 20%" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label text-white">Color Principal: </label>
                                <input class="form-control" type="color" id="color_principal" name="color_principal" value="{{$configuracion->color_principal}}">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h3 class="text-white mt-3">Color </h3>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label text-white">Color texto footer: </label>
                                <input class="form-control" type="color" id="color_iconos_sidebar" name="color_iconos_sidebar" value="{{$configuracion->color_iconos_sidebar}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label text-white">Color Footer: </label>
                                <input class="form-control" type="color" id="color_iconos_cards" name="color_iconos_cards" value="{{$configuracion->color_iconos_cards}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label text-white">Color Cards: </label>
                                <input class="form-control" type="color" id="color_boton_close" name="color_boton_close" value="{{$configuracion->color_boton_close}}">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h3 class="text-white mt-3">Botones</h3>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label text-white">Color boton add: </label>
                                <input class="form-control" type="color" id="color_boton_add" name="color_boton_add" value="{{$configuracion->color_boton_add}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label text-white">Icono boton add: </label>
                                <input class="form-control" type="text" id="icon_boton_add" name="icon_boton_add" value="{{$configuracion->icon_boton_add}}">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label text-white">Color boton save: </label>
                                <input class="form-control" type="color" id="color_boton_save" name="color_boton_save" value="{{$configuracion->color_boton_save}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label text-white">Icono boton save: </label>
                                <input class="form-control" type="text" id="icon_boton_save" name="icon_boton_save" value="{{$configuracion->icon_boton_save}}">
                            </div>
                        </div>

                        {{-- <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <label class="form-control-label text-white">Icono boton close: </label>
                                <input class="form-control" type="text" id="icon_boton_close" name="icon_boton_close" value="{{$configuracion->icon_boton_close}}">
                            </div>
                        </div> --}}

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Actualizar</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
      </div>
</div>


@endsection
