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
                        <li class="breadcrumb-item active">Principal</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/pages') }}">Páginas</a>
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
                    <br>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Titulo</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Activo</th>
                                    <th scope="col">Fecha de registro</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pages as $page)
    
                                <tr>
                                    <th scope="row">{{ $page->id }}</th>
                                    <td>{{ $page->name }}</td>
                                    <td>{{ $page->slug }}</td>
                                    <td>
                                    @php
                                    $checked = ""
                                    @endphp
                                    @if($page->status == 1)
                                        @php
                                        $checked = "checked"
                                        @endphp
                                    @endif
    
                                    <input type="checkbox" id="switch_{{ $page->id }}" {{ $checked }} data-switch="success" onchange="document.getElementById('form_update_{{ $page->id }}').submit();">
                                    <label for="switch_{{ $page->id }}" data-on-label="Si" data-off-label="No" class="mb-0 d-block"></label>
    
                                    <form method="POST" id="form_update_{{ $page->id }}" class="inline" action="{{ url('admin/pages/status/' . $page->id) }}">
                                        @method('PUT')
                                        @csrf
                                    </form>
                                    </td>
                                    <td>{{ $page->created_at }}</td>
                                    <td>
                                        <a href="{{ url('admin/pages/' . $page->id) }}" class="action-icon" title="Ver"> <i class=" mdi mdi-eye-outline"></i></a>
                                        <a href="{{ url('admin/pages/' . $page->id . '/edit') }}" class="action-icon" title="Editar"> <i class=" mdi mdi-pencil"></i></a>
                                        <a href="javascript:void(0)" onclick="document.getElementById('form_delete_{{ $page->id }}').submit();" class="action-icon" title="Eliminar"> <i class=" mdi mdi-trash-can-outline"></i></a>
    
                                        <form method="POST" id="form_delete_{{ $page->id }}" class="inline" action="{{ url('admin/pages/' . $page->id) }}">
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
</div>
@endsection
