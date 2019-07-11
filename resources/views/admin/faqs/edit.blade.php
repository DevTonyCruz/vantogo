@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/faqs') }}">Preguntas Frecuentes</a>
                        </li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/faqs') }}">Preguntas Frecuentes</a>
                </h4>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title"><i class="mdi mdi-plus mr-1"></i>Editar</h4>

                <form class="form-horizontal" action="{{ url('admin/faqs/' . $faq->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group row mb-3">
                        <label for="topic" class="col-3 col-form-label">Tema</label>
                        <div class="col-9">
                            <select class="form-control{{ $errors->has('topic') ? ' is-invalid' : '' }} select2"
                                id="topic" name="topic" data-toggle="select2">
                                <option value="S">Seleccionar</option>

                                @foreach ($faqsCategory as $faqCategory)
                                <option value="{{ $faqCategory->id }}"
                                    {{ ($faq->topic_id == $faqCategory->id ? "selected":"") }}>
                                    {{ $faqCategory->title }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('topic'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('topic') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="question" class="col-3 col-form-label">Pregunta</label>
                        <div class="col-9">
                            <input type="text" class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}"
                                id="question" name="question" placeholder="Ingrese la pregunta"
                                value="{{ $faq->question }}" required>
                            @if ($errors->has('question'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('question') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="answer" class="col-3 col-form-label">Respuesta</label>
                        <div class="col-9">
                            <textarea type="text"
                                class="form-control wyswyg-content{{ $errors->has('answer') ? ' is-invalid' : '' }}"
                                id="answer" name="answer"
                                placeholder="Ingrese la respuesta">{!! $faq->answer !!}</textarea>
                            @if ($errors->has('answer'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('answer') }}</strong>
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