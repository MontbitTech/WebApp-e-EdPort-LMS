@extends('student.include.app')
@section('content')
<style>
    .subj {

        display: none;
    }
</style>
@php
$student = Session::get('student_session')['student'];
@endphp
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
                                    <img class="profile-user-img img-fluid img-circle" src="{{asset($student->profile_picture)}}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">{{$student->name}}</h3>
                                <p class="text-muted text-center">Student</p>
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{$student->email}}" placeholder="Enter email" readonly>
                                    </div>
                                </form>
                                <button type="submit" class="btn btn-info btn-block"><b>Update</b></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">

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