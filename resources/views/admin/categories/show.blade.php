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
                            <a href="{{ url('admin/categories') }}">Categorías</a>
                        </li>
                        <li class="breadcrumb-item active">Mostrar</li>
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

                <h4 class="header-title">
                    <i class="mdi mdi-eye-outline"></i> Mostrar
                </h4>

                <div class="form-group row mb-3">
                    @if(!is_null($category->parent_id))
                    <label for="name" class="col-3 col-form-label">Categoría padre</label>
                    <label for="name" class="col-9 col-form-label">{{ $category->categoria->name }}</label>
                    @endif

                    <label for="name" class="col-3 col-form-label">Nombre</label>
                    <label for="name" class="col-9 col-form-label">{{ $category->name }}</label>

                    <label for="name" class="col-3 col-form-label">Descripción</label>
                    <label for="name" class="col-9 col-form-label">{{ $category->description }}</label>

                    <label for="name" class="col-3 col-form-label">Fotografía</label>
                    <div class="col-9">
                        <img src="{{ asset($category->photo_url) }}" alt="category-img" title="category-img"
                            class="img-fluid" style="max-width: 150px;" />
                    </div>
                </div>

            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>
@endsection
