@extends('layouts.teacher.app')
@section('content')
	
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
  </div>
</section>

<script type="text/javascript">
$(document).ready(function(){
  var fromDate = $('#from_date');
  var toDate = $('#to_date');
  $.timepicker.dateRange(
    fromDate,
    toDate,
    {
      dateFormat: 'd M yy',
      minInterval: (1000*60*60*24*0), // 1 days
      // maxInterval: (1000*60*60*24*1), // 1 days
      start: {}, // start picker options
      end: {} // end picker options
    });
});
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
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
    legend: { position: 'bottom', alignment: 'center' }
  };
  var chart = new google.visualization.PieChart(document.getElementById('chart'));
  chart.draw(data, options);
}
</script>
@endsection