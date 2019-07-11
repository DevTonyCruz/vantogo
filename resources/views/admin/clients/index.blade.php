@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin/clients') }}">Clientes</a>
                    </li>
                    <li class="breadcrumb-item active">Principal</li>
                </ol>
            </div>
            <h4 class="page-title">
                <a href="{{ url('admin/clients') }}">Clientes</a>
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
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Activo</th>
                                <th scope="col">Fecha de registro</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                            <tr>
                                <th scope="row">{{ $client->id }}</th>
                                <td>{{ $client->name . ' ' . $client->first_last_name . ' ' . $client->second_last_name }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>
                                @php
                                $checked = ""
                                @endphp
                                @if($client->status == 1)
                                    @php
                                    $checked = "checked"
                                    @endphp
                                @endif

                                <input type="checkbox" id="switch_{{ $client->id }}" {{ $checked }} data-switch="success" onchange="document.getElementById('form_update_{{ $client->id }}').submit();">
                                <label for="switch_{{ $client->id }}" data-on-label="Si" data-off-label="No" class="mb-0 d-block"></label>

                                <form method="POST" id="form_update_{{ $client->id }}" class="inline" action="{{ url('admin/clients/status/' . $client->id) }}">
                                    @method('PUT')
                                    @csrf
                                </form>
                                </td>
                                <td>{{ $client->created_at }}</td>
                                <td>
                                        <a href="{{ url('admin/clients/' . $client->id) }}" class="action-icon" title="Ver"> <i class=" mdi mdi-eye-outline"></i></a>
                                        <a href="javascript:void(0)" onclick="" class="action-icon" title="Pedidos"> <i class="mdi mdi-package-variant-closed"></i></a>
                                        <a href="{{ url('admin/clients/' . $client->id . '/edit') }}" onclick="" class="action-icon" title="Cambiar Contraseña"> <i class="mdi mdi-key"></i></a>
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
