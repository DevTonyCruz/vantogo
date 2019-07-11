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
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/pages') }}">Páginas</a>
                </h4>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
    
                <h4 class="header-title"><i class="mdi mdi-plus mr-1"></i>Editar</h4>
    
                <form class="form-horizontal" action="{{ url('admin/pages/' . $page->id) }}" method="POST">
                    @csrf
                    @method('PUT')
    
                    <div class="form-group row mb-3">
                        <label for="name" class="col-3 col-form-label">Titulo</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="Ingrese el titulo" value="{{ $page->name }}" required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
    
                    <div class="form-group row mb-3">
                        <label for="content" class="col-3 col-form-label">Contenido</label>
                        <div class="col-9">
                            <textarea type="text" class="form-control wyswyg-content{{ $errors->has('content') ? ' is-invalid' : '' }}" id="content" name="content" placeholder="Ingrese el contenido">{{ $page->content }}</textarea>
                            @if ($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
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
    
            </div>  <!-- end card-body -->
        </div>  <!-- end card -->
    </div>
</div>

@endsection


@section('js')

<script type="text/javascript" defer>
    window.onload=function() {
        $('.wyswyg-content').summernote({
            height: 150,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']]
            ]
        });
	}
</script>

@endsection