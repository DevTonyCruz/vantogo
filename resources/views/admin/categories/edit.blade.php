@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/categories') }}">Productos</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/categories') }}">Categorías</a>
                        </li>
                        <li class="breadcrumb-item active">Crear</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/categories') }}">Categorías</a>
                </h4>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title"><i class="mdi mdi-plus mr-1"></i>Agregar</h4>

                <form class="form-horizontal" action="{{ url('admin/categories/' . $category->id) }}" method="POST"
                    accept-charset="UTF-8" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group row mb-3">
                        <label for="parent_id" class="col-3 col-form-label">Categoría padre</label>
                        <div class="col-9">
                            <select class="form-control{{ $errors->has('parent_id') ? ' is-invalid' : '' }} select2"
                                id="parent_id" name="parent_id" data-toggle="select2">
                                <option value="S">Seleccionar</option>
                                @foreach ($categories as $category_a)
                                <option value="{{ $category_a->id }}"
                                    {{ ($category->parent_id == $category_a->id ? "selected":"") }}>
                                    {{ $category_a->name }}
                                </option>
                                @endforeach
                            </select>
                            @if ($errors->has('parent_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('parent_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="name" class="col-3 col-form-label">Nombre</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                id="name" name="name" placeholder="Ingrese el nombre de la categoría"
                                value="{{ $category->name }}" required>
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
                                placeholder="Ingrese una descripción">{{ $category->description }}</textarea>
                            @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="imput_files_id" class="col-3 col-form-label">Imagen</label>
                        <div class="col-9">
                            <div class="input-group">
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
                            <small class="form-text text-muted">
                                Archivo anterior:
                                <a href="{{ asset($category->photo_url) }}" target="_blank">{{ $category->name }}</a>
                            </small>
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
