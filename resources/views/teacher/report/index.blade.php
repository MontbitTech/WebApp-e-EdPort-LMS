@extends('layouts.teacher.app')
@section('content')
<style>
  .dataTables_length {
    padding-left: 20px !important;
  }

  /* .collaspe-btn:hover { */
  /* animation: mymove 1s; */
  /* animation-iteration-count: infinite; */
  /* animation-iteration-count: 1; */
  /* transition: transform 1s; */
  /* } */

  /* @keyframes mymove {
          from {
            transform: rotate(0deg);
          }

          to {
            transform: rotate(180deg);
          }
        } */

  /* .collaspe-btn:hover {
          transform: rotate(70deg);
        } */
  .btn-gen:hover {
    background-color: white;
    color: #253372;
    text-decoration: none;
    border: 1px #253372 solid;
  }

  .dataTables_filter {
    padding-right: 20px !important;
  }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/datatables.min.js"></script>
<section class="main-section">
  <div class="container">
    <div class="row" style="padding: inherit;padding-bottom: 2%;">

      <a href="javascript:getReport()" class="btn btn-ui float-right m-0  btn-gen">
        <svg class="icon mr-1">
          <use xlink:href="{{asset('images/icons.svg#gert_reports')}}"></use>
        </svg>Generate Report</a>
    </div>
    <div class="container">
      <div class="row" style="display: none;" id="examinationReport">
        @include('teacher.examination.studentreport')
      </div>
    </div>
    <div class="row" style="display: none;" id="classroomReport">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header btn-ui">Assignment Submission Summary
            <!-- <a href="#" class="btn bg-white float-right m-0 ">Report</a> -->
          </div>
          <div class="card-body   card-border p-2 pb-0 border">

            <?php if (count($inviteClassData) > 0) { ?>
              <div class="table-responsive-sm">
                <table id="teacherlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                  <thead>
                    <tr>
                      <th>Class/Section Subject</th>
                      <!-- <th>Subject</th> -->
                      <th>Submissions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $i = 0;
                    foreach ($inviteClassData as $row) {
                      $section_name = '';
                      $subject_name = '';
                      $cls = '';
                      $g_link = '';
                      if ($row->studentClass) {
                        $cls = $row->studentClass->class_name;
                        $section_name = $row->studentClass->section_name;
                        $g_link = $row->studentClass->g_link;
                      }
                      if ($row->studentSubject) {
                        $subject_name = $row->studentSubject->subject_name;
                      }
                    ?>
                      <tr>
                        <td>{{ $cls }} {{ $section_name }} Std {{ $subject_name }} </td>

                        <td><a href="javascript:void(0);" data-INVLiveLink="{{ $g_link.'/gb' }}" id="Inv_live_c_link_{{$i}}" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
                            <svg class="icon font-10 mr-1">
                              <use xlink:href="../images/icons.svg#icon_dot"></use>
                            </svg>
                            Check Submissions
                          </a></td>
                      </tr>


                    <?php
                    } ?>

                  </tbody>
                </table>
              </div>
            <?php
              $i++;
            } else {
            ?>
              <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
                <svg class="icon icon-4x mr-3">
                  <use xlink:href="../images/icons.svg#icon_nodate"></use>
                </svg>
                No Record Found!
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- <script type="text/javascript">--}}
{{-- $(document).ready(function () {--}}
{{-- var fromDate = $('#from_date');--}}
{{-- var toDate = $('#to_date');--}}
{{-- $.timepicker.dateRange(--}}
{{-- fromDate,--}}
{{-- toDate, {--}}
{{-- dateFormat : 'd M yy',--}}
{{-- minInterval: (1000 * 60 * 60 * 24 * 0), // 1 days--}}
{{-- // maxInterval: (1000*60*60*24*1), // 1 days--}}
{{-- start      : {}, // start picker optionst--}}
{{-- end        : {} // end picker options--}}
{{-- });--}}
{{-- });--}}
{{-- </script>--}}

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  // google.charts.load('current', {
  //     'packages': ['corechart']
  // });
  // google.charts.setOnLoadCallback(drawChart);

  // function drawChart() {
  //     var data = google.visualization.arrayToDataTable([
  //         ['Attendence', 'Percentage'],
  //         ['Present', 80],
  //         ['Absent', 20]
  //     ]);
  //     var options = {
  //         title        : 'Students Attendence',
  //         titlePosition: 'center',
  //         titleFontSize: 16,
  //         colors       : ['#28a745', '#e0440e'],
  //         legend       : {
  //             position : 'bottom',
  //             alignment: 'center'
  //         }
  //     };
  //     var chart = new google.visualization.PieChart(document.getElementById('chart'));
  //     chart.draw(data, options);
  // }

  $(document).on('click', '[data-INVLiveLink]', function() {
    var liveurl = $(this).attr("data-INVLiveLink");
    if (liveurl != '') {
      //$('#viewClassModal').modal('show');
      //$("#thedialog").attr('src','https://google.com');
      window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
    } else {
      alert('No Class url found!');
    }
  });
</script>
<script>
  $(document).ready(function() {
    $('#teacherlist').DataTable({
      buttons: [
        'excelHtml5'
      ]
    });
  });
</script>
<script>
  // $('.collaspe-btn').click(function () {
  //     $(this).find('i').toggleClass('fas fa-minus');
  //     $(this).find('i').toggleClass('fas fa-plus');
  //     //$(this).find('i').toggle(function(){});
  // });

  function getReport() {
    $('.loader').show();
    $.ajax({
      url: "{{url('/teacher/generateReports')}}",
      type: "GET",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(result) {
        $('.loader').fadeOut();
        $('#classroomReport').html(result);
        $('#classroomReport').show();
        $('#examinationReport').show();
      }
    });
  }
</script>
@endsection