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
                        <li class="breadcrumb-item active">Visualizar</li>
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
                    <div class="row">
                        <div class="col-lg-5">
                            <!-- Product image -->
                            <a href="javascript: void(0);" class="text-center d-block mb-4">
                                <img src="{{ asset($producto->photo_url) }}" class="img-fluid" style="max-width: 280px;"
                                    alt="Product-img">
                            </a>

                            <div class="d-lg-flex d-none justify-content-center">
                                <a href="javascript: void(0);">
                                    <img src="{{ asset($producto->photo_url) }}" class="img-fluid img-thumbnail p-2"
                                        style="max-width: 75px;" alt="Product-img">
                                </a>
                                @foreach ($producto->imagenes as $imagenes)
                                @if($imagenes->status == 1)
                                <a href="javascript: void(0);" class="ml-2">
                                    <img src="{{ asset($imagenes->photo_url) }}" class="img-fluid img-thumbnail p-2"
                                        style="max-width: 75px;" alt="Product-img">
                                </a>
                                @endif
                                @endforeach
                            </div>
                        </div> <!-- end col -->
                        <div class="col-lg-7">
                            <form class="pl-lg-4">
                                <!-- Product title -->
                                <h3 class="mt-0">{{ $producto->name }} </h3>
                                <p class="mb-1">Fecha de creación: {{ $producto->created_at }}</p>

                                <!-- Product stock -->
                                <div class="mt-3">
                                    @if ($producto->stock->quantity < 0) <h4><span
                                            class="badge badge-danger-lighten">Sin existencia</span></h4>
                                        @elseif ($producto->stock->quantity > 0 &&
                                        $producto->stock->quantity < $producto->stock->min_quantity)
                                            <h4><span class="badge badge-danger-lighten">Existencia baja</span></h4>
                                            @elseif ($producto->stock->quantity > 0 &&
                                            $producto->stock->quantity > $producto->stock->min_quantity &&
                                            $producto->stock->quantity < $producto->stock->max_quantity)
                                                <h4><span class="badge badge-success-lighten">En stock</span></h4>
                                                @else
                                                I dont have any records!
                                                @endif
                                </div>

                                <div class="mt-3">
                                    <div class="d-flex">
                                        <a href="{{ url('admin/products/images/' . $producto->id) }}"
                                            class="btn btn-success" title="Actualizar">
                                            <i class="mdi mdi-image"></i> Agregar Imagen
                                        </a>
                                    </div>
                                </div>

                                <!-- Product description -->
                                <div class="mt-4">
                                    <h6 class="font-14">Precio:</h6>
                                    <h3> ${{ $producto->price }}</h3>
                                </div>

                                <!-- Category -->
                                <div class="mt-4">
                                    <h6 class="font-14">Categoría:</h6>
                                    <p>{{ $producto->categoria->name }} </p>
                                </div>

                                <!-- Product description -->
                                <div class="mt-4">
                                    <h6 class="font-14">Descripción:</h6>
                                    <p>{{ $producto->description }} </p>
                                </div>

                                <!-- Product information -->
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6 class="font-14">Cantidad existente:</h6>
                                            <p class="text-sm lh-150">{{ $producto->stock->quantity }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="font-14">Existencia mínima:</h6>
                                            <p class="text-sm lh-150">{{ $producto->stock->min_quantity }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="font-14">Existencia máxima:</h6>
                                            <p class="text-sm lh-150">{{ $producto->stock->max_quantity }}</p>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div> <!-- end col -->
                    </div> <!-- end row-->

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-centered mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Imagen</th>
                                    <th>Orden</th>
                                    <th>Estatus</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($producto->imagenes as $imagenes)
                                <tr>
                                    <td>
                                        <img src="{{ asset($imagenes->photo_url) }}" alt="category-img"
                                            title="category-img" class="rounded mr-3" height="48">
                                    </td>
                                    <td>
                                        <select class="form-control select2" id="position_{{ $imagenes->id }}"
                                            name="position_{{ $imagenes->id }}" data-toggle="select2">
                                            <option value="S">Seleccionar</option>
                                            <option value="1" {{ $imagenes->id == 1 ? "selected":"" }}>Primera Posición
                                            </option>
                                            <option value="2" {{ $imagenes->id == 2 ? "selected":"" }}>Segunda Posición
                                            </option>
                                            <option value="3" {{ $imagenes->id == 3 ? "selected":"" }}>Tercera Posición
                                            </option>
                                            <option value="4" {{ $imagenes->id == 4 ? "selected":"" }}>Cuarta Posición
                                            </option>
                                            <option value="5" {{ $imagenes->id == 5 ? "selected":"" }}>Quinta Posición
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        @php
                                        $checked = ""
                                        @endphp
                                        @if($imagenes->status == 1)
                                        @php
                                        $checked = "checked"
                                        @endphp
                                        @endif

                                        <input type="checkbox" id="switch_{{ $imagenes->id }}" {{ $checked }}
                                            data-switch="success"
                                            onchange="document.getElementById('form_update_{{ $imagenes->id }}').submit();">
                                        <label for="switch_{{ $imagenes->id }}" data-on-label="Si" data-off-label="No"
                                            class="mb-0 d-block"></label>

                                        <form method="POST" id="form_update_{{ $imagenes->id }}" class="inline"
                                            action="{{ url('admin/products/images/status/' . $imagenes->id) }}">
                                            @method('PUT')
                                            @csrf
                                        </form>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            onclick="document.getElementById('form_delete_{{ $imagenes->id }}').submit();"
                                            class="action-icon" title="Eliminar"> <i
                                                class=" mdi mdi-trash-can-outline"></i></a>

                                        <form method="POST" id="form_delete_{{ $imagenes->id }}" class="inline"
                                            action="{{ url('admin/products/images/' . $imagenes->id) }}">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->

            </div> <!-- end card-->
        </div> <!-- end col-->

    </div>
</div>


@endsection
