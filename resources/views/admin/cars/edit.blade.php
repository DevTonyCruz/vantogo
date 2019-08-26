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
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/cars') }}">Vehiculos</a>
                </h4>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">
                    <i class="mdi mdi-square-edit-outline"></i> Editar
                </h4>

                <form class="form-horizontal" action="{{ url('admin/cars/' . $car->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-3">
                        <label for="brand" class="col-3 col-form-label">Marca</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('brand') ? ' is-invalid' : '' }}"
                                id="brand" name="brand" placeholder="Ingrese la marca" value="{{ $car->brand }}"
                                required>
                            @if ($errors->has('brand'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('brand') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="model" class="col-3 col-form-label">Modelo</label>
                        <div class="col-9">
                            <input type="text" id="model" name="model"
                                class="form-control{{ $errors->has('model') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese el modelo" value="{{ $car->model }}" required>
                            @if ($errors->has('model'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('model') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="color" class="col-3 col-form-label">Color</label>
                        <div class="col-9">
                            <input type="text" id="color" name="color"
                                class="form-control{{ $errors->has('color') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese el color" value="{{ $car->color }}">
                            @if ($errors->has('color'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('color') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="registration" class="col-3 col-form-label">Placas</label>
                        <div class="col-9">
                            <input type="text" id="registration" name="registration"
                                class="form-control{{ $errors->has('registration') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese las placas" value="{{ $car->registration }}"
                                required>
                            @if ($errors->has('registration'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('registration') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="capacity" class="col-3 col-form-label">Asientos</label>
                        <div class="col-9">
                            <input type="number" id="capacity" name="capacity"
                                class="form-control{{ $errors->has('capacity') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese los asientos disponibles" value="{{ $car->capacity }}" required>
                            @if ($errors->has('capacity'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('capacity') }}</strong>
                            </span>
                            @endif
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
