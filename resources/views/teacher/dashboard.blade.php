@extends('layouts.teacher.app')
@php$i = 1;$k=$i;@endphp
@section('content')
<?php
$cls = 0;
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/datatables.min.js"></script>

<section class="main-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <ul class="nav nav-tabs1 nav-pills" id="myTab" role="tablist">
                    <li class="nav-item mb-1">
                        <a class="nav-link shadow-sm active" data-toggle="tab" href="#ulclasses" role="tab" aria-selected="true">Today's Live Classes</a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link shadow-sm" data-toggle="tab" href="#plclasses" role="tab">Past Live
                            Classes</a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link shadow-sm" data-toggle="tab" href="#newInvitationclasses" role="tab">Assignment Submission Summary</a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link shadow-sm" data-toggle="tab" href="#upcomingclasses" role="tab">Future
                            Classes</a>
                    </li>
                    <li class="nav-item mb-1 ml-md-auto">
                        <a class="nav-link shadow-sm mr-0" data-toggle="modal" href="#addClassModal" role="modal">
                            <svg class="icon mr-1">
                                <use xlink:href="../images/icons.svg#icon_plus"></use>
                            </svg>
                            Add Classes
                        </a>
                    </li>
                </ul>
                <div class="tab-content pt-3">
                    <div class="tab-pane fade show active" id="ulclasses">

                        @if(count($TodayLiveData) > 0)

                        @php
                        $i=1;
                        @endphp
                        @foreach ($TodayLiveData as $t)

                        <?php
                        $cls = 0;
                        $class_name = '';
                        $section_name = '';
                        $g_class_id = '';
                        $subject_name = '';
                        if ($t->studentClass) {
                            $class_name = $t->studentClass->class_name;
                            $cls = $t->studentClass->class_name;
                            // $class_name = App\Http\Helpers\CommonHelper::addOrdinalNumberSuffix($t->studentClass->class_name);
                            $section_name = $t->studentClass->section_name;
                            $g_class_id = $t->studentClass->g_class_id;
                        }
                        if ($t->studentSubject) {
                            $subject_name = $t->studentSubject->subject_name;
                        }
                        ?>

                        <div class="card text-center mb-3" style="border-color:#253372;">
                            <input type="hidden" id="dateClass_id{{$i}}" value="{{$t->id}}">
                            <input type="hidden" id="txt_class_id{{$i}}" value="{{$t->class_id}}">
                            <input type="hidden" id="txt_class_name{{$i}}" value="{{$class_name}}">
                            <input type="hidden" id="txt_section_id{{$i}}" value="{{$section_name}}">
                            <input type="hidden" id="txt_from_timing{{$i}}" value="{{ date('h:i a',strtotime($t->from_timing))}}">
                            <input type="hidden" id="txt_subject_id{{$i}}" value="{{$t->subject_id}}">
                            <input type="hidden" id="txt_section_name{{$i}}" value="{{$section_name}}">
                            <input type="hidden" id="txt_subject_name{{$i}}" value="{{$subject_name}}">
                            <input type="hidden" id="txt_today_date{{$i}}" value="{{$todaysDate}}">
                            <input type="hidden" id="txt_teacher_id{{$i}}" value="{{$t->teacher_id}}">
                            <input type="hidden" id="txt_desc{{$i}}" value="{{$t->class_description}}">
                            <input type="hidden" id="txt_gMeetURL{{$i}}" value="{{$teacherData->g_meet_url}}">
                            <input type="hidden" id="txt_to_timing{{$i}}" value="{{ date('h:i a',strtotime($t->to_timing))}}">
                            <input type="hidden" id="txt_stdMessage{{$i}}" value="{{$t->class_student_msg}}">
                            <input type="hidden" id="g_class_id_{{$i}}" value="{{ $g_class_id}}" />
                            <div class="card-header text-white p-0   @if(date('H:i',strtotime($t->to_timing)) <= date('H:i')) bg-secondary @endif" style="background:#253372;">
                                <div class="container">


                                    <div class="row pl-2 pr-3">
                                        <div class="d-flex align-items-center col-md-4">
                                            <div class="cls-date font-weight-bold">{{ $todaysDate }}</div>
                                            <div class="cls-from pt-1">
                                                {{ date('h:i a',strtotime($t->from_timing))}} to {{ date('h:i a',strtotime($t->to_timing))}}</div>
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

                                            <div>
                                                @if($t->cancelled)
                                                <h2 class="btn btn-md bg-danger text-white mr-4 mb-0 font-weight-bold">Cancelled</h2>
                                                @else
                                                <button type="button" data-editModal="{{$i}}" class="btn mr-2 text-right  btn-md pb-0 mb-0 pt-1 border-0 text-white" title="Edit">
                                                    <svg class="icon mr-1">
                                                        <use xlink:href="../images/icons.svg#icon_edit"></use>
                                                    </svg>
                                                    Edit
                                                </button>
                                                @endif
                                                <button type="button" class="btn btn-collapse text-white collapse-btn " data-toggle="collapse" data-target="#collapseExample{{$t->id}}" aria-expanded="false" aria-controls="collapseExample{{$t->id}}"><i class="  @if((date('H:i',strtotime($t->from_timing))  <= date('H:i')) &(date('H:i') <= date('H:i',strtotime($t->to_timing))) )  fa fa-minus @else fas fa-plus  @endif "></i>
                                                </button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="collapse @if((date('H:i',strtotime($t->from_timing))  <= date('H:i')) &(date('H:i') <= date('H:i',strtotime($t->to_timing))) )   show @endif " id="collapseExample{{$t->id}}">
                                <div class="card-body p-0">
                                    <div class="row m-2">

                                        <div class="col-md-6 mt-1">
                                            <div class="row">
                                                <?php
                                                $chapters = \DB::select('select * from tbl_student_subjects s, tbl_cmslinks c where c.subject = s.id and c.subject=? and c.class = ?', [$t->subject_id, $cls]);
                                                ?>
                                                <div class="col-md-6">

                                                    <select class="form-control custom-select-sm border-0 btn-shadow chapter" id="chapter" name="chap" data-chapter="{{$i}}" @if($t->cancelled)disabled @endif>
                                                        <option value="Select Chapter">Select Chapter</option>
                                                        @if(count($chapters)>0)
                                                        @foreach($chapters as $ch)
                                                        <?php $selected = ($ch->id == $t->topic_id) ? 'selected' : ''; ?>
                                                        <option value="{{$ch->chapter}}" {{$selected}}>{{$ch->chapter}}</option>
                                                        @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php
                                                    $topics = \DB::select('select * from tbl_student_subjects s, tbl_cmslinks c where c.subject = s.id and c.subject=? and c.class = ?', [$t->subject_id, $cls]);

                                                    //if($t->subject_id == 2)
                                                    //  dd($topics);

                                                    //dd($topics);
                                                    //App\Http\Helpers\CustomHelper::getCMSTopics($t->class_id,$t->subject_id);
                                                    $x = $t->cmsLink;
                                                    ?>
                                                    <select class="form-control custom-select-sm border-0 btn-shadow" data-selecttopic="{{$t->id}}" id=chapterTopic{{$i}} @if($t->cancelled)disabled @endif>
                                                        <option value="">Select Topic</option>
                                                        @if(count($topics)>0)
                                                        @foreach($topics as $topic)
                                                        <?php $selected = ($topic->id == $t->topic_id) ? 'selected' : ''; ?>
                                                        <option value="{{$topic->id}}" {{$selected}} style="display:none">{{$topic->topic}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>

                                                </div>
                                                <div class="col-md-12">


                                                    <?php
                                                    $cms_link = '';
                                                    $youtube = '';
                                                    $academy = '';
                                                    $book = '';
                                                    $other = '';
                                                    if (strlen($x) > 0) {
                                                        $display_style = 'display: block;';
                                                        $cms_link = $x->link;
                                                        $youtube = $x->youtube;
                                                        $academy = $x->khan_academy;
                                                        $book    = $x->book_url;
                                                        $other   = $x->others;
                                                    } else
                                                        $display_style = 'display: none;';


                                                    if ($t->topic_id != '') {
                                                        //  $display_style = 'display: block;';
                                                    }
                                                    if ($t->cmsLink) {
                                                        // $cms_link = $t->cmsLink->link;
                                                    }


                                                    $cms_link = '';
                                                    if (strlen($x) > 0) {
                                                        $display_style = 'display: block;';
                                                        $cms_link = $x->link;
                                                    } else
                                                        $display_style = 'display: none;';

                                                    ?>
                                                    <!--new changes -->
                                                    <div class="m-auto mt-2 pt-2" id="icon{{$t->id}}">
                                                        <div class="row">

                                                            @if($cms_link!=null)
                                                            <div class="col-md-6 mt-2">
                                                                <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                                    <a href="javascript:void(0);" data-topiclink="{{ $cms_link  }}" data-topicid="{{$t->topic_id}}" class="col-9 btn btn-sm btn-outline-dark btn-shadow border-0 d-inline-flex d-none" id="viewcontent_{{$t->id}}" style="{{$display_style}}">
                                                                        <!-- Edport Content -->
                                                                        <!--img src="{{asset('images/logo-1.png')}}" class="m-1" alt="" width="25px" style="{{$display_style}}"-->
                                                                        <span class="m-auto font-weight-bolder">e-Edport</span>
                                                                    </a>
                                                                    <button class="col-3 btn btn-sm btn-outline-dark btn-shadow border-0" onclick="shareContent('{{$cms_link}}','{{$i}}')">
                                                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @endif

                                                            @if($academy!=null)
                                                            <div class="col-md-6 mt-2">
                                                                <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                                    <a href="javascript:void(0);" data-academylink="{{ $academy}}" data-topicid="{{$t->topic_id}}" id="academy_{{$t->id}}" class="col-9 btn btn-sm btn-outline-primary btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">

                                                                        <!-- My School -->
                                                                        @foreach ($schoollogo as $logo)
                                                                        @if($logo->item=="schoollogo")
                                                                        <!--img src="{{$logo->value}}" class="m-1" alt="logo" width="25px" style="{{$display_style}}"-->

                                                                        @endif
                                                                        @endforeach
                                                                        <span class="m-auto font-weight-bolder">Khan Academy</span>
                                                                    </a>

                                                                    <button class="col-3 btn btn-sm btn-outline-primary btn-shadow border-0" onclick="shareContent('{{$academy}}','{{$i}}')">
                                                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @if($youtube!=null)

                                                            <div class="col-md-6 mt-2">
                                                                <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                                    <a href="javascript:void(0);" data-youtubelink="{{ $youtube}}" data-topicid="{{$t->topic_id}}" id="youtube_{{$t->id}}" class="col-9 btn btn-sm btn-outline-danger btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">

                                                                        <!--i class="fa fa-youtube-play text-danger m-1 icon-4x" aria-hidden="true" style="{{$display_style}}"></!--i-->

                                                                        <span class="m-auto font-weight-bolder">YouTube</span>
                                                                    </a>

                                                                    <button class="col-3 btn btn-sm btn-outline-danger btn-shadow border-0" onclick="shareContent('{{$youtube}}','{{$i}}')">
                                                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @endif

                                                            @if($other!=null)
                                                            <div class="col-md-6 mt-2">
                                                                <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                                    <a href="javascript:void(0);" data-wikipedialink="{{ $other}}" data-topicid="{{$t->topic_id}}" id="wikipedia_{{$t->id}}" class="col-9 btn btn-sm btn-outline-secondary btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">

                                                                        <!--i class="fa fa-wikipedia-w  text-dark m-1 icon-4x" aria-hidden="true" style="{{$display_style}}"></!--i-->

                                                                        <span class="m-auto font-weight-bolder">Wikipedia</span>
                                                                    </a>

                                                                    <button class="col-3 btn btn-sm btn-outline-secondary btn-shadow border-0" onclick="shareContent('{{$other}}','{{$i}}')">
                                                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @endif

                                                            @if($book!=null)
                                                            <div class="col-md-6 mt-2">
                                                                <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                                    <a href="javascript:void(0);" data-book="{{ $book}}" data-topicid="{{$t->topic_id}}" id="book_{{$t->id}}" class="col-9 btn btn-sm btn-outline-primary btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">

                                                                        <span class="m-auto font-weight-bolder">Book</span>
                                                                    </a>

                                                                    <button class="col-3 btn btn-sm btn-outline-primary btn-shadow border-0" onclick="shareContent('{{$book}}','{{$i}}')">
                                                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @endif


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group text-editwrapper mt-1 mb-1">
                                                <textarea class="form-control text-edit1" rows="4" placeholder="Add a note" data-url="#" data-savedesc="{{$i}}" disabled contenteditable="true" id="class_description_{{$i}}" name="class_description">@if($t->class_description!=''){{$t->class_description}}@else{{$t->class_description}}@endif</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-1" style="background:#fff;">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <div class="m-auto">
                                            @if($t->cancelled)
                                            @else
                                            <a href="javascript:void(0);" data-LiveLink="{{ $teacherData->g_meet_url }}" id="live_c_link_{{$i}}" class="btn btn-md btn-outline-danger mb-1 mr-2 border-0 btn-shadow">
                                                <svg class="icon font-10 mr-1">
                                                    <use xlink:href="../images/icons.svg#icon_dot"></use>
                                                </svg>
                                                Join Live
                                            </a>
                                            <button type="button" data-toggle="modal" data-target="#viewStudentModal" data-id="view_student" data-view="{{$i}}" id="purchaseshowdivid" class="btn btn-md btn-outline-primary mb-1 border-0 btn-shadow" href="javascript:;" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View">View Students</button>
                                            @endif


                                            <a href="#" class="btn btn-md btn-outline-primary mb-1 mr-2 border-0 btn-shadow" data-notify="{{$i}}">
                                                <svg class="icon mr-1">
                                                    <use xlink:href="../images/icons.svg#icon_bell"></use>
                                                </svg>
                                                <span>Announcement</span>
                                            </a>
                                            <button type="button" data-classhelp="{{$i}}" class="btn btn-md btn-outline-primary mb-1 mr-2 border-0 btn-shadow" title="Help" data-id="help">
                                                <svg class="icon mr-1">
                                                    <use xlink:href="../images/icons.svg#icon_help"></use>
                                                </svg>
                                                Help
                                            </button>

                                        </div>

                                        <div class="m-auto">
                                            @if($t->cancelled)
                                            @else
                                            <a href=" #" class="btn btn-md btn-outline-primary mb-1 mr-2 border-0 btn-shadow" id="new_a_link_{{$i}}" data-createModal='{{$i}}' data-class_modal="{{$t->class_id}}" data-subject_modal="{{$t->subject_id}}" data-teacher_modal="{{$t->teacher_id}}">
                                                <svg class="icon font-12 mr-1">
                                                    <use xlink:href="../images/icons.svg#icon_plus"></use>
                                                </svg>
                                                New Assignment
                                            </a>
                                            @endif
                                            <?php
                                            $assignmentData = App\Http\Helpers\CommonHelper::get_assignment_data($t->id);
                                            ?>
                                            @if (count($assignmentData) > 0)
                                            <button onclick="viewAssignment({{$t->id}})" class="btn btn-md btn-outline-primary mb-1 mr-2 border-0 btn-shadow" data-toggle="modal" data-target="#exampleModalLong">View Assigment</button>
                                            @endif
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
                            No Record Found! <a href="{{ route('reload-timetable') }}" target="_self"> Click Here </a> to reload today's timetable.
                        </div>
                        @endif
                    </div>

                    <!-- ///////////////// -->
                    <!-- Past Live Classes -->
                    <!-- ///////////////// -->
                    <div class="tab-pane fade" id="plclasses">
                        @if(count($pastDates) > 0)
                        @php
                        $i=1;
                        @endphp

                        <div class="form-group col-md-5">
                            <select name="past_class" id="pastclassdata{{$i}}" style="margin-left: -14px;width:60%" class="form-control" onchange="viewPastClass({{$i}})">
                                <option value="">Select Date</option>
                                @foreach ($pastDates as $tt)
                                <option value="{{$tt->class_date}}">{{ date("D, d M", strtotime($tt->class_date))}}</option>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                            </select>
                        </div>
                        @endif
                        @if(count($pastClassData) > 0)

                        @php
                        $i=1;
                        $new= $i;
                        @endphp
                        @foreach ($pastClassData as $t)
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

                        <!-- <div id="plclasses1"> -->

                        <div class="card text-center mb-3" style="border-color:#253372;">

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
                                            <div>


                                                @if($t->cancelled)
                                                <h2 class="btn btn-md bg-danger text-white mr-4 mb-0 font-weight-bold">Cancelled</h2>
                                                @endif
                                                <button type="button" class="btn btn-collapse text-white collapse-btn" data-toggle="collapse" data-target="#collapseExample{{$t->id}}" aria-expanded="false" aria-controls="collapseExample{{$t->id}}"><i class=" fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse " id="collapseExample{{$t->id}}">
                                <div class="card-body p-0">
                                    <div class="row m-2">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <?php
                                                $chapters = \DB::select('select * from tbl_student_subjects s, tbl_cmslinks c where c.subject = s.id and c.subject=? and c.class = ?', [$t->subject_id, $cls]);
                                                ?>
                                                <div class="col-md-6">

                                                    <select class="form-control custom-select-sm border-0 btn-shadow chapter" id="chapter" name="chap" data-chapter="{{$i}}" disabled>
                                                        <option value="Select Chapter">Select Chapter</option>
                                                        @if(count($chapters)>0)
                                                        @foreach($chapters as $ch)
                                                        <?php $selected = ($ch->id == $t->topic_id) ? 'selected' : ''; ?>
                                                        <option value="{{$ch->chapter}}" {{$selected}}>{{$ch->chapter}}</option>
                                                        @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php
                                                    $topics = \DB::select('select * from tbl_student_subjects s, tbl_cmslinks c where c.subject = s.id and c.subject=? and c.class = ?', [$t->subject_id, $cls]);

                                                    //if($t->subject_id == 2)
                                                    //  dd($topics);

                                                    //dd($topics);
                                                    //App\Http\Helpers\CustomHelper::getCMSTopics($t->class_id,$t->subject_id);
                                                    $x = $t->cmsLink;
                                                    ?>
                                                    <select class="form-control custom-select-sm border-0 btn-shadow" data-selecttopic="{{$t->id}}" id="chapterTopic{{$i}}" disabled>
                                                        <option value="">Select Topic</option>
                                                        @if(count($topics)>0)
                                                        @foreach($topics as $topic)
                                                        <?php $selected = ($topic->id == $t->topic_id) ? 'selected' : ''; ?>
                                                        <option value="{{$topic->id}}" {{$selected}} style="display:none">{{$topic->topic}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                @if($t->cancelled)
                                                @else
                                                <div class="col-md-12">


                                                    <?php
                                                    $cms_link = '';
                                                    $youtube = '';
                                                    $academy = '';
                                                    $book = '';
                                                    $other = '';
                                                    if (strlen($x) > 0) {
                                                        $display_style = 'display: block;';
                                                        $cms_link = $x->link;
                                                        $youtube = $x->youtube;
                                                        $academy = $x->khan_academy;
                                                        $book    = $x->book_url;
                                                        $other   = $x->others;
                                                    } else
                                                        $display_style = 'display: none;';


                                                    if ($t->topic_id != '') {
                                                        //  $display_style = 'display: block;';
                                                    }
                                                    if ($t->cmsLink) {
                                                        // $cms_link = $t->cmsLink->link;
                                                    }


                                                    $cms_link = '';
                                                    if (strlen($x) > 0) {
                                                        $display_style = 'display: block;';
                                                        $cms_link = $x->link;
                                                    } else
                                                        $display_style = 'display: none;';

                                                    ?>
                                                    <!--new changes -->
                                                    <div class="m-auto mt-2 pt-2" id="icon{{$t->id}}">
                                                        <div class="row">

                                                            @if($cms_link!=null)
                                                            <div class="col-md-6 mt-2">
                                                                <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                                    <a href="javascript:void(0);" data-topiclink="{{ $cms_link  }}" data-topicid="{{$t->topic_id}}" class="col-9 btn btn-sm btn-outline-dark btn-shadow border-0 d-inline-flex d-none" id="viewcontent_{{$t->id}}" style="{{$display_style}}">
                                                                        <!-- Edport Content -->
                                                                        <!--img src="{{asset('images/logo-1.png')}}" class="m-1" alt="" width="25px" style="{{$display_style}}"-->
                                                                        <span class="m-auto font-weight-bolder">e-Edport</span>
                                                                    </a>
                                                                    <button class="col-3 btn btn-sm btn-outline-dark btn-shadow border-0" onclick="shareContent('{{$cms_link}}','{{$i}}')">
                                                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @endif

                                                            @if($academy!=null)
                                                            <div class="col-md-6 mt-2">
                                                                <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                                    <a href="javascript:void(0);" data-academylink="{{ $academy}}" data-topicid="{{$t->topic_id}}" id="academy_{{$t->id}}" class="col-9 btn btn-sm btn-outline-primary btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">

                                                                        <!-- My School -->
                                                                        @foreach ($schoollogo as $logo)
                                                                        @if($logo->item=="schoollogo")
                                                                        <!--img src="{{$logo->value}}" class="m-1" alt="logo" width="25px" style="{{$display_style}}"-->

                                                                        @endif
                                                                        @endforeach
                                                                        <span class="m-auto font-weight-bolder">Khan Academy</span>
                                                                    </a>

                                                                    <button class="col-3 btn btn-sm btn-outline-primary btn-shadow border-0" onclick="shareContent('{{$academy}}','{{$i}}')">
                                                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @if($youtube!=null)

                                                            <div class="col-md-6 mt-2">
                                                                <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                                    <a href="javascript:void(0);" data-youtubelink="{{ $youtube}}" data-topicid="{{$t->topic_id}}" id="youtube_{{$t->id}}" class="col-9 btn btn-sm btn-outline-danger btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">

                                                                        <!--i class="fa fa-youtube-play text-danger m-1 icon-4x" aria-hidden="true" style="{{$display_style}}"></!--i-->

                                                                        <span class="m-auto font-weight-bolder">YouTube</span>
                                                                    </a>

                                                                    <button class="col-3 btn btn-sm btn-outline-danger btn-shadow border-0" onclick="shareContent('{{$youtube}}','{{$i}}')">
                                                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @endif

                                                            @if($other!=null)
                                                            <div class="col-md-6 mt-2">
                                                                <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                                    <a href="javascript:void(0);" data-wikipedialink="{{ $other}}" data-topicid="{{$t->topic_id}}" id="wikipedia_{{$t->id}}" class="col-9 btn btn-sm btn-outline-secondary btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">

                                                                        <!--i class="fa fa-wikipedia-w  text-dark m-1 icon-4x" aria-hidden="true" style="{{$display_style}}"></!--i-->

                                                                        <span class="m-auto font-weight-bolder">Wikipedia</span>
                                                                    </a>

                                                                    <button class="col-3 btn btn-sm btn-outline-secondary btn-shadow border-0" onclick="shareContent('{{$other}}','{{$i}}')">
                                                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @endif

                                                            @if($book!=null)
                                                            <div class="col-md-6 mt-2">
                                                                <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                                    <a href="javascript:void(0);" data-book="{{ $book}}" data-topicid="{{$t->topic_id}}" id="book_{{$t->id}}" class="col-9 btn btn-sm btn-outline-primary btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">

                                                                        <span class="m-auto font-weight-bolder">Book</span>
                                                                    </a>

                                                                    <button class="col-3 btn btn-sm btn-outline-primary btn-shadow border-0" onclick="shareContent('{{$book}}','{{$i}}')">
                                                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @endif


                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-1">


                                            <div class=" mt-1 mb-1">
                                                <textarea class="form-control " style="resize: none;" rows="4" placeholder="empty Notes !" disabled name="class_description">@if($t->class_description!=''){{$t->class_description}}@else{{$t->class_description}}@endif</textarea>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                @if($t->cancelled)
                                @else
                                <div class="card-footer p-1" style="background:#fff;">
                                    <div class="d-flex justify-content-between flex-wrap">

                                        <div class="m-auto">
                                            <button type="button" data-toggle="modal" data-target="#viewStudentModal" data-id="view_student" data-view="{{$i}}" id="purchaseshowdivid" class="btn btn-md btn-outline-primary mb-1 border-0 btn-shadow" href="javascript:;" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View">View Students</button>
                                            <?php
                                            $assignmentData = App\Http\Helpers\CommonHelper::get_assignment_data($t->id);
                                            ?>
                                            @if (count($assignmentData) > 0)
                                            <button onclick="viewAssignment({{$t->id}})" class="btn btn-md btn-outline-primary ml-2 mb-1 mr-2 border-0 btn-shadow" data-toggle="modal" data-target="#exampleModalLong">View Assigment</button>


                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- </div> -->
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
                    </div>



                    <!-- ///////////////// -->
                    <!-- Past Live Classes End -->
                    <!-- ///////////////// -->


                    <!-- ///////////////// -->
                    <!-- Upcoming  Classes -->
                    <!-- ///////////////// -->
                    <div class="tab-pane fade" id="upcomingclasses">

                        @if(count($futureDates) > 0)
                        @php
                        $i=1;
                        @endphp

                        <ul class="nav justify-content-center">
                            @foreach ($futureDates as $tt)
                            <input type="hidden" id="futureclassdata{{$i}}" value="{{$tt->class_date}}">
                            <li class="nav-item" onclick="viewFutureClass({{$i}})">
                                <a class="nav-link  btn btn-sm text-white mr-2 mb-3 active1 " href="#"> {{ date("D, d M", strtotime($tt->class_date))}}</a>
                            </li>
                            @php
                            $i++;
                            @endphp
                            @endforeach
                        </ul>
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



                            <div class="card text-center mb-3" style="border-color:#253372;">

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

                        <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
                            <svg class="icon icon-4x mr-3">
                                <use xlink:href="../images/icons.svg#icon_nodate"></use>
                            </svg>
                            No Record Found!
                        </div>
                        @endif
                    </div>


                    <!---
                        Invitation
                         -->
                    <div class="tab-pane fade" id="newInvitationclasses">

                        <div class="col-sm-12">
                            <?php if (count($inviteClassData) > 0) { ?>
                                <table id="teacherlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Class</th>
                                            <th>Section</th>
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
                                                <td>{{++$i}}</td>
                                                <td>{{ $cls }} Std</td>
                                                <td>{{ $section_name }}</td>
                                                <td>{{ $subject_name }}</td>
                                                <td><a href="javascript:void(0);" data-INVLiveLink="{{ $g_link.'/gb' }}" id="Inv_live_c_link_{{$i}}" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
                                                        <svg class="icon font-10 mr-1">
                                                            <use xlink:href="../images/icons.svg#icon_dot"></use>
                                                        </svg>
                                                        Check Submissions
                                                    </a></td>
                                            </tr>


                                        <?php
                                        }
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
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <!-- ./Teacher-AssignedClasses -->

                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="viewStudentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="purchaseshowdatadiv"></div>
    </div>
</div>


<!-- New Assignment Modal -->
<div class="modal fade" id="createAssiModal" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold">New Assignment </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-4">
                <div class="form-group row">
                </div>
                <input type="hidden" id="row_id" value="">
                <input type="hidden" id="new_assignment" value="">
                <input type="hidden" id="g_class_id" value="">
                <input type="hidden" id="ass_class_id" value="">
                <input type="hidden" id="ass_subject_id" value="">
                <input type="hidden" id="ass_teacher_id" value="">
                <div class="row">
                    <div class="form-group col-md-5">
                        <input checked type="radio" id="t1radio" name="asgradio">
                        <label for="t1radio" class="col-form-label text-md-left">Select Topic :</label>
                        <div>
                            <select name="sel_topic" id="sel_topic" class="form-control asg1">
                                <option value="">Select Topic</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        OR
                    </div>
                    <div class="form-group col-md-5">
                        <input type="radio" id="t2radio" name="asgradio">
                        <label for="t2radio" class="col-form-label text-md-left">Enter New Topic
                            :</label>
                        <div>
                            <input disabled type="text" id="txt_topin_name" class="form-control asg2" placeholder="Topic Name" />
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txt_aTitle" class="col-form-label text-md-left"> Assignment Title:</label>
                        <div>
                            <input type="text" class="form-control" name="txt_aTitle" id="txt_aTitle" placeholder="Assigment Title">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txt_aTitle" class="col-form-label text-md-left"> Assignment Instruction:</label>
                        <div>
                            <textarea class="form-control" name="txt_description" id="txt_description" placeholder="Assignment Instruction"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txt_aTitle" class="col-form-label text-md-left"> Due Date:</label>
                        <div>
                            <input type="date" class="form-control" name="txt_due_date" id="txt_due_date" placeholder="Due Date">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txt_aTitle" class="col-form-label text-md-left"> Due Time:</label>
                        <div>
                            <input type="text" class="form-control due-time" name="txt_due_time" id="txt_due_time" placeholder="Due Time">
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="txt_aTitle" class="col-form-label text-md-left"> Point:</label>
                        <div>
                            <input type="number" class="form-control" name="txt_point" id="txt_point" placeholder="Point">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12" style="text-align: center;">
                        <button type="button" id="assignment_create" class="btn btn-primary px-4">Create</button>
                        <button type="button" id="attach_file" class="btn btn-primary px-4">Create and Attach File</button>
                        <button type="button" id="cancel_assignment" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                <p style="font-size: smaller;color: red;text-align: center;">Note: Please allow popup for the assignment functionality.</p>
            </div>
        </div>
    </div>
</div>
<!-- ./New Assignment Modal -->
<div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold">View Assignment </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-4">


                <table id="assignmentList" class="table table-hover btn-shadow table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                    <thead class="text-white" style="background:#253372;">
                        <tr>

                            <th>Assignment Name</th>
                            <th>Link</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>



            </div>
        </div>
    </div>
</div>
<!-- ./View Assignment Modal -->

<!-- Class Box Help Modal -->
<div class="modal fade" id="classhelpModal" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light d-flex align-items-center">
                <h5 class="modal-title font-weight-bold">Help Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg class="icon">
                        <use xlink:href="../images/icons.svg#icon_times2"></use>
                    </svg>
                </button>
            </div>
            <div class="modal-body pt-4">
                <form>
                    <div class="form-group">
                        <select name="help_ticket_category" class="form-control" required>
                            <option value="">Please select a category</option>


                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" value="" rows="5" placeholder="Write help message..." required="required"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary px-4">
                            <svg class="icon mr-2">
                                <use xlink:href="../images/icons.svg#icon_send"></use>
                            </svg>
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Add Class Modal -->
<div class="modal fade" id="addClassModal" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light d-flex align-items-center">
                <h5 class="modal-title font-weight-bold">Add Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg class="icon">
                        <use xlink:href="../images/icons.svg#icon_times2"></use>
                    </svg>
                </button>
            </div>
            <div class="modal-body pt-4">

                {!! Form::open(array('route' => ['add.class'],'method'=>'POST','autocomplete'=>'off','id'=>'frm_add_class')) !!}
                <div class="form-group row">
                    <label for="addinputDate" class="col-md-4 col-form-label text-md-right">Date:</label>
                    <div class="col-md-6">
                        {!! Form::text('class_date', null, array('id'=>'addClassDate','placeholder' => 'DD/MM/YYYY','class' => 'form-control ac-datepicker','required'=>'required',"onkeydown"=>"return false;")) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="addinputFtime" class="col-md-4 col-form-label text-md-right">Class From
                        Time:</label>
                    <div class="col-md-6">
                        {!! Form::text('start_time', null, array('id'=>'addClassStartTime','placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required',"onkeydown"=>"return false;")) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="addinputTtime" class="col-md-4 col-form-label text-md-right">Class To Time:</label>
                    <div class="col-md-6">
                        {!! Form::text('end_time', null, array('id'=>'addClassEndTime','placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required',"onkeydown"=>"return false;")) !!}
                    </div>
                </div>
            </div>



            <div class="form-group row">
                <label class="col-md-12 text-danger text-center" style="font-size: 12px;padding-left: 130px;">*Extra
                    classes for regular assigned classes can be created here</label>
                <label for="addclassChoose" class="col-md-4 col-form-label text-md-right">Class:</label>
                <div class="col-md-6">
                    <select name="class_id" id="class_id" class="form-control" required>
                        <option value=""> Select Class</option>
                        <?php
                        foreach ($data['classData'] as $row) {
                        ?>

                            <option value="<?= $row->id; ?>"> <?= 'Class ' . $row->class_name . ' - ' . $row->section_name . ' - ' . $row->subject_name; ?></option>
                        <?php
                        }
                        ?>
                    </select>

                </div>
            </div>


            <!-- <div class="form-group row">
                <label for="class_liveurl" class="col-md-4 col-form-label text-md-right">Join Live <small>(Link)</small>:</label>
                <div class="col-md-6">
                  {!! Form::textarea('join_liveUrl', null, array('placeholder' => 'Enter Live class url','class' => 'form-control','required'=>'required','rows'=>'3')) !!}
                        </div>
                      </div> -->

            <div class="form-group row">
                <label for="inputNotifystd" class="col-md-4 col-form-label text-md-right">Notify
                    Students:</label>
                <div class="col-md-6">

                    {!! Form::textarea('notify_stdMessage', null, array('placeholder' => 'Enter Notify Message','class' => 'form-control','required'=>'required','rows'=>'3')) !!}

                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" id="submit" class="btn btn-primary px-4">Save Class</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End -->

<!-- Edit Class Modal -->
<div class="modal fade" id="editClassModal" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light d-flex align-items-center">
                <h5 class="modal-title font-weight-bold">Edit Class Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg class="icon">
                        <use xlink:href="../images/icons.svg#icon_times2"></use>
                    </svg>
                </button>
            </div>
            <div class="modal-body pt-4">

                {!! Form::open(array('route' => ['edit.class'],'method'=>'POST','autocomplete'=>'off','id'=>'frm_class_edit')) !!}


                <input type="hidden" id="txt_datecalss_id" value="" name="txt_datecalss_id" />
                <input type="hidden" id="txt_g_class_id" value="" name="txt_g_class_id" />
                <input type="hidden" id="class_name" value="" name="class_name" />
                <input type="hidden" id="section_name" value="" name="section_name" />
                <input type="hidden" id="class_date" value="" name="class_date" />




                <!-- <div class="form-group row">
                    <label for="inputDesc" class="col-md-4 col-form-label text-md-right">Description:</label>
                    <div class="col-md-6">
                        {!! Form::textarea('edit_description', null, array('id'=>'edit_description','placeholder' => 'Class Description','class' => 'form-control','required'=>'required','rows'=>'3')) !!}
                    </div>
                </div> -->

                <!-- <div class="form-group row">
                    <label for="inputNotifystd" class="col-md-4 col-form-label text-md-right">Notify
                        Students:</label>
                    <div class="col-md-6">

                        {!! Form::textarea('edit_notify_stdMessage', null, array('id'=>'edit_notify_stdMessage','placeholder' => 'Enter Notify Message','class' => 'form-control','required'=>'required','rows'=>'3')) !!}

                    </div>
                </div> -->

                <div class="form-group row">
                    <label for="class_liveurl" class="col-md-4 col-form-label text-md-right">Start Time:
                    </label>
                    <div class="col-md-6">
                        {!! Form::text('start_time', $teacherData->from_timing, array('id'=>'from_timing','placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required',"onkeydown"=>"return false;")) !!}
                    </div>

                </div>

                <div class="form-group row">
                    <label for="class_liveurl" class="col-md-4 col-form-label text-md-right">End Time:
                    </label>
                    <div class="col-md-6">
                        {!! Form::text('end_time', $teacherData->to_timing, array('id'=>'end_timing','placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required',"onkeydown"=>"return false;")) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="class_liveurl" class="col-md-4 col-form-label text-md-right">Join Live
                        <small>(Link)</small>:</label>
                    <div class="col-md-6">
                        {!! Form::text('edit_join_liveUrl',$teacherData->g_meet_url, array('id'=>'edit_join_liveUrl','placeholder' => 'Enter Live class url','class' => 'form-control','readonly' )) !!}

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary px-4">Save Class</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End -->




<div class="modal fade" id="notifyModal" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light d-flex align-items-center">
                <h5 class="modal-title font-weight-bold">Notify Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg class="icon">
                        <use xlink:href="../images/icons.svg#icon_times2"></use>
                    </svg>
                </button>
            </div>
            <div class="modal-body pt-4">

                {!! Form::open(array('route' => ['student-notify'],'method'=>'POST','autocomplete'=>'off','id'=>'frm_class_notify')) !!}


                <input type="hidden" id="date_class_id" value="" name="dateClass_id" />
                <input type="hidden" id="data_subject_id" value="" name="subject_id" />
                <input type="hidden" id="data_class_id" value="" name="class_id" />
                <input type="hidden" id="data_gmeet_url" value="" name="gmeet_url" />
                <input type="hidden" id="data_from_timing" value="data_from_timing" />
                <input type="hidden" id="data_cancelled" name="cancelled" value="0" />

                <div class="container-fluid">

                    <div class="form-group row">
                        <div class="col-md-3 col-lg-3 col-3 pl-5 mt-4">
                            <div class="row mb-3">

                                <div class="btn btn-md btn-primary pl-3 pr-4 active" id="notify">
                                    Class Invitation
                                </div>
                            </div>
                            <div class="row mb-3">

                                <div class="btn btn-md btn-primary " id="cancel">
                                    Class Cancellation
                                </div>
                            </div>
                            <div class="row">
                                <div class="btn btn-xs btn-primary pl-5 pr-5" id="custom">
                                    Custom
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-lg-9 col-9">
                            <!-- <label for="class_liveurl" class="col-md-4 col-form-label text-md-right">Notify student
                            </label> -->
                            <div class="mt-5">
                                {!! Form::textarea('notificationMsg', null, array('id'=>'notificationMsg','placeholder' => 'Notify Students','class' => 'form-control','required'=>'required','rows'=>'3')) !!}


                            </div>
                            <div class="form-group  mt-3 ml-5 ">

                                <button type="submit" class="btn btn-primary px-4 mr-2">Notify</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                            </div>
                        </div>

                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Past Edit Class Modal -->
<div class="modal fade" id="pasteditClassModal" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light d-flex align-items-center">
                <h5 class="modal-title font-weight-bold">Edit Past Class Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg class="icon">
                        <use xlink:href="../images/icons.svg#icon_times2"></use>
                    </svg>
                </button>
            </div>
            <div class="modal-body pt-4">

                <form>

                    <input type="hidden" id="txt_past_datecalss_id" value="" name="txt_past_datecalss_id" />
                    <input type="hidden" id="txt_boxID" value="" name="txt_boxID" />

                    <!-- <div class="form-group row">
                        <label for="inputDesc" class="col-md-4 col-form-label text-md-right">Description:</label>
                        <div class="col-md-6">
                            {!! Form::textarea('past_edit_description', null, array('id'=>'past_edit_description','placeholder' => 'Class Description','class' => 'form-control','required'=>'required','rows'=>'3')) !!}
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="class_liveurl" class="col-md-4 col-form-label text-md-right"> Recording URL
                            <small>(Link)</small>:</label>
                        <div class="col-md-6">
                            {!! Form::textarea('past_edit_rec_liveUrl', null, array('id'=>'past_edit_rec_liveUrl','placeholder' => 'Enter Recording Live url','class' => 'form-control','required'=>'required','rows'=>'3')) !!}

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <button type="button" id="update_pastClass" class="btn btn-primary px-4">Save Class
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End -->

<!-- Edit Class Modal -->

<!-- End -->



<script>
    $('.btn-collapse').click(function() {
        $(this).find('i').toggleClass('fas fa-minus');
        $(this).find('i').toggleClass('fas fa-plus');
        //$(this).find('i').toggle(function(){});
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ac-datepicker').datepicker({
            dateFormat: 'd M yy',
            minDate: 0,
        });
        $('.ac-time').timepicker({
            controlType: 'select',
            oneLine: true,
            timeFormat: 'hh:mm tt'
        });

        $('.due-time').timepicker({
            controlType: 'select',
            oneLine: true,
            timeFormat: 'hh:mm tt'
        });
    });

    $('#submit').click(function() {
        var valuestart = $("#addClassStartTime").val();
        var valueend = $("#addClassEndTime").val();
        var timeStart = new Date("01/01/2007 " + valuestart);
        var timeEnd = new Date("01/01/2007 " + valueend);

        var diff = (timeEnd - timeStart) / 60000; //dividing by seconds and milliseconds
        var minutes = diff % 60;
        var hours = (diff - minutes) / 60;
        if (timeStart >= timeEnd) {
            var response = confirm("Class end-time can't be before/equal to class start-time.");
        } else {
            var response = confirm("You have set class duration of " + hours + " hours and " + minutes + " minute");
        }
        if (response) {
            $('#frm_add_class').unbind('submit').submit();
        } else {
            $('#frm_add_class').submit(function() {
                return false;
            });
        }
    });

    $(document).on('click', '[data-LiveLink]', function() {
        var liveurl = $(this).attr("data-LiveLink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "_blank"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No Join link found!');
        }
    });
    $(document).on('change', '[data-AssLiveLink]', function() {
        var liveurl = $(this).val();
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No assignement url found!');
        }
    });
    $(document).on('click', '[data-topiclink]', function() {
        var liveurl = $(this).attr("data-topiclink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "_blank"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No content url found!');
        }
    });

    $(document).on('click', '[data-youtubelink]', function() {
        var liveurl = $(this).attr("data-youtubelink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "_blank"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No content url found!');
        }
    });

    $(document).on('click', '[data-wikipedialink]', function() {
        var liveurl = $(this).attr("data-wikipedialink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "_blank"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No content url found!');
        }
    });

    $(document).on('click', '[data-academylink]', function() {
        var liveurl = $(this).attr("data-academylink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "_blank"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No content url found!');
        }
    });

    $(document).on('click', '[data-book]', function() {
        var liveurl = $(this).attr("data-book");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "_blank"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No content url found!');
        }
    });
    /*
    past calsses
    */
    $(document).on('click', '[data-pastLiveLink]', function() {
        var liveurl = $(this).attr("data-pastLiveLink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No Video recording found!');
        }
    });
    $(document).on('click', '[data-pasttopiclink]', function() {
        var liveurl = $(this).attr("data-pasttopiclink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "dialog name"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No content url found!');
        }
    });
    $(document).on('click', '[data-futuretopiclink]', function() {
        var liveurl = $(this).attr("data-futuretopiclink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "dialog name"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No content url found!');
        }
    });
    $(document).on('change', '[data-passAssLiveLink]', function() {
        var liveurl = $(this).val();
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No assignement url found!');
        }
    });
    $(document).on('click', '[data-pasteditModal]', function() {
        var val = $(this).data('pasteditmodal');
        $('#pasteditClassModal').modal('show');
        $("#past_edit_description").val($("#past_desc" + val).val());
        $("#past_edit_rec_liveUrl").val($("#past_recURL" + val).val());
        $("#txt_past_datecalss_id").val($("#pastdateClass_id" + val).val());
        $("#txt_boxID").val(val);
    });
    $(document).on('click', '#update_pastClass', (function() {
        var id = $("#txt_boxID").val();
        var rec_url = $('#past_edit_rec_liveUrl').val();
        var desc = $('#past_edit_description').val();
        var dateClass_id = $("#txt_past_datecalss_id").val();
        $('.loader').show();
        $.ajax({
            url: "{{url('edit-past-class')}}",
            type: "POST",
            data: {
                rec_url: rec_url,
                description: desc,
                dateClass_id: dateClass_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, response.message);
                    $('#pasteditClassModal').modal('hide');
                    $('#past_live_c_link_' + id).attr('data-pastLiveLink', response.rec_url);
                    $("#past_desc" + id).val(desc);
                    $("#past_recURL" + id).val(response.rec_url);
                    //window.open(response.cource_url,"title","dialogWidth:400px;dialogHeight:300px");
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            }
        });
    }));
    /* past classess end  */
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
    $(document).on('click', '[data-createModal]', function() {
        var id = $(this).data('createmodal');
        $('#new_assignment').val($("#dateClass_id" + id).val());
        $("#row_id").val(id);
        $('#g_class_id').val($('#g_class_id_' + id).val());
        $("#ass_class_id").val($('#txt_class_id' + id).val());
        $("#ass_subject_id").val($('#txt_subject_id' + id).val());
        $("#ass_teacher_id").val($('#txt_teacher_id' + id).val());
        var class_id = $('[data-createmodal="' + id + '"]').data('class_modal');
        var subject_id = $('[data-createmodal="' + id + '"]').data('subject_modal');
        //var teacher_id = $('[data-createmodal="'+id+'"]').data('teacher_modal');
        /* console.log(id);
            console.log(class_id);
           console.log(subject_id);
           exit; */
        $("#txt_aTitle").val('');
        $("#txt_topin_name").val('');
        $('#createAssiModal').modal('show');
        $('.loader').show();
        $.ajax({
            url: "{{url('get-assignment')}}",
            type: "POST",
            data: {
                class_id: class_id,
                subject_id: subject_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    var AssigmentData = response.data;
                    var topics = response.topics;
                    var data = '';
                    var topicData = '<option value="">Select Topic</option>';
                    AssigmentData.forEach(function(val) {
                        data += '<li> <a href="javascript:void(0);" onclick="give_assignment(\'' + id + '\',\'' + val.g_live_link + '\',\'' + val.id + '\',\'' + val.g_title + '\')" >' + val.g_title + '</a>';
                        data += ' ( <a  href="javascript:void(0);" data-viewAssignment="' + val.g_live_link + '" > View </a>) </li>';
                    });
                    topics.forEach(function(val) {
                        topicData += '<option value="' + val.id + '">' + val.topicname + '</option>';
                    });
                    $("#sel_topic").html('');
                    $("#sel_topic").append(topicData);
                    $("#li_assignment").html('');
                    $("#li_assignment").append(data);
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            }
        });
    });

    function give_assignment(id, link, classwork_id, title) {
        ///console.log(id);
        //console.log(link);
        var dateClass_id = $('#new_assignment').val();
        //var class_id = $('[data-createmodal="'+id+'"]').data('class_modal');
        //var subject_id = $('[data-createmodal="'+id+'"]').data('subject_modal');
        $('.loader').show();
        $.ajax({
            url: "{{url('give-assignment')}}",
            type: "POST",
            data: {
                dateClass_id: dateClass_id,
                classwork_id: classwork_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                ///  console.log(result);
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    //$('#new_a_link_'+edit_assignment).attr('href',new_assignment_url);
                    var data = '<option value="' + link + '">' + title + '</option>';
                    $('#view_a_link_' + id).append(data);
                    $.fn.notifyMe('success', 5, response.message);
                    $('#createAssiModal').modal('hide');
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            }
        });
    }
    $(document).on('click', '#assignment_create', (function() {
        $('#assignment_create').prop('disabled', true);
        $('#attach_file').prop('disabled', true);
        $('#cancel_assignment').prop('disabled', true);
        var id = $("#row_id").val();
        var class_id = $('#ass_class_id').val();
        var subject_id = $('#ass_subject_id').val();
        var teacher_id = $('#ass_teacher_id').val();
        //var timing_id = $('[data-createmodal="'+id+'"]').data('timing_modal');
        var g_class_id = $('#g_class_id').val();
        var txt_topic_name = $('#txt_topin_name').val();
        var sel_topic_name = $('#sel_topic').val();
        var assignment_title = $('#txt_aTitle').val();
        var description = $('#txt_description').val();
        var dueDate = $('#txt_due_date').val();
        var dueTime = $('#txt_due_time').val();
        var point = $('#txt_point').val();
        var dateClass_id = $('#new_assignment').val();
        $('.loader').show();
        $.ajax({
            url: "{{url('create-assignment')}}",
            type: "POST",
            data: {
                g_class_id: g_class_id,
                txt_topic_name: txt_topic_name,
                sel_topic_name: sel_topic_name,
                assignment_title: assignment_title,
                class_id: class_id,
                subject_id: subject_id,
                teacher_id: teacher_id,
                dateClass_id: dateClass_id,
                description: description,
                dueDate: dueDate,
                dueTime: dueTime,
                point: point

            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, response.message);
                    $('#createAssiModal').modal('hide');
                    var data = '<option value="' + response.cource_url + '">' + assignment_title + '</option>';
                    $('#view_a_link_' + id).append(data);
                    $('#assignment_create').prop('disabled', false);
                    $('#attach_file').prop('disabled', false);
                    $('#cancel_assignment').prop('disabled', false);
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                    $('#assignment_create').prop('disabled', false);
                    $('#attach_file').prop('disabled', false);
                    $('#cancel_assignment').prop('disabled', false);
                }
            }
        });
    }));
    $(document).on('click', '#attach_file', (function() {
        $('#assignment_create').prop('disabled', true);
        $('#attach_file').prop('disabled', true);
        $('#cancel_assignment').prop('disabled', true);
        var id = $("#row_id").val();
        var class_id = $('#ass_class_id').val();
        var subject_id = $('#ass_subject_id').val();
        var teacher_id = $('#ass_teacher_id').val();
        //var timing_id = $('[data-createmodal="'+id+'"]').data('timing_modal');
        var g_class_id = $('#g_class_id').val();
        var txt_topic_name = $('#txt_topin_name').val();
        var sel_topic_name = $('#sel_topic').val();
        var assignment_title = $('#txt_aTitle').val();
        var description = $('#txt_description').val();
        var dueDate = $('#txt_due_date').val();
        var dueTime = $('#txt_due_time').val();
        var point = $('#txt_point').val();
        var dateClass_id = $('#new_assignment').val();
        $('.loader').show();
        $.ajax({
            url: "{{url('create-assignment')}}",
            type: "POST",
            data: {
                g_class_id: g_class_id,
                txt_topic_name: txt_topic_name,
                sel_topic_name: sel_topic_name,
                assignment_title: assignment_title,
                class_id: class_id,
                subject_id: subject_id,
                teacher_id: teacher_id,
                dateClass_id: dateClass_id,
                description: description,
                dueDate: dueDate,
                dueTime: dueTime,
                point: point

            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, response.message);
                    $('#createAssiModal').modal('hide');
                    window.open(response.cource_url, "title", "dialogWidth:400px;dialogHeight:300px");
                    var data = '<option value="' + response.cource_url + '">' + assignment_title + '</option>';
                    $('#view_a_link_' + id).append(data);
                    $('#assignment_create').prop('disabled', false);
                    $('#attach_file').prop('disabled', false);
                    $('#cancel_assignment').prop('disabled', false);
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                    $('#assignment_create').prop('disabled', false);
                    $('#attach_file').prop('disabled', false);
                    $('#cancel_assignment').prop('disabled', false);
                }
            }
        });
    }));
    $(document).on('change', '[data-selecttopic]', function() {
        var getid = $(this).attr('data-selecttopic');
        if ($(this).val() != '') {
            $('#icon' + getid).show();
            var topic_id = $(this).val();
            var dateWork_id = getid;
            if (dateWork_id != '') {
                $('.loader').show();
                $.ajax({
                    type: 'POST',
                    url: '{{ route("classtopic.update") }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': dateWork_id,
                        'topic_id': topic_id
                    },
                    success: function(result) {
                        $('.loader').fadeOut();
                        var response = JSON.parse(result);
                        location.reload(true);
                        if (response.youtube_link != null) {
                            $('#youtube_' + dateWork_id).attr('style', 'display:block');
                            $('#youtube_' + dateWork_id).attr('data-youtubelink', response.youtube_link);
                        }

                        if (response.wikipedia_link != null) {
                            $('#wikipedia_' + dateWork_id).attr('style', 'display:block');
                            $('#wikipedia_' + dateWork_id).attr('data-wikipedialink', response.wikipedia_link);
                        }

                        if (response.academy_link != null) {
                            $('#academy_' + dateWork_id).attr('style', 'display:block');
                            $('#academy_' + dateWork_id).attr('data-academylink', response.academy_link);
                        }

                        if (response.book_url != null) {
                            $('#book_' + dateWork_id).attr('style', 'display:block');
                            $('#book_' + dateWork_id).attr('data-book', response.book_url);
                        }
                        $.fn.notifyMe('success', 4, response.message);
                    },
                    error: function() {
                        $('.loader').fadeOut();
                        $.fn.notifyMe('error', 4, 'There is some error while saving description text!');
                    }
                });
            }
        } else {
            $('#icon' + getid).hide();
        }
    });
    /*help ajax */
    $('[data-id=help]').click(function() {
        var getBoxId = $(this).attr("data-classhelp");
        var dateClass_id = $("#dateClass_id" + getBoxId).val();
        var class_id = $("#txt_class_id" + getBoxId).val();
        var subject_id = $("#txt_subject_id" + getBoxId).val();
        var description = $('#class_description_' + getBoxId).text();
        var joinlive = $('#live_c_link_' + getBoxId).attr('data-LiveLink');
        var help_type = 2;
        $('.loader').show();
        $.ajax({
            url: "{{route('teacher.generate_ticket')}}",
            type: "POST",
            data: {
                class_id: class_id,
                subject_id: subject_id,
                help_type: help_type,
                description: description,
                joinlive: joinlive,
                dateClass_id: dateClass_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, response.message);
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            },
            error: function(error_r) {
                $('.loader').fadeOut();
                var obj = JSON.parse(error_r.responseText);
                $.each(obj.errors, function(key, value) {
                    $.fn.notifyMe('error', 5, value);
                });
            }
        });
    });

    $(document).on('click', '[data-editModal]', function() {
        var val = $(this).data('editmodal');
        $('#editClassModal').modal('show');
        //$("#edit_description").val($("#txt_desc" + val).val());
        $("#from_timing").val($("#txt_from_timing" + val).val());
        $("#end_timing").val($("#txt_to_timing" + val).val());
        $("#edit_join_liveUrl").val($("#txt_gMeetURL" + val).val());
        //$("#edit_notify_stdMessage").val($("#txt_stdMessage" + val).val());
        $("#txt_datecalss_id").val($("#dateClass_id" + val).val());
        $("#txt_g_class_id").val($("#g_class_id_" + val).val());
        $("#class_name").val($("#txt_class_name" + val).val());
        $("#section_name").val($("#txt_section_name" + val).val());
        $("#class_date").val($("#txt_today_date" + val).val());

    });



    // $("#purchaseshowdivid").click(function() {
    $('[data-id=view_student]').click(function() {
        $('#purchaseshowdatadiv').hide();
        var getBoxId = $(this).attr("data-view");
        var class_name = $("#txt_class_name" + getBoxId).val();
        var section_id = $("#txt_section_id" + getBoxId).val();
        var dateclass_id = $('#dateClass_id' + getBoxId).val();
        $.ajax({
            url: '{{ url("/teacher/getStudent") }}',
            type: "GET",
            data: {
                txt_class_name: class_name,
                txt_section_id: section_id,
                dateclass_id: dateclass_id
            },
            success: function(result) {

                $('#purchaseshowdatadiv').html(result);
                $('#purchaseshowdatadiv').show();

            }

        });
    });

    $("#frm_class_edit").on('submit', (function(e) {
        // e.preventDefault();
        var dateClass_id = $("#txt_datecalss_id").val();
        var description = $("#edit_description").val();
        var join_liveUrl = $("#edit_join_liveUrl").val();
        var notify_stdMessage = $("#edit_notify_stdMessage").val();
        $('.loader').show();
        $.ajax({
            url: "{{url('edit-live-class')}}",
            type: "POST",
            data: {
                dateClass_id: dateClass_id,
                description: description,
                join_liveUrl: join_liveUrl,
                notify_stdMessage: notify_stdMessage
            },
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                //console.log(response.data);
                if (response.status == 'success') {
                    $("#liveurl_" + dateClass_id).attr("data-livelink", join_liveUrl);
                    $('#editClassModal').modal('hide');
                    $.fn.notifyMe('success', 5, response.message);
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            },
            error: function(error_r) {
                $('.loader').fadeOut();
                var obj = JSON.parse(error_r.responseText);
                console.log(obj);
                $.each(obj.errors, function(key, value) {
                    $.fn.notifyMe('error', 5, value);
                });
            }
        });
    }));




    $(document).on('click', '[data-notify]', function() {
        var val = $(this).data('notify');
        $('#notifyModal').modal('show');
        $("#date_class_id").val($("#dateClass_id" + val).val());
        $("#data_subject_id").val($("#txt_subject_id" + val).val());
        $("#data_class_id").val($("#txt_class_id" + val).val());
        $("#data_gmeet_url").val($("#txt_gMeetURL" + val).val());
        $("#data_from_timing").val($("#txt_from_timing" + val).val());

        var from_timing = $("#data_from_timing").val();
        var gmeet_url = $("#data_gmeet_url").val();
        var class_w = $("#txt_class_name" + val).val();
        // var d = $("#txt_today_date" + val).val();
        var section = $("#txt_section_name" + val).val();

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        today = mm + '-' + dd + '-' + yyyy;
        var s_name = $("#txt_subject_name" + val).val();
        $('#notify').click(function() {
            let vale = "The class will start from " + from_timing + ". Please Join " + gmeet_url
            $('#notificationMsg').val(vale);
            $('#data_cancelled').val(0);
        });
        $('#cancel').click(function() {
            let vale = "Dear " + class_w + section + " Students Please note that the " + s_name + " Class scheduled on " + today + " at " + from_timing + " is Cancelled"
            // let vale = "Dear  Student Subject '" + s_name + " Class" + +d + " scheduled on dd/mm/yyyy at 00:00 AM/PM is Cancelled "
            $('#notificationMsg').val(vale);
            $('#data_cancelled').val(1);
        });
        $('#custom').click(function() {
            let vale = ""
            $('#notificationMsg').val(vale);
            $('#data_cancelled').val(0);
        });

        $('#notificationMsg').val("The class will start from " + from_timing + ". Please Join " + gmeet_url);

    });


    $("#frm_class_notify").on('submit', (function(e) {
        // e.preventDefault();
        var dateClass_id = $("#date_class_id").val();
        var subject_id = $("#data_subject_id").val();
        var class_id = $("#data_class_id").val();
        var gmeet_url = $("#data_gmeet_url").val();
        //alert(class_id);
        $('.loader').show();
        $.ajax({
            url: "{{url('student-notify')}}",
            type: "POST",
            data: {
                dateClass_id: dateClass_id,
                subject_id: subject_id,
                class_id: class_id,
                gmeet_url: gmeet_url,
                notificationMsg: notificationMsg
            },
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                //console.log(response.data);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, response.message);
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            },
            error: function(error_r) {
                $('.loader').fadeOut();
                var obj = JSON.parse(error_r.responseText);
                console.log(obj);
                $.each(obj.errors, function(key, value) {
                    $.fn.notifyMe('error', 5, value);
                });
            }
        });
    }));
    /* Invitaion Accept */
    $('[data-id=accept]').click(function() {
        var id = $(this).attr("data-invaccept");
        var g_code = $("#txt_inv_code" + id).val();
        var inv_id = $("#txt_inv_id" + id).val()
        //alert(id);
        $('.loader').show();
        $.ajax({
            url: "{{route('teacher.acceptClass')}}",
            type: "POST",
            data: {
                id: inv_id,
                g_code: g_code
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, response.message);
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            },
            error: function(error_r) {
                $('.loader').fadeOut();
                var obj = JSON.parse(error_r.responseText);
                $.each(obj.errors, function(key, value) {
                    $.fn.notifyMe('error', 5, value);
                });
            }
        });
    });
    $(document).on('click', '[data-viewAssignment]', function() {
        var liveurl = $(this).attr("data-viewAssignment");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No assignement url found!');
        }
    });
    // Notify Students
    $('[data-id=notify_student]').click(function() {
        var getBoxId = $(this).attr("data-notifyMe");
        var dateClass_id = $("#dateClass_id" + getBoxId).val();
        var class_id = $("#txt_class_id" + getBoxId).val();
        var subject_id = $("#txt_subject_id" + getBoxId).val();
        var g_meet_url = $("#txt_gMeetURL" + getBoxId).val();
        if (g_meet_url == '') {
            $.fn.notifyMe('error', 5, 'First update the JOIN LIVE class link');
            return false;
        }
        $('.loader').show();
        $.ajax({
            url: '{{ url("student-notify") }}',
            type: "POST",
            data: {
                class_id: class_id,
                subject_id: subject_id,
                dateClass_id: dateClass_id,
                g_meet_url: g_meet_url
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $(this).prop('disable', true);
                $('#notifyurl_' + getBoxId + ' span').text('Sending...');
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, response.message);
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            },
            complete: function() {
                $('.loader').fadeOut();
                $(this).prop('disable', false);
                $('#notifyurl_' + getBoxId + ' span').text('Announcement');
            },
            error: function(error_r) {
                $('.loader').fadeOut();
                $(this).prop('disable', false);
                $('#notifyurl_' + getBoxId + ' span').text('Announcement');
                var obj = JSON.parse(error_r.responseText);
                $.each(obj.errors, function(key, value) {
                    $.fn.notifyMe('error', 5, value);
                });
            }
        });
    });

    // Description or Class  note
    $(document).on('mouseover', '.text-editwrapper textarea', function() {
        $(this).prop("disabled", false);
    });
    $(document).on('mouseout', '.text-editwrapper textarea', function() {
        $(this).prop("disabled", true);
    });
    $(document).on('focusout', '.text-editwrapper textarea', function() {
        var thiz = $(this);
        var id = thiz.parent().find('.text-edit1').attr('data-savedesc');
        var getDescText = (thiz.parent().find('.text-edit1').val().replace(/\$/g, '')).trim();
        var dateClass_id = $("#dateClass_id" + id).val();


        if (getDescText.length > 255) {
            $.fn.notifyMe('error', 4, 'Not To be Exceed More than 255 Char,You have Written ' + getDescText.length + ' Char');
        } else {
            $('.loader').show();
            $.ajax({
                type: 'POST',
                url: '{{ url("update-classNotes") }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'dateClass_id': dateClass_id,
                    'description': getDescText
                },
                success: function(result) {
                    $('.loader').fadeOut();
                    var response = JSON.parse(result);

                    if (response.status == 'success') {
                        $.fn.notifyMe('success', 5, response.message);
                        $("#txt_desc" + id).val(getDescText);
                    } else {
                        $.fn.notifyMe('error', 5, response.message);
                    }


                    //$.fn.notifyMe('success',4,'Description has been saved!');
                },
                error: function() {
                    $('.loader').fadeOut();
                    // thiz.parent().find('.text-edit').removeClass('active');
                    $.fn.notifyMe('error', 4, 'There is some error while saving class note text!');
                }
            });
        }
    });


    function viewPastClass(id) {
        var class_date = $('#pastclassdata' + id).val();
        $('#plclasses').hide();
        $.ajax({
            type: 'GET',
            url: '{{ url("/teacher/class/viewPastClass") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'class_date': class_date,
            },
            success: function(result) {
                $('#plclasses').html(result);
                $('#plclasses').show();

            },
            error: function() {}
        });
        $('active1').addClass('bgcolor');
        //var class_date1 = $('#pastclassdata{{$i}}');
        //console.log(class_date1);
    }

    function viewFutureClass(id) {
        var class_date = $('#futureclassdata' + id).val();
        $('#upcmoingclass').hide();
        $.ajax({
            type: 'GET',
            url: '{{ url("/teacher/class/viewFutureClass") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'class_date': class_date,
            },
            success: function(result) {
                $('#upcmoingclass').html(result);
                $('#upcmoingclass').show();

            },
            error: function() {}
        });
        $('active1').addClass('bgcolor');
        //var class_date1 = $('#pastclassdata{{$i}}');
        //console.log(class_date1);
    }

    function viewAssignment(id) {
        $('.loader').show();
        $.ajax({
            type: 'POST',
            url: '{{ url("/teacher/class/assignments") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'class_id': id,
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                let data = '';
                response.data.forEach(function(classAssignment) {
                    $('#assignmentList').find('tbody').find('tr').remove();
                    data += '<tr>';
                    data += '<td>' + classAssignment.g_title + '</td>';
                    data += '<td><a href="' + classAssignment.g_live_link + '" class="text-decoration-none" target="_blank">Link</a></td>';
                    data += '</tr>';

                    $('#assignmentList').find('tbody').append(data);
                });
            },
            error: function() {
                $('.loader').fadeOut();
                $.fn.notifyMe('error', 4, 'There is some error while searching for assignment!');
            }
        });
    }
</script>
<script>
    // $('#sel_topic').blur(function() {
    //     if ($(this).val().length != 0) {
    //         $('#txt_topin_name').attr('disabled', 'disabled');
    //     }
    // });
    // $('#txt_topin_name').blur(function() {
    //     if ($(this).val().length != 0) {
    //         $('#sel_topic').attr('disabled', 'disabled');
    //     }
    // });
</script>
<script>
    $(document).ready(function() {
        $('input[id=t1radio]').on('click',
            function() {
                $('.asg1').prop("disabled", false);
                $('.asg2').prop("disabled", true);
                $('.asg2').prop("value", "");
            });
        $('input[id=t2radio]').on('click',
            function() {
                $('.asg2').prop("disabled", false);
                $('.asg1').prop("disabled", true);
                $('.asg1').prop("value", "");
            });
    });

    function shareContent(url, dateClass_id) {
        var notificationMsg = "Please go through " + url + " for today's notes";
        $('.loader').show();
        $.ajax({
            url: "{{url('student-notify')}}",
            type: "POST",
            data: {
                notificationMsg: notificationMsg,
                dateClass_id: dateClass_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, response.message);
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            },
            error: function(error_r) {
                $('.loader').fadeOut();
                var obj = JSON.parse(error_r.responseText);
                $.each(obj.errors, function(key, value) {
                    $.fn.notifyMe('error', 5, value);
                });
            }
        });
    }
</script>

<script>
    $('.chapter').change('[data-chapter]', function() {
        var getChapter = $(this).val();
        var id = $(this).attr('data-chapter');
        var class_name = $("#txt_class_name" + id).val();
        var subject_id = $("#txt_subject_id" + id).val();
        //alert(id);
        if (getChapter != '') {
            $('.loader').show();
            $.ajax({
                type: 'Get',
                url: '{{ route("get-topic") }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'chapter': getChapter,
                    'class': class_name,
                    'subject': subject_id
                },
                success: function(result) {
                    $('.loader').fadeOut();
                    var response = JSON.parse(result);
                    if (response || getChapter == "Select Chapter") {
                        $("#chapterTopic" + id).empty();
                        $("#chapterTopic" + id).append('<option>Select Topic</option>');
                        $.each(response, function(key, value) {
                            $('#chapterTopic' + id).append('<option value="' + key + '">' + value + '</option>').show();
                        });

                    } else {
                        $('.topics').empty();
                    }
                },
                error: function() {
                    $('.loader').fadeOut();
                    $.fn.notifyMe('error', 4, 'There is some error while saving description text!');
                }
            });

        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#teacherlist').DataTable();
    });
</script>
@endsection