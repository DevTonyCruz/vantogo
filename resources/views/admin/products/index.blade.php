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
                            <a href="{{ url('admin/products') }}">Productos</a>
                        </li>
                        <li class="breadcrumb-item active">Principal</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ url('admin/products') }}">Productos</a>
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
                        <a href="{{ url('admin/products/create') }}">
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
                                    <th scope="col">SKU</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Categoría</th>
                                    <th scope="col">Activo</th>
                                    <th scope="col">Fecha de registro</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)

                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->categoria->name }}</td>
                                    <td>
                                        @php
                                        $checked = ""
                                        @endphp
                                        @if($product->status == 1)
                                        @php
                                        $checked = "checked"
                                        @endphp
                                        @endif

                                        <input type="checkbox" id="switch_{{ $product->id }}" {{ $checked }}
                                            data-switch="success"
                                            onchange="document.getElementById('form_update_{{ $product->id }}').submit();">
                                        <label for="switch_{{ $product->id }}" data-on-label="Si" data-off-label="No"
                                            class="mb-0 d-block"></label>

                                        <form method="POST" id="form_update_{{ $product->id }}" class="inline"
                                            action="{{ url('admin/products/status/' . $product->id) }}">
                                            @method('PUT')
                                            @csrf
                                        </form>
                                    </td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>
                                        <a href="{{ url('admin/products/' . $product->id) }}" class="action-icon"
                                            title="Ver"> <i class=" mdi mdi-eye-outline"></i></a>
                                        <a href="{{ url('admin/products/' . $product->id . '/edit') }}" class="action-icon"
                                            title="Editar"> <i class=" mdi mdi-pencil"></i></a>
                                        <a href="javascript:void(0)"
                                            onclick="document.getElementById('form_delete_{{ $product->id }}').submit();"
                                            class="action-icon" title="Eliminar"> <i
                                                class=" mdi mdi-trash-can-outline"></i></a>

                                        <form method="POST" id="form_delete_{{ $product->id }}" class="inline"
                                            action="{{ url('admin/products/' . $product->id) }}">
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
