@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/cars') }}">Vehiculos</a>
                        </li>
                        <li class="breadcrumb-item active">Mostrar</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/cars') }}">Vehiculos</a>
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
                        <label class="col-3 col-form-label">Marca</label>
                        <label class="col-9 col-form-label">{{ $car->brand }}</label>

                        <label class="col-3 col-form-label">Modelo</label>
                        <label class="col-9 col-form-label">{{ $car->model }}</label>

                        <label class="col-3 col-form-label">Color</label>
                        <label class="col-9 col-form-label">{{ $car->color }}</label>

                        <label class="col-3 col-form-label">Placas</label>
                        <label class="col-9 col-form-label">{{ $car->registration }}</label>

                        <label class="col-3 col-form-label">Asientos</label>
                        <label class="col-9 col-form-label">{{ $car->capacity }}</label>
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div>
    </div>
</div>

@endsection
