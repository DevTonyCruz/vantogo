@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/routes') }}">Rutas</a>
                        </li>
                        <li class="breadcrumb-item active">Mostrar</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/routes') }}">Rutas</a>
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
                        <label class="col-3 col-form-label">Código</label>
                        <label class="col-9 col-form-label">{{ $route->code }}</label>

                        <label class="col-3 col-form-label">Origen</label>
                        <label class="col-9 col-form-label">{{ $route->origin }}</label>

                        <label class="col-3 col-form-label">Destino</label>
                        <label class="col-9 col-form-label">{{ $route->destination }}</label>

                        <label class="col-3 col-form-label">Precio</label>
                        <label class="col-9 col-form-label">${{ $route->price }}</label>

                        <label class="col-3 col-form-label">Distancia</label>
                        <label class="col-9 col-form-label">{{ $route->kilometer }}</label>

                        <label class="col-3 col-form-label">Tiempo</label>
                        <label class="col-9 col-form-label">{{ $route->hour }} hora(s) {{ $route->minute }} minuto(s)</label>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div>
    </div>
</div>

@endsection
