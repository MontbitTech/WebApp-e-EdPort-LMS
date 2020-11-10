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

    <div class="card text-center mb-3">
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
                <div class="row ">
                    <div class="col-md-3 col-3 col-lg-2 col-sm-3 font-weight-bold mobile-hide pr-0 pt-3 pl-1 font-size-tab ">
                        {{ date('h:i a',strtotime($t->from_timing))}} to {{ date('h:i a',strtotime($t->to_timing))}}
                    </div>
                    <div class=" col-3   col-sm-3 font-weight-bold moblie-show mobile-screen-size-time  pr-0 pt-3 pl-1 font-size-tab ">
                        {{ date('H:i ',strtotime($t->from_timing))}} - {{ date('H:i ',strtotime($t->to_timing))}}
                    </div>
                    <div class="col-md-7 col-7  col-sm-7 font-weight-bold pt-3 p-0 font-size-tab display-none-lp mobile-screen-size-classroom"> Classroom: {{ $class_name}} {{$section_name }} , {{$subject_name}}</div>
                    <div class="col-md-2 col-2 col-lg-2 col-sm-2 font-weight-bold pt-3 p-0 font-size-tab display-none-tab"> Class: {{ $class_name }} Std</div>
                    <div class="col-md-1 col-1 col-lg-1 col-sm-1 font-weight-bold pt-3 p-0 font-size-tab display-none-tab"> Section:{{$section_name}}</div>
                    <div class="col-md-5 col-5 col-lg-5 col-sm-5 font-weight-bold text-center  m-0 pt-3 p-0 font-size-tab display-none-tab"> Subject: {{$subject_name}}</div>
                    <div class="col-md-2 col-2 col-lg-2 col-sm-2 font-weight-bold mobile-screen-size-time  pt-1 px-0 text-center">
                        <div class="row">
                            <div class="col-md-6 col-5 col-lg-6 p-0 m-0">
                                @if($t->cancelled)
                                <div class="btn text-danger moblie-show-none">X</div>
                                <button class="btn  display-none-mobile btn-md bg-danger text-white btn-sm-size mr-left  mb-0 ml-2 font-weight-bold mt-1 font-size-tab">Cancelled</button>
                                @else
                                <button type="button" data-editModal="{{$i}}" class="btn text-right btn-edit-view   btn-md pb-0 mb-0 pt-2 border-0 text-white  mr-0 pr-0" title="Edit">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                @endif
                            </div>
                            <div class="col-md-6 col-7 col-lg-6 btn-view-sm">
                                <button type="button" class="btn btn-collapse text-white mb-1 mt-1 pl-2 pr-2 pt-1 pb-1 font-size-tab" data-toggle="collapse" data-target="#collapseExample{{$t->id}}" aria-expanded="false" aria-controls="collapseExample{{$t->id}}"><i class=" toggle-class  @if((date('H:i',strtotime($t->from_timing))  <= date('H:i')) &(date('H:i') <= date('H:i',strtotime($t->to_timing))) )  fa fa-minus @else fas fa-plus  @endif "></i>
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="collapse card-border @if((date('H:i',strtotime($t->from_timing)) <= date('H:i')) &(date('H:i') <=date('H:i',strtotime($t->to_timing))) ) show @endif " id="collapseExample{{$t->id}}">
            <div class="card-body p-0">
                <div class="row m-2">
                    <div class="col-md-6 mt-1 px-0">
                        <div class="row m-0 p-0 ">
                            <div class="col-md-6 ml-0 pl-0 m-unset-moblie">
                                <select class="form-control custom-select-sm border-0 btn-shadow chapter" id="chapter" name="chap" data-chapter="{{$i}}" @if($t->cancelled)disabled @endif>
                                    <option value="Select Chapter">Select Chapter</option>
                                    @if(count($chapters)>0)
                                    @foreach($chapters->unique('chapter') as $ch)
                                    @if($ch->class==$cls && $ch->subject==$t->subject_id)
                                    <?php $selected = ($ch->id == $t->topic_id) ? 'selected' : ''; ?>
                                    <option value="{{$ch->chapter}}" {{$selected}}>{{$ch->chapter}}</option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 ml-0 pr-0 m-unset-moblie">
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
                                        <?php
                                        $parse = parse_url($cms_link);
                                        $cms_link_name = $parse['host'];

                                        $cms_link_name = str_ireplace(['www.', '.com', '.ca', 'lms.', '-s', '.net', '.info', '.org', 'en.', '.tech', '.coop', '.int', '.co', '.uk', '.ac', '.io', '.github', 'about.'], '', $cms_link_name);
                                        ?>
                                        <div class="col-md-6 mt-2">
                                            <div class="w-100 d-inline-flex row" style="letter-spacing:3px;">
                                                <a href="javascript:void(0);" data-topiclink="{{ $cms_link  }}" data-topicid="{{$t->topic_id}}" class="col-md-9 col-9 col-lg-9 btn btn-sm btn-outline-dark btn-shadow border-0 d-inline-flex d-none" id="viewcontent_{{$t->id}}" style="{{$display_style}}">
                                                    <!-- Edport Content -->
                                                    <span class="m-auto font-weight-bolder text-capitalize">{{$cms_link_name}}</span>
                                                </a>
                                                <button class="col-md-3 col-3 col-lg-3 btn btn-sm btn-outline-dark btn-shadow border-0" onclick="shareContent('{{$cms_link}}','{{$t->id}}')">
                                                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @endif

                                        @if($academy!=null)
                                        <!-- My School -->
                                        <?php
                                        $parse = parse_url($academy);
                                        $academy_name = $parse['host'];
                                        $academy_name = str_ireplace(['www.', '.com', '.ca', 'lms.', '-s', '.net', '.info', '.org', 'en.', '.tech', '.coop', '.int', '.co', '.uk', '.ac', '.io', '.github', 'about.'], '', $academy_name);
                                        ?>

                                        <div class="col-md-6 mt-2">
                                            <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                <a href="javascript:void(0);" data-academylink="{{ $academy}}" data-topicid="{{$t->topic_id}}" id="academy_{{$t->id}}" class="col-9 col-md-9 col-lg-9 btn btn-sm btn-outline-primary btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">
                                                    <span class="m-auto font-weight-bolder text-capitalize">{{$academy_name}}</span>
                                                </a>

                                                <button class="col-3 col-md-3 col-lg-3  btn btn-sm btn-outline-primary btn-shadow border-0" onclick="shareContent('{{$academy}}','{{$t->id}}')">
                                                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @endif
                                        @if($youtube!=null)

                                        <div class="col-md-6 mt-2">
                                            <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                <a href="javascript:void(0);" data-youtubelink="{{ $youtube}}" data-topicid="{{$t->topic_id}}" id="youtube_{{$t->id}}" class="col-9 btn btn-sm btn-outline-danger btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">
                                                    <?php

                                                    $parse = parse_url($youtube);
                                                    $youtube_name = $parse['host'];

                                                    $youtube_name = str_ireplace(['www.', '.com', '.ca', 'lms.', '-s', '.net', '.info', '.org', 'en.', '.tech', '.coop', '.int', '.co', '.uk', '.ac', '.io', '.github', 'about.'], '', $youtube_name);

                                                    ?>
                                                    <span class="m-auto font-weight-bolder text-capitalize">{{$youtube_name}}</span>
                                                </a>

                                                <button class="col-3 btn btn-sm btn-outline-danger btn-shadow border-0" onclick="shareContent('{{$youtube}}','{{$t->id}}')">
                                                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @endif

                                        @if($other!=null)
                                        <div class="col-md-6 mt-2">
                                            <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                <a href="javascript:void(0);" data-wikipedialink="{{ $other}}" data-topicid="{{$t->topic_id}}" id="wikipedia_{{$t->id}}" class="col-9 btn btn-sm btn-outline-secondary btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">
                                                    <?php
                                                    $parse = parse_url($other);
                                                    $other_name = $parse['host'];

                                                    $other_name = str_ireplace(['www.', '.com', '.ca', 'lms.', '-s', '.net', '.info', '.org', 'en.', '.tech', '.coop', '.int', '.co', '.uk', '.ac', '.io', '.github', 'about.'], '', $other_name);

                                                    ?>
                                                    <span class="m-auto font-weight-bolder text-capitalize">{{$other_name}}</span>
                                                </a>

                                                <button class="col-3 btn btn-sm btn-outline-secondary btn-shadow border-0" onclick="shareContent('{{$other}}','{{$t->id}}')">
                                                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @endif

                                        @if($book!=null)
                                        <div class="col-md-6 mt-2">
                                            <div class="w-100 d-inline-flex" style="letter-spacing:3px;">
                                                <a href="javascript:void(0);" data-book="{{ $book}}" data-topicid="{{$t->topic_id}}" id="book_{{$t->id}}" class="col-9 btn btn-sm btn-outline-primary btn-shadow border-0 d-inline-flex d-none" style="{{$display_style}}">
                                                    <?php
                                                    $parse = parse_url($book);
                                                    $book_name = $parse['host'];

                                                    $book_name = str_ireplace(['www.', '.com', '.ca', 'lms.', '-s', '.net', '.info', '.org', 'en.', '.tech', '.coop', '.int', '.co', '.uk', '.ac', '.io', '.github', 'about.'], '', $book_name);
                                                    ?>
                                                    <span class="m-auto font-weight-bolder text-capitalize">{{$book_name}}</span>
                                                </a>

                                                <button class="col-3 btn btn-sm btn-outline-primary btn-shadow border-0" onclick="shareContent('{{$book}}','{{$t->id}}')">
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
                    <div class="col-md-6 margin-notes-mobile">
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
                        <a href="javascript:void(0);" data-LiveLink="{{ $teacherData->g_meet_url }}" id="live_c_link_{{$i}}" class="btn btn-md btn-outline-danger mb-1 mr-2 border-0 btn-shadow btn-sm-size">
                            <svg class="icon font-10 mr-1">
                                <use xlink:href="../images/icons.svg#icon_dot"></use>
                            </svg>
                            Join Live
                        </a>
                        <button type="button" data-toggle="modal" data-target="#viewStudentModal" data-dateclass="{{$t->id}}" data-id="view_student" data-view="{{$i}}" id="purchaseshowdivid" class="btn btn-md btn-outline-primary mb-1 border-0 btn-shadow btn-sm-size" href="javascript:;" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View">View Students</button>
                        @endif


                        <a href="#" class="btn btn-md btn-outline-primary mb-1 mr-2 border-0 btn-shadow btn-sm-size" data-notify="{{$i}}">
                            <svg class="icon mr-1">
                                <use xlink:href="../images/icons.svg#icon_bell"></use>
                            </svg>
                            <span>Announcement</span>
                        </a>
                        <button type="button" data-classhelp="{{$i}}" class="btn btn-md btn-outline-primary btn-sm-size mb-1 mr-2 border-0 btn-shadow" title="Help" data-id="help">
                            <svg class="icon mr-1">
                                <use xlink:href="../images/icons.svg#icon_help"></use>
                            </svg>
                            Help
                        </button>

                    </div>

                    <div class="m-auto">
                        @if($t->cancelled)
                        @else
                        <a href=" #" class="btn btn-md btn-outline-primary mb-1 mr-2 border-0 btn-shadow btn-sm-size" id="new_a_link_{{$i}}" data-createModal='{{$i}}' data-class_modal="{{$t->class_id}}" data-subject_modal="{{$t->subject_id}}" data-teacher_modal="{{$t->teacher_id}}">
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
                        <button onclick="viewAssignment({{$t->id}})" class="btn btn-md btn-outline-primary mb-1 mr-2 border-0 btn-shadow btn-sm-size" data-toggle="modal" data-target="#exampleModalLong">View Assigment</button>
                        @else
                        <button onclick="viewAssignment({{$t->id}})" class="btn btn-md btn-outline-primary mb-1 mr-2 border-0 btn-shadow btn-sm-size" id="assignmentmodal" data-toggle="modal" data-target="#exampleModalLong" style="display:none">View Assigment</button>

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
                            <input type="number" class="form-control" min="0" name="txt_point" id="txt_point" placeholder="Point">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12" style="text-align: center;">
                        <button type="button" id="assignment_create" class="btn btn-primary btn-sm-size px-4">Create</button>
                        <button type="button" id="attach_file" class="btn btn-primary btn-sm-size px-4">Create and Attach File</button>
                        <button type="button" id="cancel_assignment" class="btn btn-secondary btn-sm-size" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                <p style="font-size: smaller;color: red;text-align: center;">Note: Please allow popup for the assignment functionality.</p>
            </div>
        </div>
    </div>
</div>
<!-- ./New Assignment Modal -->

<!-- View Assignment Modal -->
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
                            <th>Submissions</th>
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
                        {!! Form::text('start_time','', array('id'=>'from_timing','placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required',"onkeydown"=>"return false;")) !!}
                    </div>

                </div>

                <div class="form-group row">
                    <label for="class_liveurl" class="col-md-4 col-form-label text-md-right">End Time:
                    </label>
                    <div class="col-md-6">
                        {!! Form::text('end_time', '', array('id'=>'end_timing','placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required',"onkeydown"=>"return false;")) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="class_liveurl" class="col-md-4 col-form-label text-md-right">Join Live
                        <small>(Link)</small>:</label>
                    <div class="col-md-6">
                        {!! Form::text('edit_join_liveUrl','', array('id'=>'edit_join_liveUrl','placeholder' => 'Enter Live class url','class' => 'form-control','readonly' )) !!}

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