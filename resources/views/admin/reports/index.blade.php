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
                    @foreach($studentClassData as $cl)
                    <option value='{{$cl->class_name}},{{$cl->section_name}},{{ $cl->subject_id }}'>{{$cl->class_name}} {{$cl->section_name}}</option>
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
                    <th style="width:20%">Grade Average</th>
                    <th style="width:20%">Attendance Percentage</th>
                    <th style="width:20%">Classes Conducted</th>
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
@endsection