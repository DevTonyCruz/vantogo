<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Proyecto Arca" name="description" />
    <meta content="Estrasol" name="author" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/icons.css') }}" rel="stylesheet">

    @yield('css')
</head>

<body>
    <div class="wrapper" id="app">

        <!-- Left Sidebar Start -->
        @include('admin.elements.menu-left')
        <!-- Left Sidebar End -->

        <!-- Start Page Content here -->
        <div class="content-page">
            <div class="content">

                <!-- Topbar Start -->
                @include('admin.elements.menu-top')
                <!-- end Topbar -->

                <!-- Start Content-->
                @yield('content')
                <!-- container -->

            </div>
        </div>
        <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            @include('admin.elements.footer')
        </footer>
        <!-- end Footer -->

        @if (session('status'))
        @include('admin.elements.permisos-modal')
        @endif
    </div>

    <!-- Scripts -->
    <script src="{{ asset('admin/js/app.js') }}" defer></script>
    <script src="{{ asset('admin/js/main.js') }}" defer></script>


    @if (session('status'))
    <script type="text/javascript" defer>
        window.addEventListener("load",function(event) {
            custom.modal_permissions();
		});
    </script>
    @endif

    @yield('js')
</body>

</html>
