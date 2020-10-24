<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
Refer https://www.youtube.com/watch?v=CVClHLwv-4I for face-api tutorial.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Pareeksha platform for conducting online examination.">
  <meta name="theme-color" content="#343a40">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>परीक्षा | {Examination Code}</title>

  <!-- Setting Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{asset('examination/dist/img/favicon/apple-touch-icon.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('examination/dist/img/favicon/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('examination/dist/img/favicon/favicon-16x16.png')}}">
  <link rel="manifest" href="{{asset('examination/dist/img/favicon/site.webmanifest')}}">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('examination/plugins/fontawesome-free/css/all.min.css')}}" media="none" onload="if(media!='all')media='all'">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('examination/dist/css/adminlte.min.css')}}" media="none" onload="if(media!='all')media='all'">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" media="none" onload="if(media!='all')media='all'">

  <!-- Custom Styling -->
  <style>
    #video {
      min-width: 100%;
      max-width: 100%;
      border-radius: 5px;
      border-style: solid;
    }

    body {
      width: 100%;
      height: 100%;
      overflow: scroll;
    }

    #pauseExam {
      width: 100vw;
      height: 100vh;
      top: 0;
      left: 0;
    }
  </style>
</head>

<body onselectstart="return false" class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

<input type="hidden" id="validateStudentUrl" value="{{url('/student/validateStudent')}}">
<input type="hidden" id="saveExamLogsUrl" value="{{url('/student/saveExamLogs')}}">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <div style="font-size: 1.5rem;" id="timer"></div>
        </li>
        <li class="nav-item">
          <a id="toggle_sidebar" class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button" title="View Proctor Logs">
            <i class="fas fa-user-shield fa-lg"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{asset('examination/dist/img/dps.png')}}" alt="" class="brand-image" style="opacity: .9">
        <span class="brand-text font-weight-light"> परीक्षा <span style="font-size: x-small;"> by e-EdPort</span></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="font-size:medium;">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-puzzle-piece"></i>
                <p>
                  <span class='examID'>{Exam Code}</span>
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul id="questionList" class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#guidelines" class="nav-link">
                    <i id="guidelines_button" class="far fa-circle fa-sm nav-icon"></i>
                    <p> Guidelines</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div id="guidelines" class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Welcome</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right text-dark">
                <li class="m-0 breadcrumb-item">Pareeksha</li>
                <li class="m-0 breadcrumb-item"><span class='examID'>{Exam Code}</span></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div id="questions" class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="m-0">Guidelines for the Examination</h5>
                </div>
                <div class="card-body">
                  <h3 class="card-title">In case you fail to adhere to the following guidelines, your attempt for this
                    examination would be discarded. Kindly read and follow the points sincerely:</h3><br /><br />

                  <h3 class="card-title">Device Usage Guideline:</h3>
                  <p class="card-text">
                    1. You will not be allowed to exit the full screen once the exam begins.<br />
                    2.You will not be allowed to switch applications once the exam begins.
                  </p>
                  <h3 class="card-title">Proctored Video Guideline:</h3>
                  <p class="card-text">
                    1. You will be responsible for ensuring proper lighting so that your face is visible.<br />
                    2. You will be responsible for ensuring that you remain alone while giving the exam.
                  </p>
                  <h3 class="card-title">Proctored Audio Guideline:</h3>
                  <p class="card-text">
                    1. You will be responsible for ensuring complete silence while giving exam.<br />
                  </p>
                  <h3 class="card-title">Keyboard/Mouse Guideline:</h3>
                  <p class="card-text">
                    1. You will not be allowed to use keyboard once the exam begins.<br />
                    2. You will not be allowed to use right-click once the exam begins.
                  </p>
                  <h3 class="card-title">Timer Guideline:</h3>
                  <p class="card-text">
                    1. You will not be allowed to extend the examination timing.<br />
                  </p>
                  <h3 class="card-title">Warning Guideline:</h3>
                  <p class="card-text">
                    1. You may receive warning for closing full screen; doing so may terminate your examination.<br />
                    2. You may receive warning for closing switching tab/application; doing so may terminate your
                    examination.<br />
                    3. You may receive warning for not being visible; doing so may terminate your examination.<br />
                    4. You may receive warning for not being alone; doing so may terminate your examination.<br />
                    5. You may receive warning for not maintaining silence; doing so may terminate your
                    examination.<br />
                    6. You may receive warning for using keyboard; doing so may terminate your examination.<br />
                    7. You may receive warning for using right-click; doing so may terminate your examination.<br />
                  </p>
                  <p id="start_exam_button" style="min-width:100%;text-align:center;display:none;"><a href="#" onclick="startExam()" class="btn btn-danger"><b>Start Examination</b></a>
                  </p>
                </div>
              </div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-light text-dark">
      <!-- Control sidebar content goes here -->
      <div id="proctor" class="p-3">
        <!-- Video Feed Box -->
        <video id="video" autoplay muted></video>
        <hr />
        <h5 style="text-align:center;"><small>EMOJI FEEDBACK<br /><span id="emotion"></span><span id="noise"></span></small></h5>
        <hr />
        <h5 style="text-align:center;"><small><b><u>PROCTOR FEEDBACK</u></b></small></h5>
        <div id="warning" style="min-height:40vh;max-height:40vh;font-size:small;overflow:scroll;"></div>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer" style="text-align: center; padding:5px;">
      <span id="submitButton" style="display:none;">
        <button type="button" onclick="finishExamConfirmation()" class=" btn btn-success"><i class="fas fa-paper-plane"></i>
          &nbsp;Finish </button>
      </span>
    </footer>
  </div>

  <!-- ./wrapper -->

  <!-- Exam Pause -->
  <div class="modal fade" id="pauseExam">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-danger">
        <div class="modal-header justify-content-center">
          <h4 class="modal-title">Termination Warning!</h4>
        </div>
        <div id="pauseExamBody" class="modal-body">
          <p>You are not allowed to exit full-screen or switch tab/browser while giving the examination. If you do so
            repeatedly, the proctor would terminate this examination.</p>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" onclick="resumeExam()" class=" btn btn-outline-light" data-dismiss="modal">OK</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- Exam Finish Confirmation -->
  <div class="modal fade" id="finishExam">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-danger">
        <div class="modal-header justify-content-center">
          <h4 id="finishExamTitle" class="modal-title">Finish Early?</h4>
        </div>
        <div class="modal-body">
          <div id="finishExamBody">
            <p id="finishExamBodyText">You are trying to finish the examination before the permitted time.<br />
              Are you sure you want to finish this
              examination?</p>
          </div>
          <div class="card bg-danger text-center">
            <div class="card-header">
              <h3 class="card-title">EXAMINATION SUBMISSION SUMMARY</h3>
            </div>
            <div class="card-body p-0">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Total</th>
                    <th>Attempted</th>
                    <th>Remaining</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td id="totalQuestionCount"></td>
                    <td id="attemptedQuestionCount"></td>
                    <td id="remainingQuestionCount"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div id="finishExamBodyFooter" class="modal-footer justify-content-center">
          <button type="button" onclick="finishExam()" class=" btn btn-outline-light">YES</button>
          <button type="button" class=" btn btn-outline-light" data-dismiss="modal">NO</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script defer src="{{asset('examination/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script defer src="{{asset('examination/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- SweetAlert 2 -->
  <script defer src="{{asset('examination/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script defer src="{{asset('examination/dist/js/adminlte.min.js')}}"></script>
  <!-- Face API -->
  <script defer src="{{asset('examination/plugins/face-api/face-api.min.js')}}"></script>
  <!-- Proctor Integration -->
  <script defer src="{{asset('examination/dist/js/proctor.js')}}"></script>
  <!-- Exam Integration -->
  <script defer src="{{asset('examination/dist/js/exam.js')}}"></script>
  <!-- Lazy Image Load -->
  <script defer src="{{asset('examination/plugins/lazysizes/lazysizes.min.js')}}"></script>

</body>

</html>