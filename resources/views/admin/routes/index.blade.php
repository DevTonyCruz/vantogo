@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('routes.index') }}">Vehiculos</a>
                        </li>
                        <li class="breadcrumb-item active">Principal</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ route('routes.index') }}">Vehiculos</a>
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

                    @permission('routes.create')
                    <p class="text-muted font-14 mb-4">
                        <br>
                        <a href="{{ url('admin/routes/create') }}">
                            <button type="button" class="btn btn-light">
                                <i class="mdi mdi-plus mr-1"></i>
                                <span>Agregar</span>
                            </button>
                        </a>
                    </p>
                    @endpermission

                    <div class="table-responsive">
                        <table class="table mb-0" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Código</th>
                                    <th scope="col">Origen</th>
                                    <th scope="col">Destino</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Activo</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($routes as $route)
                                <tr>
                                    <th scope="row">{{ $route->id }}</th>
                                    <td>{{ $route->code }}</td>
                                    <td>{{ $route->origin }}</td>
                                    <td>{{ $route->destination }}</td>
                                    <td>{{ $route->price }}</td>
                                    <td>
                                        @php
                                        $checked = ""
                                        @endphp
                                        @if($route->status == 1)
                                        @php
                                        $checked = "checked"
                                        @endphp
                                        @endif

                                        <input type="checkbox" id="switch_{{ $route->id }}" {{ $checked }}
                                            data-switch="success"
                                            onchange="document.getElementById('form_update_{{ $route->id }}').submit();">
                                        <label for="switch_{{ $route->id }}" data-on-label="Si" data-off-label="No"
                                            class="mb-0 d-block"></label>

                                        <form method="POST" id="form_update_{{ $route->id }}" class="inline"
                                            action="{{ url('admin/routes/status/' . $route->id) }}">
                                            @method('PUT')
                                            @csrf
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/routes/' . $route->id) }}" class="action-icon" title="Ver">
                                            <i class="mdi mdi-eye-outline"></i></a>
                                        <a href="{{ url('admin/routes/' . $route->id . '/edit') }}" class="action-icon"
                                            title="Ver">
                                            <i class="mdi mdi-pencil"></i></a>
                                        <a href="javascript:void(0)"
                                            onclick="document.getElementById('form_delete_{{ $route->id }}').submit();"
                                            class="action-icon" title="Editar"> <i
                                                class="mdi mdi-trash-can-outline"></i></a>

                                        <form method="POST" id="form_delete_{{ $route->id }}" class="inline"
                                            action="{{ url('admin/routes/' . $route->id) }}">
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
