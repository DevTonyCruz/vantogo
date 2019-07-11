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
                        <li class="breadcrumb-item active">Crear</li>
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

                <form class="form-horizontal" action="{{ url('admin/products/' . $producto->id) }}" method="POST"
                    accept-charset="UTF-8" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-3">
                        <label for="sku" class="col-3 col-form-label">SKU</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('sku') ? ' is-invalid' : '' }}"
                                id="sku" name="sku" placeholder="Ingrese su nombre" value="{{ $producto->sku }}"
                                required>
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
                                id="name" name="name" placeholder="Ingrese su nombre" value="{{ $producto->name }}"
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
                                placeholder="Ingrese una descripción">{{ $producto->description }}</textarea>
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
                                <input type="text" class="form-control" placeholder="Username" id="price" name="price"
                                    aria-label="precio" aria-describedby="price-addon" value="{{ $producto->price }}"
                                    required>
                                @if ($errors->has('price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('price') }}</strong>
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
                                    {{ ($producto->category_id == $categoria->id ? "selected":"") }}>
                                    {{ $categoria->name }}</option>
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
                        <label for="file" class="col-3 col-form-label">Imagen</label>
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
                                    <label class="custom-file-label">
                                        Elige un archivo
                                    </label>
                                </div>
                            </div>
                            <small class="form-text text-muted">
                                Archivo anterior:
                                <a href="{{ $producto->photo_url }}" download="">{{ $producto->name }}</a>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-3 col-form-label">Stock actual</label>
                        <label class="col-9 col-form-label">{{ $producto->stock->quantity }}
                            {{ ($producto->stock->quantity > 1) ? 'Piezas' : 'Pieza' }}</label>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="add_stock" class="col-3 col-form-label">Agregar a stock</label>
                        <div class="col-9">
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    placeholder="Ingrese la catidad que desea agregar al stock actual" id="add_stock"
                                    name="add_stock" required>
                                @if ($errors->has('add_stock'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('add_stock') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="description_move" class="col-3 col-form-label">Descripción de stock</label>
                        <div class="col-9">
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    placeholder="Ingrese información sobre el nuevo stock" id="description_move"
                                    name="description_move">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="minimum" class="col-3 col-form-label">Stock mínimo</label>
                        <div class="col-9">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Ingrese el stock mínimo"
                                    id="minimum" name="minimum" value="{{ $producto->stock->min_quantity }}" required>
                                @if ($errors->has('minimum'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('minimum') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="maximum" class="col-3 col-form-label">Stock máximo</label>
                        <div class="col-9">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Username" id="maximum"
                                    name="maximum" value="{{ $producto->stock->max_quantity }}" required>
                                @if ($errors->has('maximum'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('maximum') }}</strong>
                                </span>
                                @endif
                            </div>
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

@endsection
