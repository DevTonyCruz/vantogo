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
                        <li class="breadcrumb-item active">Mostrar</li>
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

                <h4 class="header-title">
                    <i class="mdi mdi-eye-outline"></i> Mostrar
                </h4>

                <div class="form-group row mb-3">
                    <label class="col-3 col-form-label">Nombre</label>
                    <label class="col-9 col-form-label">{{ $user->name }}</label>

                    <label class="col-3 col-form-label">Correo</label>
                    <label class="col-9 col-form-label">{{ $user->email }}</label>

                    <label class="col-3 col-form-label">Rol</label>
                    <label class="col-9 col-form-label">{{ $user->rol->name }}</label>
                </div>

            </div>  <!-- end card-body -->
        </div>  <!-- end card -->
    </div>
</div>

@endsection
