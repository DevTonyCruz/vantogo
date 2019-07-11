@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin/banners') }}">Banners</a>
                    </li>
                    <li class="breadcrumb-item active">Agregar</li>
                </ol>
            </div>
            <h4 class="page-title">
                <a href="{{ url('admin/banners') }}">Banners</a>
            </h4>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">

            <h4 class="header-title"><i class="mdi mdi-plus mr-1"></i>Agregar</h4>

            <form class="form-horizontal" id="form-banner-admin" action="{{ url('admin/banners/') }}" method="POST"
                accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <div class="form-group row mb-3">
                    <label for="title" class="col-3 col-form-label">Tipo de banner</label>
                    <div class="col-9">
                        <select type="text" class="form-control" id="type" name="type">
                            <option selected="" disabled="">Seleciona una opción</option>
                            <option value="image" {{ (old('type') == 'image') ? 'selected' : ''}}>Imagen</option>
                            <option value="video" {{ (old('type') == 'video') ? 'selected' : ''}}>Video</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="title" class="col-3 col-form-label">Titulo</label>
                    <div class="col-9">
                        <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                            id="title" name="title" placeholder="Ingrese el titulo del banner"
                            value="{{ old('title') }}" required>
                        @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="subtitle" class="col-3 col-form-label">Subtitulo</label>
                    <div class="col-9">
                        <input type="text" class="form-control{{ $errors->has('subtitle') ? ' is-invalid' : '' }}"
                            id="subtitle" name="subtitle" placeholder="Ingrese el subtitulo del banner"
                            value="{{ old('subtitle') }}" required>
                        @if ($errors->has('subtitle'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('subtitle') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="description" class="col-3 col-form-label">Descripción</label>
                    <div class="col-9">
                        <textarea type="text"
                            class="form-control wyswyg-content{{ $errors->has('description') ? ' is-invalid' : '' }}"
                            id="description" name="description"
                            placeholder="Ingrese una descripción del banner">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div id="type-image" style="{{ (old('type') == 'image') ? 'display: block !important;' : '' }}">

                    <div class="form-group row mb-3">
                        <label for="file" class="col-3 col-form-label">Imagen</label>
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
                        <label for="button_text" class="col-3 col-form-label">Texto de botón</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('button_text') ? ' is-invalid' : '' }}"
                                id="button_text" name="button_text" 
                                placeholder="Ingrese el texto del botón"
                                value="{{ old('button_text') }}">
                            @if ($errors->has('button_text'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('button_text') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="url_button" class="col-3 col-form-label">Enlace de botón</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('url_button') ? ' is-invalid' : '' }}"
                                id="url_button" name="url_button" 
                                placeholder="Ingrese el enlace del botón"
                                value="{{ old('url_button') }}">
                            @if ($errors->has('url_button'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('url_button') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="content" class="col-3 col-form-label">Contenido</label>
                        <div class="col-9">
                            <div class="form-wyswyg{{ $errors->has('content') ? ' is-invalid' : '' }}">
                                {!! old('content') !!}</div>
                            <input type="hidden" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}"
                                id="content" name="content" value="{!! old('content') !!}">
                            @if ($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <label class="col-3 col-form-label">Posición</label>
                        <div class="col-9 form-row align-items-center ">
                            <div class="col-auto">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="izquierda" name="position" class="custom-control-input" value="izquierda" checked>
                                    <label class="custom-control-label" for="izquierda">Izquierda</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="centro" name="position" class="custom-control-input" value="centro">
                                    <label class="custom-control-label" for="centro">Centro</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="derecha" name="position" class="custom-control-input" value="derecha">
                                    <label class="custom-control-label" for="derecha">Derecha</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="type-video" style="{{ (old('type') == 'video') ? 'display: block !important;' : '' }}">

                    <div class="form-group row mb-3">
                        <label for="video_link" class="col-3 col-form-label">Enlace de video</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('video_link') ? ' is-invalid' : '' }}"
                                id="video_link" name="video_link" 
                                placeholder="Ingrese el enlace del video a mostrar"
                                value="{{ old('video_link') }}">
                            @if ($errors->has('video_link'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('video_link') }}</strong>
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
@endsection

@section('pagecss')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('pagescript')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="{{ asset('js/wyswyg.js') }}" defer></script>

<script type="text/javascript" defer>

    document.getElementById("form-banner-admin").addEventListener("submit", function(event){
        event.preventDefault();

        var content = quill.root.innerHTML;

        $("#content").val(content);

        $('#form-banner-admin').submit();
      });

    document.getElementById("type").addEventListener("change", function(event){
            var type = this.value;

            alert(type);

            switch(type){
                case "image":
                    $("#type-image").show();
                    $("#type-video").hide();
                    break;
                case "video":
                    $("#type-video").show();
                    $("#type-image").hide();
                    break;
                default:
                    $("#type-video").hide();
                    $("#type-image").hide();
                    break;
            }

    });

</script>
@endsection