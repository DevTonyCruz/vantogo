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
                        <li class="breadcrumb-item active">Crear</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ route('travels.index') }}">Viajes</a>
                </h4>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title"><i class="mdi mdi-plus mr-1"></i>Agregar</h4>

                <form class="form-horizontal" action="{{ url('admin/travels/') }}" method="POST">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="code" class="col-3 col-form-label">Código</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                id="code" name="code" placeholder="Ingrese el código" value="{{ old('code') }}"
                                required>
                            @if ($errors->has('code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="route_id" class="col-3 col-form-label">Ruta</label>
                        <div class="col-9">
                            <select class="form-control{{ $errors->has('route_id') ? ' is-invalid' : '' }} select2"
                                id="route_id" name="route_id" data-toggle="select2">
                                <option value="S">Seleccionar</option>

                                @foreach ($routes as $route)
                                <option value="{{ $route->id }}"
                                    {{ (old('route_id') == $route->id ? "selected":"") }}>{{ $route->code }}
                                </option>
                                @endforeach
                            </select>
                            @if ($errors->has('route_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('route_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="car_id" class="col-3 col-form-label">Vehículo</label>
                        <div class="col-9">
                            <select class="form-control{{ $errors->has('car_id') ? ' is-invalid' : '' }} select2"
                                id="car_id" name="car_id" data-toggle="select2">
                                <option value="S">Seleccionar</option>

                                @foreach ($cars as $car)
                                <option value="{{ $car->id }}"
                                    {{ (old('car_id') == $car->id ? "selected":"") }}>{{ $car->brand . ' - ' . $car->registration }}
                                </option>
                                @endforeach
                            </select>
                            @if ($errors->has('car_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('car_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="driver_id" class="col-3 col-form-label">Chofer</label>
                        <div class="col-9">
                            <select class="form-control{{ $errors->has('driver_id') ? ' is-invalid' : '' }} select2"
                                id="driver_id" name="driver_id" data-toggle="select2">
                                <option value="S">Seleccionar</option>

                                @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}"
                                    {{ (old('driver_id') == $driver->id ? "selected":"") }}>{{ $driver->name . ' ' . $driver->first_last_name . ' ' . $driver->second_last_name }}
                                </option>
                                @endforeach
                            </select>
                            @if ($errors->has('driver_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('driver_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="date" class="col-3 col-form-label">Fecha de salida</label>
                        <div class="col-9">
                            <input type="text" id="date" name="date"
                                class="form-control date{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                data-toggle="date-picker" data-single-date-picker="true" value="{{ old('date') }}" required>
                            @if ($errors->has('date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="hour_ini" class="col-3 col-form-label">Hora de salida</label>
                        <div class="col-9">
                            <input type="text" id="hour_ini" name="hour_ini"
                                class="form-control{{ $errors->has('hour_ini') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese la hora de salida" value="{{ old('hour_ini') }}"
                                data-toggle="timepicker" data-show-meridian="false" required>
                            @if ($errors->has('hour_ini'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('hour_ini') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="hour_fin" class="col-3 col-form-label">Hora de llegada</label>
                        <div class="col-9">
                            <input type="text" id="hour_fin" name="hour_fin"
                                class="form-control{{ $errors->has('hour_fin') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese la hora de salida" value="{{ old('hour_fin') }}"
                                data-toggle="timepicker" data-show-meridian="false" required>
                            @if ($errors->has('hour_fin'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('hour_fin') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="place" class="col-3 col-form-label">Lugar de salida</label>
                        <div class="col-9">
                            <input type="numeric" id="place" name="place"
                                class="form-control{{ $errors->has('place') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese el lugar de salida" value="{{ old('place') }}" required>
                            @if ($errors->has('place'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('place') }}</strong>
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

            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>
@endsection
