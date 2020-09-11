@extends('layouts.teacher.app')
@section('content')
<style>
  .dataTables_length {
    padding-left: 20px !important;
  }

  .dataTables_filter {
    padding-right: 20px !important;
  }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/datatables.min.js"></script>
<section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-xl-8">
        <div class="classes-box pr-3 min-height-auto">
          <div class="classes-datetime">
            <div class="cls-date">22 Apr</div>
            <div class="cls-from">10:00 AM</div>
            <div class="cls-separater">to</div>
            <div class="cls-to">11:00 AM</div>
          </div>
          <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
            <div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> 7th Std</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> A</div>
            <div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> Physics</div>
          </div>
          <p class="mt-0 mb-1 text-secondary">
            The branch of science concerned with the nature and properties of matter and energy.
          </p>
          <div class="py-2">
            <div class="row m-0 p-1 border bg-light">
              <div class="col-md-6 text-center pt-2">Visual Result of quiz</div>
              <div class="col-md-6">
                <div id="chart" style="width:300px;height:180px;margin:0 auto"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-xl-4 mb-3">
        <div class="p-3 p-md-4 h-100 bg-lightblue">
          <h5 class="font-weight-bold mb-3">Download Report</h5>
          <div class="form-group">
            <label for="classChoose" class="mb-0">Class:</label>
            <select class="form-control form-control-sm border-0" id="classChoose">
              <option>Select Class</option>
              <option>5th Std</option>
              <option>6th Std</option>
              <option>7th Std</option>
              <option>8th Std</option>
              <option>9th Std</option>
              <option>10th Std</option>
            </select>
          </div>
          <div class="form-group">
            <label for="subjectChoose" class="mb-0">Subject:</label>
            <select class="form-control form-control-sm border-0" id="subjectChoose">
              <option>Select Subject</option>
              <option>Physics</option>
              <option>Maths</option>
              <option>Chemistry</option>
              <option>English</option>
              <option>Biology</option>
              <option>Hindi</option>
            </select>
          </div>
          <div class="form-group">
            <label for="topicChoose" class="mb-0">Date:</label>
            <div class="d-flex">
              <input type="text" name="fromdate" class="form-control form-control-sm mr-1" placeholder="From Date" id="from_date">
              <input type="text" name="todate" class="form-control form-control-sm ml-1" placeholder="To Date" id="to_date">
            </div>
          </div>
          <button type="button" class="btn btn-primary">Download</button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header text-white" style="background-color: #253372;">Assignment Submission Summary</div>
          <div class="card body pt-2">

            <?php if (count($inviteClassData) > 0) { ?>
              <table id="teacherlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                <thead>
                  <tr>
                    <th>Class/Section</th>
                    <th>Subject</th>
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
                      <td>{{ $cls }} Std {{ $section_name }}</td>
                      <td>{{ $subject_name }}</td>
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

<script type="text/javascript">
  $(document).ready(function() {
    var fromDate = $('#from_date');
    var toDate = $('#to_date');
    $.timepicker.dateRange(
      fromDate,
      toDate, {
        dateFormat: 'd M yy',
        minInterval: (1000 * 60 * 60 * 24 * 0), // 1 days
        // maxInterval: (1000*60*60*24*1), // 1 days
        start: {}, // start picker optionst
        end: {} // end picker options
      });
  });
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Attendence', 'Percentage'],
      ['Present', 80],
      ['Absent', 20]
    ]);
    var options = {
      title: 'Students Attendence',
      titlePosition: 'center',
      titleFontSize: 16,
      colors: ['#28a745', '#e0440e'],
      legend: {
        position: 'bottom',
        alignment: 'center'
      }
    };
    var chart = new google.visualization.PieChart(document.getElementById('chart'));
    chart.draw(data, options);
  }

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
    $('#teacherlist').DataTable();
  });
</script>
@endsection