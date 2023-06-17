@extends('layouts.app_admin')

@section('template_title')
    Editar Role
@endsection

@section('content')

<div class="container-fluid ">
      <div class="row">
        <div class="col-12">
              <h3 class="mb-3 mt-3 text-white">Edit Role</h3>
              <a class="btn" href="{{ route('roles.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff"> Back</a>
                    @if (count($errors) > 0)
                      <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                           @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                           @endforeach
                        </ul>
                      </div>
                    @endif
        </div>

        <div class="col-12">
                {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Permission:</strong>
                            <br/>
                            @foreach($permission as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                {{ $value->name }}</label>
                            <br/>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Submit</button>
                    </div>
                </div>
                {!! Form::close() !!}
        </div>

      </div>
</div>


@endsection
