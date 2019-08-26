@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('profile.index') }}">Perfil</a>
                        </li>
                        <li class="breadcrumb-item active">Principal</li>
                    </ol>
                </div>
                <h4 class="page-title">
                    <a href="{{ route('profile.index') }}">Perfil</a>
                </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <!-- Profile -->
            <div class="card bg-primary">
                <div class="card-body profile-user-box">

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="media">
                                <span class="float-left m-2 mr-4"><img src="{{ asset('admin/images/users/avatar-2.jpg') }}" style="height: 100px;" alt="" class="rounded-circle img-thumbnail"></span>
                                <div class="media-body">

                                    <h4 class="mt-1 mb-1 text-white">{{ Auth::user()->name . ' ' . Auth::user()->first_last_name . ' ' . Auth::user()->second_last_name }}</h4>
                                    <p class="font-13 text-white-50"> Rol: {{ Auth::user()->rol->name }}</p>

                                    <ul class="mb-0 list-inline text-light">
                                        <li class="list-inline-item mr-3">
                                            <h5 class="mb-1">$ 25,184</h5>
                                            <p class="mb-0 font-13 text-white-50">Total Revenue</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5 class="mb-1">5482</h5>
                                            <p class="mb-0 font-13 text-white-50">Number of Orders</p>
                                        </li>
                                    </ul>
                                </div> <!-- end media-body-->
                            </div>
                        </div> <!-- end col-->

                        <div class="col-sm-4">
                            <div class="text-center mt-sm-0 mt-3 text-sm-right">
                                <button type="button" class="btn btn-light">
                                    <i class="mdi mdi-account-edit mr-1"></i> Editar Perfil
                                </button>
                            </div>
                        </div> <!-- end col-->
                    </div> <!-- end row -->

                </div> <!-- end card-body/ profile-user-box-->
            </div><!--end profile/ card -->
        </div> <!-- end col-->
    </div>
</div>
@endsection
