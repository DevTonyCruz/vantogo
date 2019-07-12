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
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/drivers') }}">Choferes</a>
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

                <form class="form-horizontal" action="{{ url('admin/drivers/' . $driver->id) }}" method="POST"
                    accept-charset="UTF-8" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-3">
                        <label for="name" class="col-3 col-form-label">Nombre</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                id="name" name="name" placeholder="Ingrese su nombre" value="{{ $driver->name }}"
                                required>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="first_last_name" class="col-3 col-form-label">Apellido paterno</label>
                        <div class="col-9">
                            <input type="text" id="first_last_name" name="first_last_name"
                                class="form-control{{ $errors->has('first_last_name') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese el apellido paterno" value="{{ $driver->first_last_name }}" required>
                            @if ($errors->has('first_last_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('first_last_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="second_last_name" class="col-3 col-form-label">Apellido materno</label>
                        <div class="col-9">
                            <input type="text" id="second_last_name" name="second_last_name"
                                class="form-control{{ $errors->has('second_last_name') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese el apellido materno" value="{{ $driver->second_last_name }}"
                                required>
                            @if ($errors->has('second_last_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('second_last_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="email" class="col-3 col-form-label">Correo electrónico</label>
                        <div class="col-9">
                            <input type="text" id="email" name="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese un correo electrónico" value="{{ $driver->email }}" required>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="phone" class="col-3 col-form-label">Teléfono</label>
                        <div class="col-9">
                            <input type="text" id="phone" name="phone"
                                class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese un teléfono" value="{{ $driver->phone }}" required>
                            @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="license" class="col-3 col-form-label">Licencia</label>
                        <div class="col-9">
                            <input type="text" id="license" name="license"
                                class="form-control{{ $errors->has('license') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese una licencia" value="{{ $driver->license }}" required>
                            @if ($errors->has('license'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('license') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="photo" class="col-3 col-form-label">Imagen</label>
                        <div class="col-9">
                            <div class="custom-file">
                                <input type="file" id="photo" name="photo"
                                    class="custom-file-input form-control {{ $errors->has('photo') ? ' is-invalid' : '' }}"
                                    accept="image/x-png,image/gif,image/jpeg">
                                @if ($errors->has('photo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                                @endif
                                <label class="custom-file-label" id="file-label">
                                    Elige un archivo
                                </label>
                            </div>
                        </div>
                        @if(!is_null($driver->photo))
                        <a href="{{ asset($driver->photo) }}" download="" class="text-small">
                            {{ $driver->name . ' ' . $driver->first_last_name . ' ' . $driver->second_last_name }}
                        </a>
                        @endif
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
