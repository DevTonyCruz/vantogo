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
                            <a href="{{ url('admin/topics') }}">FAQ´s</a>
                        </li>
                        <li class="breadcrumb-item active">Temas</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/topics') }}">FAQ´s</a>
                </h4>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">
                    <i class="mdi mdi-view-list mr-1"></i> Editar
                </h4>
                <br>

                <form class="form-horizontal" action="{{ url('admin/topics/' . $tema->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-3">
                        <label for="title" class="col-3 col-form-label">Tema</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                id="title" name="title" placeholder="Ingrese el tema" value="{{ $tema->title }}"
                                required>
                            @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
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
                                placeholder="Ingrese una descripción">{{ $tema->description }}</textarea>
                            @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
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