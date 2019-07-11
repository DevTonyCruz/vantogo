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
                            <a href="{{ url('admin/products') }}">Productos</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/products/' . $id) }}">Detalle</a>
                        </li>
                        <li class="breadcrumb-item active">Agregar Imagen</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/products') }}">Agregar Imagen</a>
                </h4>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title"><i class="mdi mdi-plus mr-1"></i>Agregar</h4>

                <form class="form-horizontal" action="{{ url('admin/products/images') }}" method="POST"
                    accept-charset="UTF-8" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row mb-3">
                        <label for="position" class="col-3 col-form-label">Posición</label>
                        <div class="col-9">
                            <select class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }} select2"
                                id="position" name="position" data-toggle="select2">
                                <option value="S">Seleccionar</option>
                                <option value="1" {{ old('position') == 1 ? "selected":"" }}>Primera Posición</option>
                                <option value="2" {{ old('position') == 2 ? "selected":"" }}>Segunda Posición</option>
                                <option value="3" {{ old('position') == 3 ? "selected":"" }}>Tercera Posición</option>
                                <option value="4" {{ old('position') == 4 ? "selected":"" }}>Cuarta Posición</option>
                                <option value="5" {{ old('position') == 5 ? "selected":"" }}>Quinta Posición</option>
                            </select>
                            @if ($errors->has('position'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('position') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="imput_files_id" class="col-3 col-form-label">Imagen</label>
                        <div class="col-9">
                            <div class="custom-file">
                                <input type="file" id="file" name="file"
                                    class="custom-file-input form-control {{ $errors->has('file') ? ' is-invalid' : '' }}"
                                    accept="image/x-png,image/gif,image/jpeg">
                                @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
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
                        <input type="hidden" id="product_id" name="product_id" value="{{ $id }}">
                    </div>
                </form>

            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>

@endsection

@section('pagescript')

<script defer>
    document.getElementById('file').onchange = function () {
        console.log(this.value);
        document.getElementById('file-label').innerHTML = document.getElementById('file').files[0].name;
    }
</script>
@endsection
