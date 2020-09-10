<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
    <h1>Hi,</h1>
    <h4>your this week's class schedule is as follows,</h4>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Start</th>
                <th>End</th>
                <th>subject</th>
                <th>Teacher</th>
                <th>Join</th>
            </tr>
        </thead>
        <tbody>

            @foreach($weeksClasses as $weekclass)
            <tr>
                <td>{{$weekclass['class_date']}}</td>
                <td>{{$weekclass['from_timing']}}</td>
                <td>{{$weekclass['to_timing']}}</td>
                <td>@if($weekclass['student_subject'] != null) {{$weekclass['student_subject']['subject_name']}} @endif</td>
                <td>@if($weekclass['teacher'] != null) {{$weekclass['teacher']['name']}} @endif</td>
                <td><a href="{{$weekclass['teacher']['g_meet_url']}}">Join class</a> </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>