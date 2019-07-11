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
                        <li class="breadcrumb-item active">Agregar</li>
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
    
                <h4 class="header-title"><i class="mdi mdi-plus mr-1"></i>Agregar</h4>
    
                <form class="form-horizontal" action="{{ url('admin/pages/') }}" method="POST">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="title" class="col-3 col-form-label">Titulo</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" placeholder="Ingrese el titulo del banner" value="{{ old('title') }}" required>
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
    
                    <div class="form-group row mb-3">
                        <label for="slug" class="col-3 col-form-label">Slug</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" id="slug" name="slug" placeholder="Ingrese el slug de la página" value="{{ old('slug') }}" required>
                            @if ($errors->has('slug'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
    
                    <div class="form-group row mb-3">
                        <label for="content" class="col-3 col-form-label">Contenido</label>
                        <div class="col-9">
                            <textarea type="text" class="form-control wyswyg-content{{ $errors->has('content') ? ' is-invalid' : '' }}" id="content" name="content" placeholder="Ingrese el contenido">{{ old('content') }}</textarea>
                            @if ($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
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
    
            </div>  <!-- end card-body -->
        </div>  <!-- end card -->
    </div>
</div>
@endsection

@section('pagecss')
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
@endsection

@section('pagescript')
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js" defer></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js" defer></script>
<script type="text/javascript" defer>
    $(document).ready(function() {
        $('.wyswyg-content').summernote({
            height: 150,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style', 'bold', 'italic', 'underline','blockquote']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['paragraph']]


                /*['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]*/
            ]
        });
    });
</script>

@endsection
