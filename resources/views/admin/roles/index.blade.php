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
                        <li class="breadcrumb-item active">Lista</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ route('roles.index') }}">Roles</a>
                </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">
                        <i class="mdi mdi-view-list mr-1"></i> Listado
                    </h4>
                    <p class="text-muted font-14 mb-4">
                        <br>
                        <a href="{{ url('admin/roles/create') }}">
                            <button type="button" class="btn btn-light">
                                <i class="mdi mdi-plus mr-1"></i>
                                <span>Agregar</span>
                            </button>
                        </a>
                    </p>

                    <div class="table-responsive">
                        <table class="table mb-0" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Activo</th>
                                    <th scope="col">Fecha de creación</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $rol)
                                <tr>
                                    <th scope="row">{{ $rol->id }}</th>
                                    <td>{{ $rol->name }}</td>
                                    <td>{{ $rol->description }}</td>
                                    <td>
                                        <div>
                                            @php
                                            $checked = ""
                                            @endphp
                                            @if($rol->status == 1)
                                            @php
                                            $checked = "checked"
                                            @endphp
                                            @endif

                                            <input type="checkbox" id="switch_{{ $rol->id }}" {{ $checked }}
                                                data-switch="success"
                                                onchange="document.getElementById('form_update_{{ $rol->id }}').submit();">
                                            <label for="switch_{{ $rol->id }}" data-on-label="Si" data-off-label="No"
                                                class="mb-0 d-block"></label>

                                            <form method="POST" id="form_update_{{ $rol->id }}" class="inline"
                                                action="{{ url('admin/roles/status/' . $rol->id) }}">
                                                @method('PUT')
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $rol->created_at }}</td>
                                    <td>
                                        <a href="{{ url('admin/roles/' . $rol->id) }}" class="action-icon" title="Ver">
                                            <i class=" mdi mdi-eye-outline"></i></a>
                                        <a href="{{ url('admin/roles/' . $rol->id .'/edit') }}" class="action-icon"
                                            title="Ver">
                                            <i class=" mdi mdi-pencil"></i></a>
                                        <a href="{{ url('admin/roles/permission/' . $rol->id) }}" class="action-icon"
                                            title="Permisos"> <i class=" mdi mdi-lock-open-outline"></i></a>

                                        @if($rol->id != 1)
                                        <a href="javascript:void(0)"
                                            onclick="document.getElementById('form_delete_{{ $rol->id }}').submit();"
                                            class="action-icon" title="Ver"> <i
                                                class=" mdi mdi-trash-can-outline"></i></a>

                                        <form method="POST" id="form_delete_{{ $rol->id }}" class="inline"
                                            action="{{ url('admin/roles/' . $rol->id) }}">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        @endif
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

@section('js')
<script type="text/javascript" defer>

    window.onload=function() {
        $("#datatable").DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            }});
	}
</script>
@endsection
