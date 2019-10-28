<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ config('app.name', 'Laravel') }}" name="description" />
    <meta content="AdrenalinaLabs" name="author" />

    <!-- URL app -->
    <meta name="url-app" content="{{ config('app.url', 'http://localhost') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/custom.css') }}" rel="stylesheet">

    @yield('css')
</head>

<body>
    @include('front.layouts.menu')

    @if (session('warning'))
        @include('front.elements.modal-warning')
    @endif

    @if (session('danger-2'))
        @include('front.elements.modal-danger-2')
    @endif

    @if (count($errors) > 0)
        @include('front.elements.modal-danger')
    @endif

    
    @include('front.elements.modal-json')
    
    <!-- Start Content-->
    @yield('content')
    <!-- container -->

    @include('front.layouts.footer')
    <!-- Scripts -->
    <script src="{{ asset('front/js/app.js') }}"></script>

    @yield('js')
</body>

</html>