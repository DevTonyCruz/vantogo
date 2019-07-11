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
                    <li class="breadcrumb-item active">Principal</li>
                </ol>
            </div>
            <h4 class="page-title">
                <a href="{{ url('admin/banners') }}">Banners</a>
            </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">
                    <i class="mdi mdi-view-list mr-1"></i> Listado
                </h4>
                <p class="text-muted font-14 mb-4">
                    <br>
                    <a href="{{ url('admin/banners/create') }}">
                        <button type="button" class="btn btn-light">
                            <i class="mdi mdi-plus mr-1"></i>
                            <span>Agregar</span>
                        </button>
                    </a>
                </p>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Imagen o video</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Subtitulo</th>
                                <th scope="col">Activo</th>
                                <th scope="col">Fecha de registro</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $banner)

                            <tr>
                                <th scope="row">{{ $banner->id }}</th>
                                <td>
                                    @if($banner->type == 'image')
                                        <img src="{{ asset($banner->photo_url) }}" alt="banner-img" title="banner-img" class="rounded mr-3" height="48">
                                    @elseif ($banner->type == 'video')
                                        <a href="{{ asset($banner->video_link) }}" class="btn btn-primary btn-lg active">Ver video</a>
                                    @endif
                                </td>
                                <td>{{ $banner->title }}</td>
                                <td>{{ $banner->subtitle }}</td>
                                <td>
                                @php
                                $checked = ""
                                @endphp
                                @if($banner->status == 1)
                                    @php
                                    $checked = "checked"
                                    @endphp
                                @endif

                                <input type="checkbox" id="switch_{{ $banner->id }}" {{ $checked }} data-switch="success" onchange="document.getElementById('form_update_{{ $banner->id }}').submit();">
                                <label for="switch_{{ $banner->id }}" data-on-label="Si" data-off-label="No" class="mb-0 d-block"></label>

                                <form method="POST" id="form_update_{{ $banner->id }}" class="inline" action="{{ url('admin/banners/status/' . $banner->id) }}">
                                    @method('PUT')
                                    @csrf
                                </form>
                                </td>
                                <td>{{ $banner->created_at }}</td>
                                <td>
                                    <a href="{{ url('admin/banners/' . $banner->id . '/edit') }}" class="action-icon" title="Editar"> <i class=" mdi mdi-pencil"></i></a>
                                    <a href="javascript:void(0)" onclick="document.getElementById('form_delete_{{ $banner->id }}').submit();" class="action-icon" title="Eliminar"> <i class=" mdi mdi-trash-can-outline"></i></a>

                                    <form method="POST" id="form_delete_{{ $banner->id }}" class="inline" action="{{ url('admin/banners/' . $banner->id) }}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection
