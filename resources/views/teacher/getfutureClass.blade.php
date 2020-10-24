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

        <div class="card-header upcoming-mobile text-white pt-2 pb-2 " style="background:#253372;">
            <div class="container-fluid">

                <div class="row ">
                    <div class="col-md-2 col-lg-2 col-2 text-left pl-3 pt-1 pb-2 m-0 font-weight-bold upcoming-date-mobile font-size-tab ">{{ $class_date }}</div>
                    <div class=" col-md-3 col-3 col-lg-2 col-sm-3 font-weight-bold pr-0 pt-1 pb-2 pl-1 font-size-tab  mobile-hide">
                        {{ date('h:i a',strtotime($t->from_timing))}} to {{ date('h:i a',strtotime($t->to_timing))}}
                    </div>
                    <div class=" col-3   col-sm-3 font-weight-bold moblie-show mobile-screen-size-time  pr-0 pt-1 pl-1 font-size-tab ">
                        {{ date('H:i ',strtotime($t->from_timing))}} - {{ date('H:i ',strtotime($t->to_timing))}}
                    </div>
                    <div class=" col-md-7 col-7 col-sm-7 font-weight-bold pt-1 pb-2 p-0 font-size-tab display-none-lp"> Classroom: {{ $class_name}} {{$section_name }} , {{$subject_name}}</div>
                    <div class="col-md-2 col-2 col-lg-2 col-sm-2 font-weight-bold pt-1 pb-2 p-0 font-size-tab display-none-tab"> Class: {{ $class_name }} Std</div>
                    <div class="col-md-1 col-1 col-lg-1 col-sm-1 font-weight-bold pt-1 pb-2 p-0 font-size-tab display-none-tab"> Section:{{$section_name}}</div>
                    <div class="col-md-5 col-5 col-lg-5 col-sm-5 font-weight-bold   m-auto pt-1 pb-2 p-0 font-size-tab display-none-tab"> Subject: {{$subject_name}}</div>

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