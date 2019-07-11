@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/configuration') }}">Configuraciones</a>
                        </li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/configuration') }}">Configuraciones</a>
                </h4>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title"><i class="mdi mdi-plus mr-1"></i>Editar</h4>

                <form class="form-horizontal" action="{{ url('admin/configuration/' . $configuration->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group row mb-3">
                        <label for="answer" class="col-3 col-form-label">Llave</label>
                        <label for="answer" class="col-9 col-form-label">{{ $configuration->key }}</label>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="value" class="col-3 col-form-label">Valor</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}"
                                id="value" name="value" placeholder="Ingrese el valor de esta configuración"
                                value="{{ $configuration->values }}" required>
                            @if ($errors->has('value'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('value') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-0 justify-content-end row">
                        <div class="col-9">
                            <button type="submit" class="btn btn-info">Editar</button>
                        </div>
                    </div>
                </form>

            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>

@endsection
