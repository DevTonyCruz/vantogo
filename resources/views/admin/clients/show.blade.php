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
                    <li class="breadcrumb-item active">Mostrar</li>
                </ol>
            </div>
            <h4 class="page-title">
                <a href="{{ url('admin/clients') }}">Clientes</a>
            </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Datos de cliente</h4>
                <div class="form-group row mb-3">
                    <label for="name" class="col-3 col-form-label">Nombre</label>
                    <label for="name" class="col-9 col-form-label text-dark">{{ $client->name . ' ' . $client->first_last_name . ' ' . $client->second_last_name }}</label>
                    <label for="email" class="col-3 col-form-label">Correo</label>
                    <label for="name" class="col-9 col-form-label text-dark">{{ $client->email }}</label>
                    <label for="phone" class="col-3 col-form-label">Teléfono</label>
                    <label for="name" class="col-9 col-form-label text-dark">{{ $client->phone }}</label>
                    <label for="rol" class="col-3 col-form-label">Rol</label>
                    <label for="name" class="col-9 col-form-label text-dark">{{ $client->rol->name }}</label>
                </div>

            </div>  <!-- end card-body -->
        </div>  <!-- end card -->
    </div>
</div>

    <div class="card-columns">
    @if(isset($client->billing))
        <div class="">
            <div class="card widget-flat">
                <div class="card-body">
                    <h4 class="mb-3 header-title">Domicilio de facturación</h4>
                    <div class="form-group row mb-3">
                        <label for="name" class="col-5 col-form-label">Razón social</label>
                        <label for="name" class="col-7 col-form-label text-dark">{{ $client->billing->bussines_name }}</label>
                        <label for="email" class="col-5 col-form-label">Correo</label>
                        <label for="name" class="col-7 col-form-label text-dark">{{ $client->billing->email }}</label>
                        <label for="email" class="col-5 col-form-label">R.F.C.</label>
                        <label for="name" class="col-7 col-form-label text-dark">{{ $client->billing->rfc }}</label>
                        <label for="email" class="col-5 col-form-label">CFDI</label>
                        <label for="name" class="col-7 col-form-label text-dark">{{ $client->billing->cfdi }}</label>
                        <label for="email" class="col-5 col-form-label">C.P.</label>
                        <label for="name" class="col-7 col-form-label text-dark">{{ $client->billing->sepomex->zip_code }}</label>
                        <label for="email" class="col-5 col-form-label">Dirección</label>
                        @php
                            $direccion = $client->billing->direction . ' ' . $client->billing->exterior . ', Col. ' . $client->billing->sepomex->name . ', ' .
                                            $client->billing->sepomex->location . ', ' . $client->billing->sepomex->state;

                            if($client->billing->interior != '')
                                $direccion = $client->billing->direction . ' ' . $client->billing->exterior . ' Int. ' . $client->billing->interior . ', Col. ' .
                                                $client->billing->sepomex->name . ', ' . $client->billing->sepomex->location . ', ' . $client->billing->sepomex->state;

                        @endphp
                        <label for="name" class="col-7 col-form-label text-dark">{{ $direccion }}</label>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(isset($client->shipping))
        @foreach($client->shipping as $shipping)
            <div class="">
                <div class="card widget-flat">
                    <div class="card-body">
                        <h4 class="mb-3 header-title">Domicilios de envío</h4>
                        <div class="form-group row mb-3">
                            <label for="name" class="col-5 col-form-label">Razón social</label>
                            <label for="name" class="col-7 col-form-label text-dark">{{ $shipping->title }}</label>
                            <label for="email" class="col-5 col-form-label">Nombre</label>
                            <label for="name" class="col-7 col-form-label text-dark">{{ $shipping->fullname }}</label>
                            <label for="email" class="col-5 col-form-label">Correo</label>
                            <label for="name" class="col-7 col-form-label text-dark">{{ $shipping->email }}</label>
                            <label for="email" class="col-5 col-form-label">C.P.</label>
                            <label for="name" class="col-7 col-form-label text-dark">{{ $shipping->sepomex->zip_code }}</label>
                            <label for="email" class="col-5 col-form-label">Dirección</label>
                            @php
                                $direccion = $shipping->direction . ' ' . $shipping->exterior . ', Col. ' . $shipping->sepomex->name . ', ' .
                                            $shipping->sepomex->location . ', ' . $shipping->sepomex->state;

                                if($shipping->interior != '')
                                    $direccion = $shipping->direction . ' ' . $shipping->exterior . ' Int. ' . $shipping->interior . ', Col. ' .
                                                $shipping->sepomex->name . ', ' . $shipping->sepomex->location . ', ' . $shipping->sepomex->state;

                            @endphp
                            <label for="name" class="col-7 col-form-label text-dark">{{ $direccion }}</label>
                            <label for="email" class="col-5 col-form-label">Referencias</label>
                            <label for="name" class="col-7 col-form-label text-dark">{{ $shipping->references }}</label>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
