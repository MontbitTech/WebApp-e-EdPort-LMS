@if(count($pastClassData) > 0)

@php
$i=1;
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

<div id="plclasses1">
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
                        @if($t->cancelled)
                            <span class="badge badge-danger">Cancelled</span>
                        @endif
                        <button type="button" class="btn  text-white collapse-btn" data-toggle="collapse" data-target="#collapseExample{{$t->id}}" aria-expanded="false" aria-controls="collapseExample{{$t->id}}"><i class=" fas fa-plus"></i>
                        </button>
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

                                <select class="form-control custom-select-sm border-0 btn-shadow chapter" id="chapter" name="chap" data-chapter="{{$i}}">
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
                                <select class="form-control custom-select-sm border-0 btn-shadow" data-selecttopic="{{$t->id}}" id="chapterTopic{{$i}}">
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
                    <div class="col-md-6 mt-1">
                        <div class="row">

                            <div class="col-12 col-lg-12 col-md-12"> Notes</div>
                            <div class="col-12 col-lg-12 col-md-12 text-center" data-url="#" data-savedesc="{{$t->id}}" contenteditable="false" id="class_description_{{$i}}">

                                @if($t->class_description!='')
                                {{$t->class_description}}
                                @else
                                {{$t->class_description}}
                                @endif

                            </div>


                        </div>
                    </div>

                </div>
            </div>
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
</script>