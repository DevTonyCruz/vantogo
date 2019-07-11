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
                            <a href="{{ url('admin/topics') }}">Temas</a>
                        </li>
                        <li class="breadcrumb-item active">Lista</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/topics') }}">Temas</a>
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
                        <a href="{{ url('admin/topics/create') }}">
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
                                    <th scope="col">Titulo</th>
                                    <th scope="col">Preguntas</th>
                                    <th scope="col">Activo</th>
                                    <th scope="col">Fecha de registro</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($temas as $tema)

                                <tr>
                                    <th scope="row">{{ $tema->id }}</th>
                                    <td>{{ $tema->title }}</td>
                                    <td>{{ '5' }}</td>
                                    <td>
                                        @php
                                        $checked = ""
                                        @endphp
                                        @if($tema->status == 1)
                                        @php
                                        $checked = "checked"
                                        @endphp
                                        @endif

                                        <input type="checkbox" id="switch_{{ $tema->id }}" {{ $checked }}
                                            data-switch="success"
                                            onchange="document.getElementById('form_update_{{ $tema->id }}').submit();">
                                        <label for="switch_{{ $tema->id }}" data-on-label="Si" data-off-label="No"
                                            class="mb-0 d-block"></label>

                                        <form method="POST" id="form_update_{{ $tema->id }}" class="inline"
                                            action="{{ url('admin/topics/status/' . $tema->id) }}">
                                            @method('PUT')
                                            @csrf
                                        </form>
                                    </td>
                                    <td>{{ $tema->created_at }}</td>
                                    <td>
                                        <a href="{{ url('admin/topics/' . $tema->id) }}" class="action-icon"
                                            title="Ver"> <i class=" mdi mdi-eye-outline"></i></a>
                                            <a href="{{ url('admin/topics/' . $tema->id . '/edit') }}" class="action-icon"
                                                title="Editar"> <i class=" mdi mdi-pencil"></i></a>
                                        <a href="javascript:void(0)"
                                            onclick="document.getElementById('form_delete_{{ $tema->id }}').submit();"
                                            class="action-icon" title="Eliminar"> <i
                                                class=" mdi mdi-trash-can-outline"></i></a>

                                        <form method="POST" id="form_delete_{{ $tema->id }}" class="inline"
                                            action="{{ url('admin/topics/' . $tema->id) }}">
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
