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
    <link href="{{ asset('front/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/custom.css') }}" rel="stylesheet">

    @yield('css')
</head>

<body>
    @include('front.layouts.menu')

    <!-- Start Content-->
    @yield('content')
    <!-- container -->

    @include('front.layouts.footer')
    <!-- Scripts -->
    <script src="{{ asset('front/js/app.js') }}"></script>

    @yield('js')
</body>

</html>