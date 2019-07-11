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
                            <a href="{{ route('roles.index') }}">Roles</a>
                        </li>
                        <li class="breadcrumb-item active">Mostrar</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ route('roles.index') }}">Roles</a>
                </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="mb-3 header-title">Mostrar registro</h4>
                <div class="form-group row mb-3">
                    <label class="col-3 col-form-label">Nombre</label>
                    <label class="col-9 col-form-label"><b>{{ $rol->name }}</b></label>

                    <label class="col-3 col-form-label">Descripción</label>
                    <label class="col-3 col-form-label"><b>{{ $rol->description }}</b></label>
                </div>

            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>

@endsection
