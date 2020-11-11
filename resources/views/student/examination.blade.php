@extends('student.include.app')
@section('content')
<style>
    .subj {

        display: none;
    }

    .exam {
        display: none;
    }
</style>
<!-- Examination-Main-content -->

<div class="content-wrapper">

    <!-- Examination-Header-Content -->

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Examination</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Student</a></li>
                        <li class="breadcrumb-item active">Examination</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- ./Examination-Header-Content -->

    <!-- Examination-Body-Content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info collapsed-card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Examination </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <select data-placeholder="Select Examination Name" id="examination" class="d-none form-control " style="width:100%">
                                <option value="">Select Examination Name</option>
                                @foreach($examination->unique('classroom_id') as $exam)
                                <option value="{{$exam->classroom_id}}">{{$exam->classroom->studentSubject->subject_name}}</option>
                                @endforeach
                            </select>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Exam Name</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col" class="text-center">Date</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($examination as $exam)
                                    <tr>
                                        <td>{{$exam->examination->title}}</td>
                                        <td>{{$exam->classroom->studentSubject->subject_name}}</td>
                                        <td>{{date('d M h:i a',strtotime($exam->start_time))}} To {{date('d M h:i a',strtotime($exam->end_time))}}</td>
                                        <td>{{date('i',strtotime($exam->duration))}} min</td>
                                        <td>
                                            @if(date('d m H:i',strtotime($exam->start_time)) <= date('d m H:i'))<a href="{{env('APP_URL') . '/student/exam?examID='}}{{$exam->id}}">Start</a>
                                                @else
                                                Wait
                                                @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="english exam mt-3">
                                <form role="form">
                                    <div class="form-group">
                                        <label for="exampleInputQuestion" class="mb-0">English</label>
                                    </div>
                                    <hr>
                                    <label for="exampleInputQuestion" class="align-top">Question 1</label>
                                    <div class="form-group mb-0 pb-1">
                                        <textarea name="" id="exampleInputQuestion" class="w-100" rows="3">your company name</textarea>
                                        <!-- <input type="text" class="form-control form-control-sm" id="exampleInputQuestion" placeholder="Insert your question"> -->
                                    </div>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center pb-0 pt-0 mb-0 mt-0">Option </th>
                                                <th scope="col" class="pb-0 pt-0 mb-0 mt-0">Answer</th>
                                                <th scope="col" class="text-center pb-0 pt-0 mb-0 mt-0">Option </th>
                                                <th scope="col" class="pb-0 pt-0 mb-0 mt-0">Answer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="mb-0 mt-0 pt-0 pb-1">
                                                    <input class="form-control form-control-sm  " value="MontBit" type="text" placeholder="option 1">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 " checked>
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-1">
                                                    <input class="form-control form-control-sm  " value="info" type="text" placeholder="option 2">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="mb-0 mt-0 pt-1 pb-0">
                                                    <input class="form-control form-control-sm  " value="company" type="text" placeholder="option 3">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 ">
                                                </td>
                                                <td class="mb-0 mt-0 pt-1 pb-0">
                                                    <input class="form-control form-control-sm  " value="no" type="text" placeholder="option 4">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 ">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="newquestion"></div>
                                    <a class="btn btn-info addquestion w-100 mb-1"><i class="fas fa-plus text-white"></i></a>
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- <div class="row">
                        <div class="col-md-6">
                            <div class="small-box bg-info ">
                                <div class="inner">
                                    <h4>50</h4>
                                    <p> My Pending Exam</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="small-box bg-info ">
                                <div class="inner">
                                    <h4>5</h4>
                                    <p> My Today Exam</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="small-box bg-info ">
                                <div class="inner">
                                    <h4>5</h4>
                                    <p> My Upcoming Exam</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="small-box bg-info ">
                                <div class="inner">
                                    <h4>10</h4>
                                    <p> My Attend Exam</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-trophy "></i>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- Profile-Performance card -->
                    <div class="card card-info collapsed-card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title"><i class="fas fa-award"></i> Performance Card</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <select data-placeholder="Select Subject Name" id="performance" class="form-control select1 " style="width:100%">
                                <option value="">Select Subject Name</option>
                                @foreach($performance->unique('classroom_id') as $exam)
                                <option value="{{$exam->classroom_id}}">{{$exam->classroom->studentSubject->subject_name}}</option>
                                @endforeach
                            </select>
                            <!-- English -->
                            <div class="table-responsive  mt-1 p-2" id="performanceTable" style="display: none;">
                                <!-- <label for="select_dob">English</label> -->
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
                                            <td><span class="badge badge-info">90%</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- ./English -->
                        </div>
                    </div>
                    <!-- /.Profile-Performance card -->
                </div>
    </section>
    <!-- ./Examination-Body-Content -->
</div>
<script>
    $('#performance').on('change', function() {
        var classroom_id = $(this).val();
        //console.log(classroom_id);
        $('.loader').show();
        $.ajax({
            url: "{{url('/student/examination/performance')}}",
            type: "GET",
            data: {
                classroom_id: classroom_id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                let count = 1;
                let data = "";
                var response = JSON.parse(result);
                response.data.forEach(function(exam) {
                    $('#example1').find('tbody').remove();
                    let percent = (exam.marks_obtained / exam.total_marks) * 100
                    data += '<tbody>';
                    data += '<tr>';
                    data += '<td>' + exam.examination.title + '</td>';
                    data += '<td>' + exam.marks_obtained + '</td>';
                    data += '<td><span class="badge badge-info">' + percent + '%' + '</span></td>';
                    data += '</tbody>';
                    count++;
                });
                $('#example1').append(data);
                $('#performanceTable').show();

            },
            error: function(error_r) {
                $('.loader').fadeOut();
                console.log(error_r);
            }
        });
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
</script>

<!--./Examination - Main - content-->
@endsection