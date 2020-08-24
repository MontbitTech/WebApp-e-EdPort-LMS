<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.school_name') }}</title>
  <script src="https://kit.fontawesome.com/a3a1b3a803.js" crossorigin="anonymous"></script>
  <!-- Scripts -->
  {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
  <script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
  <!-- Styles -->
  {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">

</head>

<body>
  <div id="app">
    @include('layouts.admin.leftmenu')
    @include('layouts.notifications')
    <main class="py-4">
      @yield('content')
    </main>
    @include('layouts.admin.footer')
  </div>
</body>

</html>