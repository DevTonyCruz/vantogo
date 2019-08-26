@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('drivers.index') }}">Choferes</a>
                        </li>
                        <li class="breadcrumb-item active">Principal</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ route('drivers.index') }}">Choferes</a>
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

                    @permission('drivers.create')
                    <p class="text-muted font-14 mb-4">
                        <br>
                        <a href="{{ url('admin/drivers/create') }}">
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
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Licencia</th>
                                    <th scope="col">Activo</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($drivers as $driver)
                                <tr>
                                    <th scope="row">{{ $driver->id }}</th>
                                    <td>{{ $driver->name . ' ' . $driver->first_last_name . ' ' . $driver->second_last_name }}
                                    </td>
                                    <td>{{ $driver->email }}</td>
                                    <td>{{ $driver->phone }}</td>
                                    <td>{{ $driver->license }}</td>
                                    <td>
                                        @php
                                        $checked = ""
                                        @endphp
                                        @if($driver->status == 1)
                                        @php
                                        $checked = "checked"
                                        @endphp
                                        @endif

                                        <input type="checkbox" id="switch_{{ $driver->id }}" {{ $checked }}
                                            data-switch="success"
                                            onchange="document.getElementById('form_update_{{ $driver->id }}').submit();">
                                        <label for="switch_{{ $driver->id }}" data-on-label="Si" data-off-label="No"
                                            class="mb-0 d-block"></label>

                                        <form method="POST" id="form_update_{{ $driver->id }}" class="inline"
                                            action="{{ url('admin/drivers/status/' . $driver->id) }}">
                                            @method('PUT')
                                            @csrf
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/drivers/' . $driver->id) }}" class="action-icon"
                                            title="Ver">
                                            <i class="mdi mdi-eye-outline"></i>
                                        </a>
                                        <a href="{{ url('admin/drivers/' . $driver->id . '/edit') }}"
                                            class="action-icon" title="Editar">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <a href="{{ asset($driver->photo) }}" class="action-icon"
                                            title="Descargar licencia" target="_blank">
                                            <i class="mdi mdi-download"></i>
                                        </a>
                                        <a href="javascript:void(0)"
                                            onclick="custom.modal_action_delete('{{ url('admin/drivers/' . $driver->id) }}')"
                                            class="action-icon" title="Eliminar">
                                            <i class=" mdi mdi-trash-can-outline"></i>
                                        </a>
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

@include('admin.elements.delete-modal')
@endsection
