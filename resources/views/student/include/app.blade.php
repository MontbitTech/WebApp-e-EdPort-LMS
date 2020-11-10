<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>e-EdPort :: Student</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->

    <link rel="stylesheet" href="{{asset('student/assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('student/assets/plugins/ionicons-2.0.1/css/ionicons.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('student/assets/plugins/toastr/toastr.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('student/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('student/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('student/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('student/assets/plugins/select2/css/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('student/assets/css/adminlte.css')}}">
    <link rel="stylesheet" href="{{asset('student/assets/css/student.css')}}">
    <!-- jQuery -->
    <script src="{{asset('student/assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('student/assets/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- jquery-validation -->
    <script src="{{asset('student/assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('student/assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>
    <script>

    </script>

    <!-- Google Font: Source Sans Pro -->
    <link href="{{asset('student/assets/css/fonts/source_sans_pro.css')}}" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user-circle" style="font-size:x-large;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>

                    </div>
                </li>
            </ul>
            <!-- Right Navbar Links -->
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('student.dashboard')}}" class="brand-link">
                <img src="{{asset('student/assets/img/logo.png')}}" alt="[school_name_logo]" class="brand-image" style="opacity: .9">
                <span class="brand-text font-weight-light"> &nbsp; e-EdPort</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('student/assets/img/student.png')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">[Student Name]</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="{{route('student.dashboard')}}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('student.lecture')}}" class="nav-link">
                                <i class="nav-icon fas fa-book-reader"></i>
                                <p>
                                    Lecture
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('student.examination')}}" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Examination
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('student.profile')}}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Profile
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <section class="content ">
            <!-- Main content -->
            @yield('content')
        </section>
    </div>
    <footer class="main-footer">
        <strong>&copy; {{now()->year}} MontBit Technologies Limited</strong> | All Rights Reserved
    </footer>

    <!-- ./wrapper -->


    <!-- SweetAlert2 -->
    <script src="{{asset('student/assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('student/assets/plugins/toastr/toastr.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('student/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('student/assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('student/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('student/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('student/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('student/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('student/assets/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script>
        $(function() {
            $('.select2').select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })
            $('.select1').select2()
        });
    </script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('student/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>


    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "ordering": true,
            });
        });
    </script>
    @if ( Session::has('flash_message') )
    <script type="text/javascript">
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            timer: 3000,
            padding: '1em',
            showConfirmButton: false,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });


        Toast.fire({
            icon: "{{ Session::get('flash_type') }}",
            title: "<h6><b>{{ Session::get('flash_message') }}</b></h6>"
        })
    </script>
    @endif

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <script type="text/javascript">
        toastr.error('{{$error}}')
    </script>
    @endforeach
    @endif
</body>

</html>