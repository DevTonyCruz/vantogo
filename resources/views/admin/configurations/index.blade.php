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
                            <a href="{{ url('admin/configuration') }}">Configuraciones</a>
                        </li>
                        <li class="breadcrumb-item active">Preguntas</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/configuration') }}">Configuraciones</a>
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

                    <div class="table-responsive">
                        <table class="table mb-0" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Llave</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Activo</th>
                                    <th scope="col">Fecha de registro</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($configurations as $config)

                                <tr>
                                    <th scope="row">{{ $config->id }}</th>
                                    <td>{{ $config->key }}</td>
                                    <td>{{ $config->value }}</td>
                                    <td>
                                        @php
                                        $checked = ""
                                        @endphp
                                        @if($config->status == 1)
                                        @php
                                        $checked = "checked"
                                        @endphp
                                        @endif

                                        <input type="checkbox" id="switch_{{ $config->id }}" {{ $checked }}
                                            data-switch="success"
                                            onchange="document.getElementById('form_update_{{ $config->id }}').submit();">
                                        <label for="switch_{{ $config->id }}" data-on-label="Si" data-off-label="No"
                                            class="mb-0 d-block"></label>

                                        <form method="POST" id="form_update_{{ $config->id }}" class="inline"
                                            action="{{ url('admin/configuration/status/' . $config->id) }}">
                                            @method('PUT')
                                            @csrf
                                        </form>
                                    </td>
                                    <td>{{ $config->created_at }}</td>
                                    <td>
                                        <a href="{{ url('admin/configuration/' . $config->id) }}"
                                            class="action-icon" title="Ver"> <i class=" mdi mdi-eye-outline"></i></a>
                                        <a href="{{ url('admin/configuration/' . $config->id . '/edit') }}"
                                            class="action-icon" title="Editar"> <i class=" mdi mdi-pencil"></i></a>
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
