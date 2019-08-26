@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/drivers') }}">Choferes</a>
                        </li>
                        <li class="breadcrumb-item active">Mostrar</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/drivers') }}">Choferes</a>
                </h4>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">
                        <i class="mdi mdi-eye-outline"></i> Mostrar
                    </h4>

                    <div class="form-group row mb-3">
                        <label class="col-3 col-form-label">Nombre</label>
                        <label
                            class="col-9 col-form-label">{{ $driver->name . ' ' . $driver->first_last_name . ' ' . $driver->second_last_name }}</label>

                        <label class="col-3 col-form-label">Correo</label>
                        <label class="col-9 col-form-label">{{ $driver->email }}</label>

                        <label class="col-3 col-form-label">Teléfono</label>
                        <label class="col-9 col-form-label">{{ $driver->phone }}</label>

                        <label class="col-3 col-form-label">Dirección</label>
                        <label class="col-9 col-form-label">{{ $driver->direction }}</label>

                        <label class="col-3 col-form-label">Licencia</label>
                        <label class="col-9 col-form-label">{{ $driver->license }}</label>

                        <label class="col-3 col-form-label">Fotografía</label>
                        <label class="col-9 col-form-label">
                            <img src="{{ asset($driver->photo) }}" class="img-fluid img-thumbnail">
                        </label>
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div>
    </div>
</div>

@endsection
