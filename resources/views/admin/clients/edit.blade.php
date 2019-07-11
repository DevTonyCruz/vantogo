@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin/clients') }}">Clientes</a>
                    </li>
                    <li class="breadcrumb-item active">Editar Contraseña</li>
                </ol>
            </div>
            <h4 class="page-title">
                <a href="{{ url('admin/clients') }}">Clientes</a>
            </h4>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="card">
        <div class="card-body">

            <h4 class="mb-3 header-title">Editar contraseña</h4>

            <form class="form-horizontal" action="{{ url('admin/clients/password/' . $id) }}" method="POST">
                @csrf
                @method('PUT')
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
                    <label for="password" class="col-3 col-form-label">Confirme contraseña</label>
                    <div class="col-9">
                        <input class="form-control" type="password" id="password-confirm" placeholder="Ingrese su contraseña" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group mb-0 justify-content-end row">
                    <div class="col-9">
                        <button type="submit" class="btn btn-info">Actualizar</button>
                        <small class="text-warning">Al editar el usuario se cerrara la sesión actual</small>
                    </div>
                </div>
            </form>

        </div>  <!-- end card-body -->
    </div>  <!-- end card -->
</div>
@endsection
