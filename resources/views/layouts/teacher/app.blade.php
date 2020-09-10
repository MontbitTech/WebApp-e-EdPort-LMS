<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.school_name') }}</title>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/a3a1b3a803.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="loader" style="display:none;"></div>
    @include('layouts.teacher.header')
    @include('layouts.teacher.sidebar')
    @include('layouts.notifications')
    @yield('content')
    @include('layouts.teacher.footer')

</body>

</html>