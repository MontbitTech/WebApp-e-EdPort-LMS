@extends('student.include.app')
@section('content')
<style>
    .subj {

        display: none;
    }
</style>
<!-- Wrapper-->
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Student</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content-header--->

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-4">

                        <!-- Profile-student -->
                        <div class="card card-info card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{asset('student/assets/img/student.png')}}" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{Auth::user()}}</h3>

                                <p class="text-muted text-center">Student</p>

                                <form class="form-horizontal">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Contact no</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter phone" readonly>
                                    </div>

                                    <!-- <div class="form-group">
                                        <label for="exampleInputFile">Choose Profile</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div> -->
                                </form>

                                <button type="submit" class="btn btn-info btn-block"><b>Update</b></button>
                            </div>
                        </div>
                        <!--./ Profile- student -->

                        <!-- Profile-About me -->
                        <!-- <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> School</strong>

                                <p class="text-muted">
                                    B.S. in Computer Science from the University of Tennessee at Knoxville
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i>Address</strong>

                                <p class="text-muted">Malibu, California</p>
                            </div>
                        </div> -->
                        <!-- /.Profile-About me -->

                    </div>

                    <div class="col-md-8">

                        <!-- Profile-Performance card -->
                        <!-- <div class="card card-info collapsed-card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Performance Card</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body pt-2 pb-2">
                                <select data-placeholder="Select subject Name" class="form-control select1 " style="width:100%">
                                    <option value="">Select subject Name</option>
                                    <option value="english">English</option>
                                    <option value="hindi">Hindi</option>
                                    <option value="math">Math</option>
                                </select> -->

                        <!-- English -->

                        <!-- <div class="table-responsive subj english mt-1 p-2">
                                    <label for="select_dob">English</label>
                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Exam Name</th>
                                                <th>Marks</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>[Exam Name]</td>
                                                <td>[Marks]</td>
                                                <td><span class="badge badge-info"> 90%
                                                    </span></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div> -->

                        <!-- ./English -->

                        <!-- Hindi -->

                        <!-- <div class="table-responsive subj hindi mt-1 p-2">
                                    <label for="select_dob">Hindi</label>
                                    <table id="example2" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Exam Name</th>
                                                <th>Marks</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>[Exam Name]</td>
                                                <td>[Marks]</td>
                                                <td><span class="badge badge-info"> 90%
                                                    </span></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div> -->

                        <!-- ./Hindi -->

                        <!-- </div>

                        </div> -->
                        <!-- /.Profile-Performance card -->

                        <!-- Profile-Attendance -->
                        <div class="card card-info collapsed-card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">View Attendance</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive mt-1 p-2">
                                    <table id="example5" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Subject's</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($attendances as $persent)
                                            <tr>
                                                <td>{{$persent->dateclass->class_date}}</td>
                                                @if($persent->status==1)
                                                <td>Present</td>
                                                @else
                                                <td>Absent</td>
                                                @endif
                                                <td>{{$persent->dateclass->studentSubject->subject_name}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.Profile-Attendance -->

                    </div>
                </div>
        </section>
    </div>

    <!-- /.content-wrapper -->
</div>
<script>
    $(document).ready(function() {
        $("select").change(function() {
            $(this).find("option:selected").each(function() {
                var optionValue = $(this).attr("value");
                if (optionValue) {
                    $(".subj").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else {
                    $(".subj").hide();
                }
            });
        }).change();
    });
</script>
<script>
    $(function() {
        $("#example2").DataTable({
            "responsive": true,
            "autoWidth": false,
            "ordering": true,
        });
    });

    $(function() {
        $("#example3").DataTable({
            "responsive": true,
            "autoWidth": false,
            "ordering": true,
        });
    });

    $(function() {
        $("#example4").DataTable({
            "responsive": true,
            "autoWidth": false,
            "ordering": true,
        });
    });

    $(function() {
        $("#example5").DataTable({
            "responsive": true,
            "autoWidth": false,
            "ordering": true,
        });
    });
</script>
@endsection