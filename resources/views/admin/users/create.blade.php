@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/users') }}">Usuarios</a>
                        </li>
                        <li class="breadcrumb-item active">Crear</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/users') }}">Usuarios</a>
                </h4>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title"><i class="mdi mdi-plus mr-1"></i>Agregar</h4>

                <form class="form-horizontal" action="{{ url('admin/users/') }}" method="POST">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="name" class="col-3 col-form-label">Nombre</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="Ingrese su nombre" value="{{ old('name') }}" required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="email" class="col-3 col-form-label">Email</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="Ingrese su email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="rol_id" class="col-3 col-form-label">Rol</label>
                        <div class="col-9">
                            <select class="form-control{{ $errors->has('rol_id') ? ' is-invalid' : '' }} select2" id="rol_id" name="rol_id" data-toggle="select2">
                                <option value="S">Seleccionar</option>
                                @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}" {{ (old('rol_id') == $rol->id ? "selected":"") }}>{{ $rol->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('rol_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('rol_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="password" class="col-3 col-form-label">Contraseña</label>
                        <div class="col-9">
                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" id="password" placeholder="Ingrese su contraseña" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="password-confirm" class="col-3 col-form-label">Contraseña</label>
                        <div class="col-9">
                            <input class="form-control" type="password" id="password-confirm" placeholder="Confirme su contraseña" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-end row">
                        <div class="col-9">
                            <button type="submit" class="btn btn-info">Guardar</button>
                        </div>
                    </div>
                </form>

            </div>  <!-- end card-body -->
        </div>  <!-- end card -->
    </div>
</div>
@endsection
