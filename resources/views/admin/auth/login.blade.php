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
            <h4 class="mt-0">Inicia sesión</h4>
            <p class="text-muted mb-4">Ingrese su correo electrónico y contraseña para acceder a la cuenta.</p>

            <!-- form -->
            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input id="email" name="email" type="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                        placeholder="Ingrese su correo electrónico" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">

                    @if (Route::has('admin.password.request'))
                    <a href="{{ route('admin.password.request') }}" class="text-muted float-right"><small>¿Olvidaste tú
                            contraseña?</small></a>
                    @endif

                    <label for="password">Contraseña</label>
                    <div class="input-group">
                        <input id="password" name="password" type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Ingrese su contraseña" required="" autocomplete="current-password">
                        <div class="input-group-append">
                            <span class="input-group-text view-password" style="cursor:pointer;" onclick="custom.mostrar_password()" >
                                <i class="mdi mdi-eye-off-outline" style="line-height: normal;"></i>
                            </span>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="custom-control custom-checkbox">
                        <input name="remember" id="remember" type="checkbox" class="custom-control-input"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Recuerdame</label>
                    </div>
                </div>
                <div class="form-group mb-0 text-center">
                    <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-login"></i> Entrar
                    </button>
                </div>
            </form>
            <!-- end form-->

            <!-- Footer-->
            @if (Route::has('admin.register'))
            <footer class="footer footer-alt">
                <p class="text-muted">¿No tienes una cuenta? <a href="{{ route('admin.register') }}"
                        class="text-muted ml-1"><b>Regístrate</b></a></p>
            </footer>
            @endif

        </div> <!-- end .card-body -->
    </div> <!-- end .align-items-center.d-flex.h-100-->
</div>
@endsection
