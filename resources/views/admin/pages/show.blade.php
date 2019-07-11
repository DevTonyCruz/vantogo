@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/pages') }}">Páginas</a>
                        </li>
                        <li class="breadcrumb-item active">Mostrar</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/pages') }}">Páginas</a>
                </h4>
            </div>
        </div>
    </div>
    
    <div class="row">
    
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
    
                    <h4 class="header-title">
                        <i class="mdi mdi-eye-outline"></i> Mostrar
                    </h4>
    
                    <div class="form-group row mb-3">
                        <label for="name" class="col-3 col-form-label">Titulo</label>
                        <label for="name" class="col-9 col-form-label">{{ $page->title }}</label>
    
                        <label for="name" class="col-3 col-form-label">Slug</label>
                        <label for="name" class="col-9 col-form-label">{{ $page->slug }}</label>
    
                    </div>
    
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>
    
    
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
    
                    <h4 class="header-title">
                        <i class="mdi mdi-eye-outline"></i> Contenido
                    </h4>
    
                    <div class="form-group row mb-3">
                        <label for="name" class="col-12 col-form-label">{!! $page->content !!}</label>
    
                    </div>
    
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>
    
    </div>
</div>
@endsection
