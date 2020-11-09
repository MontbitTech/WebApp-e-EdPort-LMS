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
    <tbody>



        <?php
        $i = 0;
        foreach ($studentClassData as $studentClass) {
            $section_name = '';
            $subject_name = '';
            $cls = '';
            $g_link = '';
            if ( $studentClass ) {
                $cls = $studentClass->class_name;
                $section_name = $studentClass->section_name;
                $g_link = $studentClass->g_link;
            }
            if ( $studentClass->studentSubject ) {
                $subject_name = $studentClass->studentSubject->subject_name;
            }
            if(count($studentClass->dateClass)>0){
            $teacher_id = $studentClass->dateClass[0]->teacher_id;
            }
            else{
            $teacher_id = 0; 
            }

            ?>
            <tr>@if($subject_name != 'Lunch')
                <td>
                {{ $cls }} {{ $section_name }} {{ $subject_name }}
                </td>

            <?php
            foreach ($teacherData as $teacher) {
            if($teacher->id == $teacher_id){
            ?>
                <td>{{ $teacher->name }}</td>
            <?php
             }
             } ?> 

<td>
    @if(isset($totalClassesOfClassrooms[$studentClass->id]) && isset($cancelledClassesOfClassrooms[$studentClass->id]))
    {{count($totalClassesOfClassrooms[$studentClass->id]) - count($cancelledClassesOfClassrooms[$studentClass->id])}}
    / {{count($totalClassesOfClassrooms[$studentClass->id])}}
    @endif
</td>

<td>
    @if(isset($attendanceAverage[$studentClass->id]))
    {{$attendanceAverage[$studentClass->id]}}
    @endif
</td>

<td>
    @if(isset($gradeAverage[$studentClass->id]))
    {{$gradeAverage[$studentClass->id]}}
    @endif
</td>

<!-- <td>
<a href="javascript:void(0);" data-INVLiveLink="{{ $g_link.'/gb' }}" id="Inv_live_c_link_{{$i}}"
class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
<svg class="icon font-10 mr-1">
<use xlink:href="../images/icons.svg#icon_dot"></use>
</svg>
Check Submissions
</a>
</td> -->
@endif
</tr>


<?php
} ?>

</tbody>
</table>

<table id="student-reports" class="table table-sm table-bordered display" style="width:100%"
    data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120"
    data-filterplaceholder="Search Records ...">
    @if($getStudents != '')
    <thead>
        <tr>
            <th style="width:20%">Students</th>
            <th style="width:20%">Email</th>
            <th style="width:20%">Attendance %</th>
            <!-- <th style="width:20%">Grade Average</th> -->
            <!-- <th style="width:20%">Classes Conducted</th> -->
        </tr>
    </thead>
    @endif
    <tbody>
        <?php
        $i = 0;
        foreach ($getStudents as $getStudent) {
             foreach ($getStudent->students as $student) {
            ?>
            <tr>
                <td>{{$student->name }}</td>
                <td>{{$student->email }}</td>

                <?php
                 $total = 0;
                 $present = 0;
                 $attendancePercentage = 0;
                 foreach($getAttendance as $attendance) {
                 if($student->id == $attendance->student_id ){
                     $total++;
                     if($attendance->status == 1){
                       $present++;
                       $attendancePercentage = number_format(($present/$total)*100,2);
                ?>
                <?php
               } } }?> 
                <td>{{$attendancePercentage}}</td>  

               <!--  <td>
                @if(isset($gradeAverage[$student->id]))
                {{$gradeAverage[$student->id]}}
                @endif
               </td> -->

            </tr>
       <?php
    } } ?>

</tbody>
</table>


<script type="text/javascript">
    $(document).ready(function() {
        $('#student-reports').DataTable({
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

