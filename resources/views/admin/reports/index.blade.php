@extends('layouts.admin.app')
@section('content')

<style>
    #eventdetail_wrapper .row:first-child {
        display: flex;
    }

    .classes-box {
        position: relative;
        border: 1px solid transparent;
        overflow: hidden;
        background-color: #fff;
        box-shadow: 0px 1px 7px gainsboro;
        transition: 300ms;
    }
</style>
<section class="main-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @if(count($studentClassData) > 0)
                <div class="card card-common mb-3">

                    <div class="card-header">
                        <span class="topic-heading">Reports</span>
                    </div>
                    <div class="card-body pt-3">
                    <div class="col-md-6 col-lg-6 text-md-left text-center mb-1">
                    <span data-dtfilter="" class="mb-1">
                    <!-- <div class="spinner-border spinner-border-sm text-secondary" role="status" ></div> 
                    <input type="text"  id="txtSerachByClass" class="form-control form-control-sm" placeholder="Search By Class..." />-->

                    <select id="getreports" name="getreports" class="form-control form-control-sm" onchange="getReports()">
                    <option value=''>Select Classroom</option>
                    @if(count($studentClassData)>0)
                    <option value='allReports'>All</option>
                    @foreach($studentClassData as $getData)
                    <option value='{{$getData->class_name}},{{$getData->section_name}},{{ $getData->subject_id }}'>{{$getData->class_name}} {{$getData->section_name}}</option>
                    @endforeach
                    @endif
                  </select>

                    </span>

                    </div>
                    <div class="col-sm-12" id="getData">
                    <table id="reports" class="table table-sm table-bordered display" style="width:100%"
                   data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120"
                   data-filterplaceholder="Search Records ...">
                <thead>
                <tr>
                     <th style="width:20%">Classroom</th>
                    <th style="width:20%">Teacher</th>
                    <th style="width:20%">Classes Conducted</th>
                    <th style="width:20%">Attendance %</th>
                    <th style="width:20%">Grade Average</th>
                </tr>
                </thead> 
            </table>
                        </div>
                    </div>
                </div>
                @else
                <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
                    <svg class="icon icon-4x mr-3">
                        <use xlink:href="../images/icons.svg#icon_nodate"></use>
                    </svg>
                    No Record Found!
                </div>
                @endif
               </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                @if(count($studentClassData) > 0)
                <div class="card card-common mb-3">

                    <div class="card-header">
                        <span class="topic-heading">Examination Reports</span>
                    </div>
                    <div class="card-body pt-3">

                    <div class="col-md-6 col-lg-6 text-md-left text-center mb-1">
                    <span data-dtfilter="" class="mb-1">
                    <!-- <div class="spinner-border spinner-border-sm text-secondary" role="status" ></div> 
                    <input type="text"  id="txtSerachByClass" class="form-control form-control-sm" placeholder="Search By Class..." />-->

                     <select class="form-control" id="classroom" onchange="javascript:getExamination()">
                    <option value="" selected>Select Classroom</option>
                    @foreach($studentClassData as $getData)
                    <option value='{{ $getData->id }}'>{{ $getData->class_name }} {{ $getData->section_name }} {{ $getData->studentSubject->subject_name }}</option>
                    @endforeach
                  </select>

                    </span>

                    <span data-dtfilter="" class="mb-1">
                    <!-- <div class="spinner-border spinner-border-sm text-secondary" role="status" ></div> 
                    <input type="text"  id="txtSerachByClass" class="form-control form-control-sm" placeholder="Search By Class..." />-->

                    <select class="form-control" id="examination" onchange="javascript:getResultOfClassroom()">
                         <option value="" selected>Select Examination</option>
                         
                     </select>

                    </span>

                    </div>


                    <div class="col-sm-12" id="getData">
                    <table id="studentreport" class="table table-sm table-bordered display" style="width:100%"
                   data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120"
                   data-filterplaceholder="Search Records ...">
                 <thead>
                     <tr>
                         <th style="width:20%">Student name</th>
                         <th style="width:20%">Classroom</th>
                         <th style="width:20%">Exam name</th>
                         <th style="width:20%">Marks</th>
                     </tr>
                 </thead>
                 <tbody id="resultTableBody">

                 </tbody>
             </table>
                        </div>
                    </div>
                </div>
                @else
                <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
                    <svg class="icon icon-4x mr-3">
                        <use xlink:href="../images/icons.svg#icon_nodate"></use>
                    </svg>
                    No Record Found!
                </div>
                @endif
               </div>

        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $('#reports').DataTable({
            initComplete: function(settings, json) {
                $('[data-dtlist="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_length').find("label"));
                $('[data-dtfilter="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_filter').find("input[type=search]").attr('placeholder', $('#' + settings.nTable.id).attr('data-filterplaceholder')))
            },
            "lengthMenu": [
                [100, 200, 500, -1],
                [100, 200, 500, "All"]
            ]
        });
    });

    $(document).ready(function() {
        $('#studentreport').DataTable({
            initComplete: function(settings, json) {
                $('[data-dtlist="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_length').find("label"));
                $('[data-dtfilter="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_filter').find("input[type=search]").attr('placeholder', $('#' + settings.nTable.id).attr('data-filterplaceholder')))
            },
            "lengthMenu": [
                [100, 200, 500, -1],
                [100, 200, 500, "All"]
            ]
        });
    });
</script>

<script>
  function getReports() {
    $("#getData").hide();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var getreports = $("#getreports").val();
    var data = getreports.split(',');
    var class_name = data[0];
    var section = data[1];
    // var subject = data[2];
    // var allReports = allReports;
    $('.loading').show();
    $.ajax({
      url: "{{url('admin/filter-reports')}}",
      type: 'POST',
      data: {
        class   : class_name,
        section : section,
        // subject : subject,
        // allReports : allReports
      },
      success: function(info) {
        $('#getData').html(info);
        $('.loading').fadeOut();
        $('#getData').show();
      }
    });
  }
</script>

<script>

    function getExamination(){
        var classroom_id = $('#classroom').val();

        //alert(classroom_id);
        
        $('.loader').show();
         $.ajax({
             url: "{{url('/admin/examination/getExamsList')}}",
             type: "GET",
             data: {
                 classroom_id   : classroom_id,
             },
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             success: function(result) {
                $('.loader').fadeOut();
                let response = JSON.parse(result);
                $('#examination').empty();
                $('#examination').append('<option value="">Select Examination </option>');
                $.each(response.data, function(key, value) {
                    $('#examination').append('<option value="' + value.examination_id + '">' + value.examination.title + '</option>');
                });
             },
             error: function(error_r) {
                 $('.loader').fadeOut();
                 console.log(error_r);
             }
         });
     }
    function getResultOfClassroom() {

         var classroom_id = $('#classroom').val();
         var examination_id = $('#examination').val();

         $('.loader').show();
         $.ajax({
             url: "{{url('/admin/examination/resultList')}}",
             type: "GET",
             data: {
                 classroom_id   : classroom_id,
                 examination_id : examination_id
             },
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             success: function(result) {
                 $('#resultTableBody').empty();
                 $('.loader').fadeOut();
                 var data = '';
                 $.each(result.response, function(index, val) {
                     data += '<tr>';
                     data += '<td>' + val.student.name + '</td>';
                     data += '<td>' + val.classroom.class_name + ' ' + val.classroom.section_name + ' ' + val.classroom.student_subject.subject_name + '</td>';
                     data += '<td>' + val.examination.title + '</td>';
                     data += '<td>' + val.marks_obtained + '/' + val.total_marks + '</td>';
                     data += '</tr>'
                 });

                 $('#resultTableBody').html(data);

             },
             error: function(error_r) {
                 $('.loader').fadeOut();
                 console.log(error_r);
             }
         });
     }
</script>
@endsection