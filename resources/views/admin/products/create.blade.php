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
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/products') }}">Productos</a>
                </h4>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title"><i class="mdi mdi-plus mr-1"></i>Agregar</h4>

                <form class="form-horizontal" action="{{ url('admin/products/') }}" method="POST" accept-charset="UTF-8"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="sku" class="col-3 col-form-label">SKU</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('sku') ? ' is-invalid' : '' }}"
                                id="sku" name="sku" placeholder="Ingrese su nombre" value="{{ old('sku') }}" required>
                            @if ($errors->has('sku'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sku') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="name" class="col-3 col-form-label">Nombre</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                id="name" name="name" placeholder="Ingrese su nombre" value="{{ old('name') }}"
                                required>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="description" class="col-3 col-form-label">Descripción</label>
                        <div class="col-9">
                            <textarea type="text"
                                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                id="description" name="description"
                                placeholder="Ingrese una descripción">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="price" class="col-3 col-form-label">Precio</label>
                        <div class="col-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="price-addon">$</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Ingrese el precio" id="price"
                                    name="price" aria-label="precio" aria-describedby="price-addon"
                                    value="{{ old('price') }}" require>
                                @if ($errors->has('category_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="category_id" class="col-3 col-form-label">Categoría</label>
                        <div class="col-9">
                            <select class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }} select2"
                                id="category_id" name="category_id" data-toggle="select2">
                                <option value="S">Seleccionar</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ (old('category_id') == $categoria->id ? "selected":"") }}>{{ $categoria->name }}
                                </option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('category_id') }}</strong>
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

                    <div class="form-group row mb-3">
                        <label for="initial" class="col-3 col-form-label">Stock inicial</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('initial') ? ' is-invalid' : '' }}"
                                id="initial" name="initial" placeholder="Ingrese el stock inicial"
                                value="{{ old('initial') }}">
                            @if ($errors->has('initial'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('initial') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="minimum" class="col-3 col-form-label">Stock mínimo</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('minimum') ? ' is-invalid' : '' }}"
                                id="minimum" name="minimum" placeholder="Ingrese el stock mínimo"
                                value="{{ old('minimum') }}">
                            @if ($errors->has('minimum'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('minimum') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="maximum" class="col-3 col-form-label">Stock máximo</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('maximum') ? ' is-invalid' : '' }}"
                                id="maximum" name="maximum" placeholder="Ingrese el stock máximo"
                                value="{{ old('maximum') }}">
                            @if ($errors->has('maximum'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('maximum') }}</strong>
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

@section('pagescript')

<script>
    document.getElementById('file').onchange = function () {
        console.log(this.value);
        document.getElementById('file-label').innerHTML = document.getElementById('file').files[0].name;
    }
</script>
@endsection
