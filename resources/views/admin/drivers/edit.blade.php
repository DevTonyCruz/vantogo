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
                        <label for="imput_files_id" class="col-12 col-sm-3 col-form-label">* Imagen del chofer</label>
                        <div class="col-12 col-sm-9">
                            <div class="custom-file">
                                <input type="file" id="file_driver" name="file_driver"
                                    class="custom-file-input form-control {{ $errors->has('file_driver') ? ' is-invalid' : '' }}"
                                    accept="image/png,image/gif,image/jpeg">
                                @if ($errors->has('file_driver'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file_driver') }}</strong>
                                </span>
                                @endif
                                @if(is_null($driver->file_driver))
                                <img class="img-thumbnail d-none my-1" id="chofer-img-out" width="120" src="" />
                                @else
                                <img class="img-thumbnail my-1" id="chofer-img-out" width="120" src="{{ asset($driver->file_driver) }}" style="display: initial; vertical-align: unset;" />
                                @endif
                                <label class="custom-file-label" id="file-label">
                                    Elige un archivo
                                </label>
                            </div>
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
                                placeholder="Ingrese un teléfono" value="{{ $driver->phone }}">
                            @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="direction" class="col-3 col-form-label">Dirección</label>
                        <div class="col-9">
                            <input type="text" id="direction" name="direction"
                                class="form-control{{ $errors->has('direction') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese una dirección" value="{{ $driver->direction }}">
                            @if ($errors->has('direction'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('direction') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="license" class="col-3 col-form-label">Licencia</label>
                        <div class="col-9">
                            <input type="text" id="license" name="license"
                                class="form-control{{ $errors->has('license') ? ' is-invalid' : '' }}"
                                placeholder="Ingrese una licencia" value="{{ $driver->license }}">
                            @if ($errors->has('license'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('license') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="imput_files_id" class="col-12 col-sm-3 col-form-label">* Imagen de licencia</label>
                        <div class="col-12 col-sm-9">
                            <div class="custom-file">
                                <input type="file" id="file_license" name="file_license"
                                    class="custom-file-input form-control {{ $errors->has('file_license') ? ' is-invalid' : '' }}"
                                    accept="image/png,image/gif,image/jpeg">
                                @if ($errors->has('file_license'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file_license') }}</strong>
                                </span>
                                @endif
                                @if(is_null($driver->file_license))
                                <img class="img-thumbnail d-none my-1" id="licencia-img-out" width="120" src="" />
                                @else
                                <img class="img-thumbnail my-1" id="licencia-img-out" width="120" src="{{ asset($driver->file_license) }}" style="display: initial; vertical-align: unset;"/>
                                @endif
                                <label class="custom-file-label" id="file-label">
                                    Elige un archivo
                                </label>
                            </div>
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
