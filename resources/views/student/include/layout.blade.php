<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('student/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('student/assets/plugins/ionicons-2.0.1/css/ionicons.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('student/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('student/assets/plugins/select2/css/select2.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('student/assets/css/adminlte.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{asset('student/assets/css/fonts/source_sans_pro.css')}}" rel="stylesheet">
</head>

<body class="hold-transition register-page">
  @yield('content')


  <!-- jQuery -->
  <script src="{{asset('student/assets/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('student/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Select2 -->
  <script src="{{asset('student/assets/plugins/select2/js/select2.full.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('student/assets/js/adminlte.min.js')}}"></script>
  <!-- bs-custom-file-input -->
  <script src="{{asset('student/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      bsCustomFileInput.init();
    });
  </script>

  <script>
    $(function() {
      $('.select2').select2({
        tags: true,
        tokenSeparators: [',', ' ']
      })
      $('.select1').select2()
    });
  </script>
</body>

</html>