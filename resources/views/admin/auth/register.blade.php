@extends('admin.layouts.auth')

@section('content')
<div class="auth-fluid-form-box">
    <div class="align-items-center d-flex h-100">
        <div class="card-body">

            <!-- Logo -->
            <div class="auth-brand text-center text-lg-left">
                <a href="{{ route('admin.login') }}">
                    <span><img src="{{ asset('admin/images/logo-light.png') }}" alt="" height="18"></span>
                </a>
            </div>

            <!-- title-->
            <h4 class="mt-0">Registrese ahora</h4>
            <p class="text-muted mb-4">¿No tienes una cuenta? Crea tu cuenta, te llevará menos de un minuto</p>

            <!-- form -->
            <form method="POST" action="{{ url('/register') }}">
                @csrf
                <div class="form-group">
                    <label for="fullname">Nombre</label>
                    <input type="text" id="name" name="name" 
                            class="form-control @error('name') is-invalid @enderror" 
                            value="{{ old('name') }}" 
                            placeholder="Ingrese su nombre" 
                            required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="text" id="email" name="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            value="{{ old('email') }}" 
                            placeholder="Ingrese su correo electrónico" 
                            required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    
                    <input id="password" name="password" type="password" 
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Ingrese su contraseña" 
                            required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Confirmar contraseña</label>
                    <input id="password-confirm" name="password_confirmation" type="password" 
                            class="form-control" 
                            placeholder="Confirme la contraseña ingresda" 
                            required autocomplete="new-password">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                        <label class="custom-control-label" for="checkbox-signup">Acepto los <a href="javascript: void(0);" class="text-muted">Terminos y Condiciones</a></label>
                    </div>
                </div>
                <div class="form-group mb-0 text-center">
                    <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-account-circle"></i> Regístrese </button>
                </div>
            </form>
            <!-- end form-->

            <!-- Footer-->
            <footer class="footer footer-alt">
                <p class="text-muted">¿Ya tienes cuenta? <a href="{{ route('admin.login') }}" class="text-muted ml-1"><b>Inicia sesión</b></a></p>
            </footer>

        </div> <!-- end .card-body -->
    </div> <!-- end .align-items-center.d-flex.h-100-->
</div>
@endsection
