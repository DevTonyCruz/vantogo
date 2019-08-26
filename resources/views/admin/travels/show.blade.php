@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('travels.index') }}">Viajes</a>
                        </li>
                        <li class="breadcrumb-item active">Mostrar</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ route('travels.index') }}">Viajes</a>
                </h4>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">
                        <i class="mdi mdi-eye-outline"></i> Mostrar
                    </h4>

                    <div class="form-group row mb-3">
                        <label class="col-3 col-form-label">Código del viaje</label>
                        <label class="col-9 col-form-label">{{ $travel->code }}</label>

                        <label class="col-3 col-form-label">Código de la ruta</label>
                        <label class="col-9 col-form-label">{{ $travel->route->code }}</label>

                        <label class="col-3 col-form-label">Vehículo</label>
                        <label class="col-9 col-form-label">{{ $travel->car->brand . ' - ' . $travel->car->registration }}</label>

                        <label class="col-3 col-form-label">Chofer</label>
                        <label class="col-9 col-form-label">{{ $travel->driver->name . ' ' . $travel->driver->first_last_name . ' ' . $travel->driver->second_last_name }}</label>

                        <label class="col-3 col-form-label">Fecha de salida</label>
                        <label class="col-9 col-form-label">{{ $travel->date }}</label>

                        <label class="col-3 col-form-label">Hora de salida</label>
                        <label class="col-9 col-form-label">{{ $travel->hour }}</label>

                        <label class="col-3 col-form-label">Lugar de salida</label>
                        <label class="col-9 col-form-label">{{ $travel->place }}</label>
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div>
    </div>
</div>

@endsection
