@if(count($futureDates) > 0)
@php
$i=1;
@endphp
<div class="form-group col-md-5">
    <select name="past_class" id="futureclassdata{{$i}}" style="margin-left: -14px;width:60%" class="form-control" onchange="viewFutureClass({{$i}})">
        <option value="{{$class_date}}">{{$class_date}}</option>
        @foreach ($futureDates as $tt)
        @if(date("D, d M", strtotime($tt->class_date))!=$class_date)
        <option value="{{$tt->class_date}}">{{ date("D, d M", strtotime($tt->class_date))}}</option>
        @endif
        @php
        $i++;
        @endphp
        @endforeach
    </select>
</div>

@endif

@if(count($futureClassData) > 0)

@php
$i=1;
@endphp
@foreach ($futureClassData as $t)
<?php
$cls = 0;
$section_name = '';
$g_class_id = '';
$class_name = '';
$subject_name = '';
if ($t->studentClass) {
    $class_name = $t->studentClass->class_name;
    //$class_name = App\Http\Helpers\CommonHelper::addOrdinalNumberSuffix($t->studentClass->class_name);
    $section_name = $t->studentClass->section_name;
    $g_class_id = $t->studentClass->g_class_id;
}
if ($t->studentSubject) {
    $subject_name = $t->studentSubject->subject_name;
}
?>

<div id="upcmoingclass">
    <div class="card text-center mb-3">

        <input type="hidden" id="pastdateClass_id{{$i}}" value="{{$t->id}}">
        <input type="hidden" id="past_class_id{{$i}}" value="{{$t->class_id}}">
        <input type="hidden" id="past_subject_id{{$i}}" value="{{$t->subject_id}}">


        <input type="hidden" id="past_desc{{$i}}" value="{{$t->class_description}}">
        <input type="hidden" id="past_gMeetURL{{$i}}" value="{{$t->g_meet_url}}">
        <input type="hidden" id="past_stdMessage{{$i}}" value="{{$t->class_student_msg}}">
        <input type="hidden" id="past_recURL{{$i}}" value="{{$t->recording_url}}">
        <input type="hidden" id="pastg_class_id_{{$i}}" value="{{ $g_class_id}}" />
        <?php
        $class_date = date("d M", strtotime($t->class_date));
        ?>

        <div class="card-header text-white p-0  " style="background:#253372;">
            <div class="container">


                <div class="row pl-2 pr-3">
                    <div class="d-flex align-items-center col-md-4">
                        <div class="cls-date font-weight-bold">{{ $class_date }}</div>
                        <div class="cls-from pt-1">
                            {{ date('h:i a',strtotime($t->from_timing))}} to {{ date('h:i a',strtotime($t->to_timing))}}
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between col-md-8">
                        <div class="font-weight-bold pt-1">
                            Class: {{ $class_name }} Std
                        </div>
                        <div class="font-weight-bold pt-1">
                            Section:{{$section_name}}
                        </div>
                        <div class="font-weight-bold pt-1">
                            Subject: {{$subject_name}}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@php
$i++;
@endphp
@endforeach
@else

<!-- <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
                                                        <svg class="icon icon-4x mr-3">
                                                            <use xlink:href="../images/icons.svg#icon_nodate"></use>
                                                        </svg>
                                                        No Lectures found for {{ date("d/m/Y") }}.
                                                        <br><br>
                                                        <a href="{{ route('reload-timetable') }}" target="_blank">
                                                            Click here to reload updated timetable again.
                                                        </a>
                                                        <script>
                                                            function reload_timetable() {
                                                                fetch("{{ route('reload-timetable') }}")
                                                                    .then(function (response) {
                                                                        location.reload();
                                                                    })
                                                            }
                                                            reload_timetable()
                                                        </script>
                                                    </div> -->
@endif
<script>
    $('.card-header').click(function() {
        $(this).find('i').toggleClass('fas fa-minus');
        $(this).find('i').toggleClass('fas fa-plus');

        //$(this).find('i').toggle(function(){});
    });
</script>