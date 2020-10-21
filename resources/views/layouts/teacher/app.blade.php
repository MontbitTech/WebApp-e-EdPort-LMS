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
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/datatables.min.css" />

     <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/datatables.min.js"></script>
 </head>

 <body class="{{ (request()->routeIs('teacher.dashboard')) ? '' : 'menu-open' }}">
     <div class="loader" style="display:none;"></div>
     @include('layouts.teacher.header')
     @include('layouts.teacher.sidebar')
     @include('layouts.notifications')
     @yield('content')
     @include('layouts.teacher.footer')

 </body>
 <script>
     var a = $(window).width();
     if (a <= 500) {
         $('body').addClass('menu-open')
     }

     //  var height = $('.slide').css("height", y);
     //console.log(height);
     // console.log(y, x);
 </script>

 </html>