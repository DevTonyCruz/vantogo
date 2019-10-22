@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('travels.index') }}">Viajes</a>
                        </li>
                        <li class="breadcrumb-item active">Principal</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ route('travels.index') }}">Viajes</a>
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

                    @permission('travels.create')
                    <p class="text-muted font-14 mb-4">
                        <br>
                        <a href="{{ route('travels.create') }}">
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
                                    <th scope="col">Ruta</th>
                                    <th scope="col">Vehículo</th>
                                    <th scope="col">Chofer</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Activo</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($travels as $travel)
                                <tr>
                                    <th scope="row">{{ $travel->id }}</th>
                                    <td>{{ $travel->code }}</td>
                                    <td>{{ ($travel->route) ? $travel->route->code : '--' }}</td>
                                    <td>{{ $travel->car->brand . ' - ' . $travel->car->registration }}</td>
                                    <td>{{ ($travel->driver) ? $travel->driver->fullname() : '--'}}
                                    </td>
                                    <td>{{ $travel->date }}</td>
                                    <td>{{ $travel->hour_ini }}</td>
                                    <td>
                                        @php
                                        $checked = ""
                                        @endphp
                                        @if($travel->status == 1)
                                        @php
                                        $checked = "checked"
                                        @endphp
                                        @endif

                                        <input type="checkbox" id="switch_{{ $travel->id }}" {{ $checked }}
                                            data-switch="success"
                                            onchange="document.getElementById('form_update_{{ $travel->id }}').submit();">
                                        <label for="switch_{{ $travel->id }}" data-on-label="Si" data-off-label="No"
                                            class="mb-0 d-block"></label>

                                        <form method="POST" id="form_update_{{ $travel->id }}" class="inline"
                                            action="{{ url('admin/travels/status/' . $travel->id) }}">
                                            @method('PUT')
                                            @csrf
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/travels/' . $travel->id) }}" class="action-icon"
                                            title="Ver">
                                            <i class="mdi mdi-eye-outline"></i></a>
                                        <a href="{{ url('admin/travels/' . $travel->id . '/edit') }}"
                                            class="action-icon" title="Editar">
                                            <i class="mdi mdi-pencil"></i></a>
                                        <a href="javascript:void(0)"
                                            onclick="custom.modal_action_delete('{{ url('admin/travels/' . $travel->id) }}')"
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
