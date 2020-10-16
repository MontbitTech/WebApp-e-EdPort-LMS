<div class="tab-pane fade" id="upcomingclasses">

    @if(count($futureDates) > 0)
    @php
    $i=1;
    @endphp
    <div class="form-group col-md-5">
        <select name="past_class" id="futureclassdata{{$i}}" style="margin-left: -14px;width:60%" class="form-control" onchange="viewFutureClass({{$i}})">
            <option value="">Select Date</option>
            @foreach ($futureDates as $tt)
            <option value="{{$tt->class_date}}">{{ date("D, d M", strtotime($tt->class_date))}}</option>
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
            <div class="card-header text-white p-0  pt-1 pb-2 " style="background:#253372;">
                <div class="container-fluid">

                    <div class="row ">
                        <div class="col-md-3 col-3 col-lg-3 top-padding p-0 m-0">
                            <div class="row p-0 m-0">
                                <div class="col-md-4 col-lg-4 col-4 p-0 m-0 font-weight-bold ">{{ $class_date }}</div>
                                <div class="col-8 col-md-8 col-lg-8 m-0 p-0"> {{ date('h:i a',strtotime($t->from_timing))}} to {{ date('h:i a',strtotime($t->to_timing))}}</div>
                            </div>
                        </div>
                        <div class="col-2 col-md-2 col-lg-2 top-padding font-weight-bold tetx-right"> Class: {{ $class_name }} Std</div>
                        <div class="col-2 col-md-2 col-lg-2 top-padding font-weight-bold text-right"> Section:{{$section_name}}</div>
                        <div class="col-5 col-md-5 col-lg-5 top-padding font-weight-bold"> Subject: {{$subject_name}}</div>

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

    <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
        <svg class="icon icon-4x mr-3">
            <use xlink:href="../images/icons.svg#icon_nodate"></use>
        </svg>
        No Record Found!
    </div>
    @endif
</div>