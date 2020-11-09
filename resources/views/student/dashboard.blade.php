@extends('student.include.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Welcome [Student Name]</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('student.dashboard')}}">Student</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <!-- small box -->
          <div class="small-box bg-info ">
            <div class="inner">
              <h4>[Subject]</h4>
              <p>By [Teacher Name]</p>
              <p>9:00 AM To 10:00 AM</p>
            </div>
            <div class="icon">
              <i class="fas fa-book-reader"></i>
            </div>
            <a href="#" class="small-box-footer">Join Lecture <i class="fas fa-arrow-circle-right ml-2"></i></a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-info">
            <div class="card-header border-transparent">
              <h3 class="card-title">My Today's Lectures</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>

            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                    <tr>
                      <th>Subject</th>
                      <th>Teacher</th>
                      <th>Time</th>
                      <th>Join</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>[Subject Name]</td>
                      <td>[Teacher Name]</td>
                      <td><span class="badge badge-info"> 9:00 AM
                          </br> 10:00 AM</span></td>
                      <td>
                        <a href="#">
                          <span><i class="fas fa-lg icon-3x fa-arrow-circle-right text-info ml-2"></i></span>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-lg-6 col-6">
              <div class="small-box bg-info ">
                <div class="inner">
                  <h4>50</h4>
                  <p> My Student Count</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-graduate"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-6 ">
              <div class="small-box bg-info ">
                <div class="inner">
                  <h4>5</h4>
                  <p> My Subject Count</p>
                </div>
                <div class="icon">
                  <i class="fas fa-book"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-6 ">
              <div class="small-box bg-info ">
                <div class="inner">
                  <h4>5</h4>
                  <p> My Lecture Count</p>
                </div>
                <div class="icon">
                  <i class="fas fa-book-reader"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-6">
              <div class="small-box bg-info ">
                <div class="inner">
                  <h4>5</h4>
                  <p> My Lecture Count</p>
                </div>
                <div class="icon">
                  <i class="fas fa-book-reader"></i>
                </div>
              </div>
            </div>
          </div> -->

          <!-- Dashboard-NoticeBoard -->
          <!-- <div class="card card-info">
            <div class="card-header border-transparent">
              <h3 class="card-title">Notice Board</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive mt-1 p-2">
                <table id="example2" class="table table-sm">
                  <thead>
                    <tr>
                      <th>Notices</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td>
                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{asset('student/assets/img/admin.png')}}" alt="user image">
                            <span class="username">
                              <a href="#">Jonathan Burke Jr.</a>
                              <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description">7th November 2020 - 8:30 AM</span>
                          </div>
                          <p style="font-size: smaller;">
                            Lorem ipsum represents a long-held tradition for designers,
                            typographers and the like.
                          </p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{asset('student/assets/img/admin.png')}}" alt="user image">
                            <span class="username">
                              <a href="#">Sanju Burke Jr.</a>
                              <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description">6th November 2020 - 9:30 PM</span>
                          </div>

                          <p style="font-size: smaller;">
                            ABCD ipsum represents a long-held tradition for designers,
                            typographers and the like.
                          </p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{asset('student/assets/img/admin.png')}}" alt="user image">
                            <span class="username">
                              <a href="#">Raju Burke Jr.</a>
                              <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description">5th November 2020 - 7:30 PM</span>
                          </div>

                          <p style="font-size: smaller;">
                            Lorem ipsum represents a long-held tradition for designers,
                            typographers and the like.
                          </p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{asset('student/assets/img/admin.png')}}" alt="user image">
                            <span class="username">
                              <a href="#">Raju Burke Jr.</a>
                              <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description">5th November 2020 - 7:30 PM</span>
                          </div>

                          <p style="font-size: smaller;">
                            Lorem ipsum represents a long-held tradition for designers,
                            typographers and the like.
                          </p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{asset('student/assets/img/admin.png')}}" alt="user image">
                            <span class="username">
                              <a href="#">Raju Burke Jr.</a>
                              <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description">5th November 2020 - 7:30 PM</span>
                          </div>

                          <p style="font-size: smaller;">
                            Lorem ipsum represents a long-held tradition for designers,
                            typographers and the like.
                          </p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{asset('student/assets/img/admin.png')}}" alt="user image">
                            <span class="username">
                              <a href="#">Raju Burke Jr.</a>
                              <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description">5th November 2020 - 7:30 PM</span>
                          </div>

                          <p style="font-size: smaller;">
                            Lorem ipsum represents a long-held tradition for designers,
                            typographers and the like.
                          </p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{asset('student/assets/img/admin.png')}}" alt="user image">
                            <span class="username">
                              <a href="#">Sam Burke Jr.</a>
                              <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description">5th November 2020 - 6:30 PM</span>
                          </div>

                          <p style="font-size: smaller;">
                            Lorem ipsum represents a long-held tradition for designers,
                            typographers and the like.
                          </p>
                        </div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>

            </div>
          </div> -->
          <!-- ./Dashboard-NoticeBoard -->
          <!-- <div class="card card-info collapsed-card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Student's Holiday List</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>         
            <div class="card-body p-0">
              <div class="table-responsive mt-1 p-2">
                <table id="example1" class="table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Occasion</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td>Rakshabandhan</td>
                      <td>1 Jan 2020</td>
                    </tr>
                    <tr>
                      <td>Rakshabandhan</td>
                      <td>1 Jan 2020</td>
                    </tr>
                    <tr>
                      <td>Rakshabandhan</td>
                      <td>1 Jan 2020</td>
                    </tr>
                    <tr>
                      <td>Diwali</td>
                      <td>1 Jan 2020</td>
                    </tr>
                    <tr>
                      <td>Rakshabandhan</td>
                      <td>1 Jan 2020</td>
                    </tr>
                    <tr>
                      <td>Rakshabandhan</td>
                      <td>1 Jan 2020</td>
                    </tr>
                    <tr>
                      <td>Rakshabandhan</td>
                      <td>1 Jan 2020</td>
                    </tr>
                    <tr>
                      <td>Diwali</td>
                      <td>1 Jan 2020</td>
                    </tr>
                    <tr>
                      <td>Rakshabandhan</td>
                      <td>1 Jan 2020</td>
                    </tr>
                    <tr>
                      <td>Rakshabandhan</td>
                      <td>1 Jan 2020</td>
                    </tr>
                    <tr>
                      <td>Rakshabandhan</td>
                      <td>1 Jan 2020</td>
                    </tr>
                    <tr>
                      <td>Diwali</td>
                      <td>1 Jan 2020</td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>            
          </div> -->
        </div>
      </div>
    </div>
  </section>
</div>
<script>
  $(function() {
    $("#example2").DataTable({
      "responsive": true,
      "autoWidth": false,
      "ordering": true,
      "lengthMenu": [
        [3, 8, 10, 25, -1],
        [3, 8, 10, 25, "All"]
      ]
    });
  });
</script>
@endsection