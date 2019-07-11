<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/icons.css') }}" rel="stylesheet">
</head>
<body class="auth-fluid-pages pb-0">
    <div id="app">
        <div class="auth-fluid">

            <!--Auth fluid left content -->
            @yield('content')
            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h2 class="mb-3">¡Hablemos de TI!</h2>
                    <p class="lead"><i class="mdi mdi-format-quote-open"></i> Si lo puedes imaginar, lo podemos programar. <i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <p>
                        - Estrasol Admin
                    </p>
                </div> <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('admin/js/app.js') }}" defer></script>
    <script src="{{ asset('admin/js/main.js') }}" defer></script>
</body>
</html>
