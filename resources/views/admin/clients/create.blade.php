@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <form class="form-inline">
                    <a href="{{ url('admin/users/create') }}" class="btn btn-primary ml-1" title="Nuevo">
                        <i class="mdi mdi-plus"></i>
                    </a>
                    <a href="{{ url('admin/users') }}" class="btn btn-dark ml-1" title="Listado">
                        <i class="mdi mdi-format-list-numbered"></i>
                    </a>
                </form>
            </div>
            <h4 class="page-title">Usuarios</h4>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="card">
        <div class="card-body">

            <h4 class="mb-3 header-title">Crear un nuevo usuario</h4>

            <form class="form-horizontal" action="{{ url('admin/users/') }}" method="POST">
                @csrf
                <div class="form-group row mb-3">
                    <label for="name" class="col-3 col-form-label">Nombre(s)</label>
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
                    <label for="first_last_name" class="col-3 col-form-label">Apellido Paterno</label>
                    <div class="col-9">
                        <input type="text" class="form-control{{ $errors->has('first_last_name') ? ' is-invalid' : '' }}" id="first_last_name" name="first_last_name" placeholder="Ingrese su apellido materno" value="{{ old('first_last_name') }}" required>
                        @if ($errors->has('first_last_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('first_last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="second_last_name" class="col-3 col-form-label">Apellido Materno</label>
                    <div class="col-9">
                        <input type="text" class="form-control{{ $errors->has('second_last_name') ? ' is-invalid' : '' }}" id="second_last_name" name="second_last_name" placeholder="Ingrese su apellido paterno" value="{{ old('second_last_name') }}" required>
                        @if ($errors->has('first_last_name'))
                            <span class="invalid-second_last_name" role="alert">
                                <strong>{{ $errors->first('second_last_name') }}</strong>
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
                    <label for="name" class="col-3 col-form-label">Teléfono</label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Ingrese su número de teléfono" value="{{ old('phone') }}">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="rol_id" class="col-3 col-form-label">Rol</label>
                    <div class="col-9">
                        <select class="form-control{{ $errors->has('rol_id') ? ' is-invalid' : '' }}" id="rol_id" name="rol_id">
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
@endsection
