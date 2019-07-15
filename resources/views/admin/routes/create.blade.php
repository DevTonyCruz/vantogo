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
                        <li class="breadcrumb-item active">Crear</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/routes') }}">Rutas</a>
                </h4>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title"><i class="mdi mdi-plus mr-1"></i>Agregar</h4>

                <form class="form-horizontal" action="{{ url('admin/routes/') }}" method="POST">
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
                        <label for="origin" class="col-3 col-form-label">Origen</label>
                        <div class="col-9">
                            <input type="text" id="origin" name="origin"
                                class="form-control{{ $errors->has('origin') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese el origen" value="{{ old('origin') }}" required>
                            @if ($errors->has('origin'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('origin') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="destination" class="col-3 col-form-label">Destino</label>
                        <div class="col-9">
                            <input type="text" id="destination" name="destination"
                                class="form-control{{ $errors->has('destination') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese el destino" value="{{ old('destination') }}"
                                required>
                            @if ($errors->has('destination'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('destination') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="price" class="col-3 col-form-label">Precio</label>
                        <div class="col-9">
                            <input type="numeric" id="price" name="price"
                                class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese el precio" value="{{ old('price') }}" required>
                            @if ($errors->has('price'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="kilometer" class="col-3 col-form-label">Distancia</label>
                        <div class="col-9">
                            <input type="numeric" id="kilometer" name="kilometer"
                                class="form-control{{ $errors->has('kilometer') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese la distancia en Km" value="{{ old('kilometer') }}" required>
                            @if ($errors->has('kilometer'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('kilometer') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group align-items-center row mb-3">
                        <label for="time" class="col-3 col-form-label">Tiempo</label>
                        <div class="col-4">
                            <input type="numeric" id="hour" name="hour"
                                class="form-control{{ $errors->has('hour') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese las horas" value="{{ old('hour') }}" required>
                            @if ($errors->has('hour'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('hour') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-4">
                            <input type="numeric" id="minutes" name="minutes"
                                class="form-control{{ $errors->has('minutes') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese los minutos" value="{{ old('minutes') }}" required>
                            @if ($errors->has('minutes'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('minutes') }}</strong>
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
