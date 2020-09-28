<style>
    /* .test {
        background-color: white;
        margin-top: -16px;
        margin-left: 11px;
        padding-right: 0px;
        position: absolute;
    } */
</style>
<link rel="stylesheet" href="{{asset('css/multipleexam.css')}}">
<div class="col-md-12 col-lg-12 col-12 px-0 mb-5 border-line">
    <ul id="progressbar" class="text-center">
        <li class="active step0" id="step1">Exam name</li>
        <li class="step0" id="step2">Create Exam</li>
        <li class="step0" id="step3">Exam</li>
        <li class="step0" id="step4">Assign Examination</li>
        <li class="step0" id="step5">t/c </li>
    </ul>
    <!-- <hr> -->
    {{-- <form action="" method="post">--}}
    <div class="card bg-data card-hiden-new b-0 show">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-11">

                <div class="form-group">
                    <label class="form-control-label">Examination Name</label>
                    <input type="text" id="examname" name="title" placeholder="Please enter exam name here ..." class="color-btn" onblur="validate1(0)"></div>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="circle">
                <div class="fa-long-arrow-right next btn" id="next1" onclick="validate1(0)">Next</div>
            </div>
        </div>
    </div>
    <div class="card bg-data card-hiden b-0">
        <form>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row mb-3 px-3">
                        <div class="col-md-4">
                            <select class="form-control" id="class" onchange="getChapter()">
                                <option value="" selected>Select Class</option>
                                @foreach($classes as $class)
                                <option value="{{$class}}">{{$class}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="subject" onchange="getChapter()">
                                <option value="" selected>Select Subject</option>
                                @foreach($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="chapter" onchange="getQuestion()">
                                <option value="" selected>Select Chapter</option>
                            </select>
                        </div>
                        <div class="circle">
                            <button class="fas fa-plus data py-1" data-toggle="tooltip" data-placement="right" title="Add Question">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="row" id="question"></div>
                    <div class="createdata pr-2"></div>
                </div>
                <div class="col-md-6 border-left">
                    <div class="form-group" id="questionPaper">
                        <h3 for="exampleInputQuestionname" class=" text-center" id="displayExamName"> Exam Name</h3>
                    </div>

                </div>
            </div>
        </form>
        <div class="row d-flex justify-content-center m-auto">
            <div class="circle">
                <div class="fa-long-arrow-left prev btn">Prev</div>
            </div>
            <div class="circle">
                <div class=" fa-long-arrow-right next btn" id="next2">Next
                </div>
            </div>
        </div>
    </div>
    <div class="card bg-data card-hiden-new b-0">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-11">

                <div class="form-group row">
                    <div class="form-group" id="questionPapershow">
                        <h3 for="exampleInputQuestionname" class=" text-center" id="displayExamNameshow"> Exam
                            Name</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="circle ">
                <div class="fa-long-arrow-left prev btn">Prev</div>
            </div>
            <div class="circle">
                <div class="fa-long-arrow-right next btn" id="next3" onclick="validate3(0)">Next</div>
            </div>
        </div>
    </div>
    <div class="card bg-data  card-hiden b-0">
        <div class="row d-flex justify-content-center text-center">
            <div class="col-md-8">
                <!-- <h2 class="mb-4">Assign Examination</h2> -->
                <!-- <div class="col-md-12 mt-1 ">
                    <div class="form-group">
                        <label for="times">Date </label>
                        <input type="datetime-local" id="birthdaytime" class="form-control input-xs" name="start_time">
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-md-6 my-2 ">
                        <label class="d-block mb-2">Class</label>
                        <select class="form-control select1 " data-placeholder="Class" name="classroom" id="select1" style="width: 100%;">
                            <option value="">Select Classroom</option>
                            @foreach($classrooms as $classroom)
                            <option value="{{$classroom->id}}">{{$classroom->class_name}} {{$classroom->section_name}}
                                , {{$classroom->studentSubject->subject_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6  my-2 ">
                        <label for="times">Time</label>
                        <input type="number" id="timedate" class="form-control input-xs" name="duration">
                    </div>
                    <!-- <div class="col-md-5 d-inline-block mt-2 ml-4">
                    <label for="times">Total Point</label>
                    <input type="number" id="point" class="form-control input-xs" name="birthdaytime">
                         </div> -->
                    <div class="col-md-6 my-2 ">
                        <label for="times">Start Time</label>
                        <input type="datetime-local" id="timestart" class="form-control input-xs" name="start_time">
                    </div>
                    <div class="col-md-6 my-2 ">
                        <label for="times">End Time</label>
                        <input type="datetime-local" id="timeend" class="form-control input-xs" name="end_time">
                    </div>
                    <!--
                    <a href="javascript:void(0)" class="btn btn-sm btn-info col-md-12" style="background-color: #373c8e;">Assign</a> -->

                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center m-auto">
            <div class="circle ">
                <div class="fa-long-arrow-left prev btn">Prev</div>
            </div>
            <div class="circle">
                <div class="fa-long-arrow-right next btn" id="next4" onclick="validate4(0)">Next</div>
            </div>
        </div>
        <!-- <div class="row d-flex justify-content-center">
                               <div class="check"> <img src="https://i.imgur.com/g6KlBWR.gif" class="check-mark">
                               </div>
                           </div> -->
    </div>
    <div class="card bg-data card-hiden-new b-0 ">
        <div class="row d-flex justify-content-around m-0 p-0">
            <div class="col-lg-5 col-md-5 col-12 mb-3 p-0 m-0 border">
                <div class="row m-0 p-0">
                    <div class="col-md-12 p-0 m-0">
                        <div class="test"> Full Screen while giving exam</div>
                    </div>
                    <div class="col-md-8 mt-2">keepFullScreen</div>
                    <div class="col-md-4 p-0 mt-2 m-0 justify-content-center text-center">
                        <label class="switch  ">
                            <input type="hidden" name="keepFullScreen" value="0">
                            <input type="checkbox" name="keepFullScreen" checked>
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div class="col-md-8 mt-2"> fullScreenExitAttempts</div>
                    <div class="col-md-4 p-0 my-2 m-0">
                        <input type="number" name="fullScreenExitAttempts" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-12 mb-3 p-0 m-0 border">
                <div class="row m-0 p-0">
                    <div class="col-md-12 p-0 m-0">
                        <div class="test"> Multitasking while giving exam</div>
                    </div>
                    <div class="col-md-8 mt-2">blockMultitasking</div>
                    <div class="col-md-4 p-0 mt-2 m-0 justify-content-center text-center">
                        <label class="switch  ">
                            <input type="hidden" name="blockMultitasking" value="0">
                            <input type="checkbox" name="blockMultitasking" checked>
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div class="col-md-8 mt-2"> multitaskingAttempts</div>
                    <div class="col-md-4 p-0 my-2 m-0">
                        <input type="number" name="multitaskingAttempts" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-12 mb-3 p-0 m-0 border">
                <div class="row m-0 p-0">
                    <div class="col-md-12 p-0 m-0">
                        <div class="test">User Audio Tracking while giving exam</div>
                    </div>
                    <div class="col-md-8 mt-2">userAudioTracking</div>
                    <div class="col-md-4 p-0 mt-2 m-0 justify-content-center text-center">
                        <label class="switch  ">
                            <input type="hidden" name="userAudioTracking" value="0">
                            <input type="checkbox" name="userAudioTracking" checked>
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div class="col-md-8 mt-2">userAudioWarningCount</div>
                    <div class="col-md-4 p-0 my-2 m-0">
                        <input type="number" name="userAudioWarningCount" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-12 mb-3 p-0 m-0 border">
                <div class="row m-0 p-0">
                    <div class="col-md-12 p-0 m-0">
                        <div class="test"> Full Screen while giving exam</div>
                    </div>
                    <div class="col-md-8 mt-2">keepFullScreen</div>
                    <div class="col-md-4 p-0 mt-2 m-0 justify-content-center text-center">
                        <label class="switch  ">
                            <input type="hidden" name="keepFullScreen" value="0">
                            <input type="checkbox" name="keepFullScreen" checked>
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div class="col-md-8 mt-2"> fullScreenExitAttempts</div>
                    <div class="col-md-4 p-0 my-2 m-0">
                        <input type="number" name="fullScreenExitAttempts" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-5 col-md-5 col-12 mb-3 p-0 m-0 border">--}}
            {{-- <div class="row m-0 p-0">--}}
            {{-- <div class="col-md-12 p-0 m-0">--}}
            {{-- <div class="test">Examination URLs</div>--}}
            {{-- </div>--}}

            {{-- <div class="col-md-12 col-lg-12 col-12 my-3">--}}
            {{-- <textarea cols="10" rows="1" class="form-control" style="resize: none;"--}}
            {{-- placeholder="displayResultURL"></textarea>--}}
            {{-- </div>--}}
            {{-- <div class="col-md-12 col-lg-12 col-12 my-3">--}}
            {{-- <textarea cols="10" rows="1" class="form-control" style="resize: none;"--}}
            {{-- placeholder="errorPageURL"></textarea>--}}
            {{-- </div>--}}

            {{-- </div>--}}
            {{-- </div>--}}
            <div class="col-lg-5 col-md-5 col-12 mb-3 p-0 m-0 border">
                <div class="row m-0 p-0">
                    <div class="col-md-12 p-0 m-0">
                        <div class="test">User Video Tracking while giving exam</div>
                    </div>
                    <div class="col-md-8 mt-2">userVideoTracking</div>
                    <div class="col-md-4 p-0 mt-2 m-0 justify-content-center text-center">
                        <label class="switch  ">
                            <input type="hidden" name="userVideoTracking" value="0">
                            <input type="checkbox" name="userVideoTracking" checked>
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div class="col-md-8 mt-2"> userNotAloneWarningCount</div>
                    <div class="col-md-4 p-0 my-2 m-0">
                        <input type="number" name="userNotAloneWarningCo" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

                    </div>
                    <div class="col-md-8 mt-2"> userNotVisibleWarning</div>
                    <div class="col-md-4 p-0 my-2 m-0">
                        <input type="number" name="userNotVisibleWarning" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-12 mb-3 p-0 m-0 border">
                <div class="row m-0 p-0">
                    <div class="col-md-12 p-0 m-0">
                        <div class="test">Capture save user image while giving exam</div>
                    </div>
                    <div class="col-md-8 my-3">userImageCapture</div>
                    <div class="col-md-4 p-0 my-3 m-0 justify-content-center text-center">
                        <label class="switch  ">
                            <input type="hidden" name="userImageCapture" value="0">
                            <input type="checkbox" name="userImageCapture" checked>
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <!-- <div class="col-md-8 mt-2"> fullScreenExitAttempts</div>
                        <div class="col-md-4 p-0 my-2 m-0">
                            <input type="number" name="name" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

                        </div> -->
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-12 mb-3 p-0 m-0 border">
                <div class="row m-0 p-0">
                    <div class="col-md-12 p-0 m-0">
                        <div class="test"> Keyboard usage while giving exam</div>
                    </div>
                    <div class="col-md-8 my-3">blockKeyboard</div>
                    <div class="col-md-4 p-0 my-3 m-0 justify-content-center text-center">
                        <label class="switch  ">
                            <input type="hidden" name="blockKeyboard" value="0">
                            <input type="checkbox" name="blockKeyboard" checked>
                            <span class="slider round"></span>
                        </label>

                    </div>

                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-12 mb-3 p-0 m-0 border">
                <div class="row m-0 p-0">
                    <div class="col-md-12 p-0 m-0">
                        <div class="test">Right click usage while giving exam</div>
                    </div>
                    <div class="col-md-8 my-3">blockRightClick</div>
                    <div class="col-md-4 p-0 my-3 m-0 justify-content-center text-center">
                        <label class="switch  ">
                            <input type="hidden" name="blockRightClick" value="0">
                            <input type="checkbox" name="blockRightClick" checked>
                            <span class="slider round"></span>
                        </label>

                    </div>

                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-12 mb-3 p-0 m-0 border">
                <div class="row m-0 p-0">
                    <div class="col-md-12 p-0 m-0">
                        <div class="test">Time bound exam</div>
                    </div>
                    <div class="col-md-8 my-3">timeBound</div>
                    <div class="col-md-4 p-0 my-3 m-0 justify-content-center text-center">
                        <label class="switch  ">
                            <input type="hidden" name="timeBound" value="0">
                            <input type="checkbox" name="timeBound" checked>
                            <span class="slider round"></span>
                        </label>

                    </div>

                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-12 mb-3 p-0 m-0 border">
                <div class="row m-0 p-0">
                    <div class="col-md-12 p-0 m-0">
                        <div class="test"> Exam termination</div>
                    </div>
                    <div class="col-md-8 mt-2">examTerminated</div>
                    <div class="col-md-4 p-0 mt-2 m-0 justify-content-center text-center">
                        <label class="switch  ">
                            <input type="hidden" name="examTerminated" value="0">
                            <input type="checkbox" name="examTerminated">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="col-md-12 col-lg-12 col-12 mb-2">
                        <textarea cols="10" rows="1" name="examTerminationReason" class="form-control" style="resize: none;" placeholder="examTerminationReason"></textarea>
                    </div>

                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-12 mb-3 p-0 m-0 border">
                <div class="row m-0 p-0">
                    <div class="col-md-12 p-0 m-0">
                        <div class="test">Exam pause</div>
                    </div>
                    <div class="col-md-8 mt-2">examPaused</div>
                    <div class="col-md-4 p-0 mt-2 m-0 justify-content-center text-center">
                        <label class="switch  ">
                            <input type="hidden" name="examPaused" value="0">
                            <input type="checkbox" name="examPaused">
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div class="col-md-12 col-lg-12 col-12 mb-2">
                        <textarea cols="10" rows="1" name="examPausedReason" class="form-control" style="resize: none;" placeholder="examPausedReason"></textarea>
                    </div>

                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-12 mb-3 p-0 m-0 border">
                <div class="row m-0 p-0">
                    <div class="col-md-12 p-0 m-0">
                        <div class="test">System compatibility test</div>
                    </div>
                    <div class="col-md-8 mt-2">systemIncompatible</div>
                    <div class="col-md-4 p-0 mt-2 m-0 justify-content-center text-center">
                        <label class="switch  ">
                            <input type="hidden" name="systemIncompatible" value="0">
                            <input type="checkbox" name="systemIncompatible">
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div class="col-md-12 col-lg-12 col-12 mb-2">
                        <textarea cols="10" rows="1" name="systemIncompatibleReason" class="form-control" style="resize: none;" placeholder="systemIncompatibleReason"></textarea>
                    </div>
                    <!-- <div class="col-md-8 mt-2"> systemIncompatibleReason</div>
                        <div class="col-md-4 p-0 my-2 m-0">
                            <input type="number" name="name" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

                        </div> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-12 text-center">
                <div class="last-prev prev btn mr-4">Prev</div>
                <div class="btn last-prev">Submit</div>
            </div>
        </div>
    </div>
    {{-- </form>--}}
</div>
<script src="{{asset('js/createexam.js')}}"></script>
<script>
    var max_fieldss = 100000; //maximum input boxes allowed
    var wrappers = $(".createdata"); //Fields wrapper
    var add_buttons = $(".data"); //Add button ID
    var xx = 2; //initlal text box count
    $(add_buttons).click(function(e) { //on add input button click
        e.preventDefault();
        if (xx < max_fieldss) { //max input box allowed
            xx++; //text box increment
            $(wrappers).append(`<div class="row">
            <div class="col-md-1 mt-2">
                                            <input type="checkbox" id="check` + xx + `" onclick="addQuestionToPaper(xx,$(this), null, null)" value="">
                                        </div>
                         <div class=" col-md-11 p-0  mx-0">
                                                   
                                
                                    <a href="#" style="float:right;" class="remove_field"><i class="fas fa-times"></i></a>
                                   <div class="form-group mb-0 pb-1">                                   
                                      <textarea  id="exampleInputQuestion` + xx + `" class="w-100 newQuestion form-control" name="exampleInputQuestion" rows="3" placeholder="Insert your question" style="resize: none;" ></textarea>
                                    </div>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center pb-0 pt-0 mb-0 mt-0">Option </th>
                                                <th scope="col" class="pb-0 pt-0 mb-0 mt-0">Answer</th>
                                                <th scope="col" class="text-center pb-0 pt-0 mb-0 mt-0">Option </th>
                                                <th scope="col" class="pb-0 pt-0 mb-0 mt-0">Answer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="mb-0 mt-0 pt-0 pb-1">
                                                    <input class="form-control options form-control-sm  " id="option1` + xx + `" type="text" placeholder="option 1">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm answers  ml-4 0" id="checkbox1` + xx + `" value="0">
                                                </td>
                                                 <td class="mb-0 mt-0 pt-0 pb-1">
                                                    <input class="form-control form-control-sm  options" id="option2` + xx + `" type="text" placeholder="option 2">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 1 answers" id="checkbox2` + xx + `" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="mb-0 mt-0 pt-1 pb-0">
                                                    <input class="form-control form-control-sm  options" id="option3` + xx + `" type="text" placeholder="option 3">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 2 answers" id="checkbox3` + xx + `" value="2">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input class="form-control form-control-sm  options " id="option4` + xx + `" type="text" placeholder="option 4">
                                                </td>
                                                <td class="mb-0 mt-0 pt-1 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 answers" id="checkbox4` + xx + `"  value="3">
                                                </td>
                                            </tr>                     
                                        </tbody>
                                   </table>                                    
                            </div>
                            </div>`); //add input box
        }
    });

    $('#examname').on('focusout', function() {
        console.log($(this).val());
        $('#displayExamName').html($(this).val());
        $('#displayExamNameshow').html($(this).val());
    });

    $(wrappers).on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent().parent('div').remove();
        xx--;
    });

    function getChapter() {
        var subject = $('#subject').val();
        var className = $('#class').val();
        if (subject == '' || className == '')
            return;

        getQuestion();
        $('.loader').show();
        $.ajax({
            url: "{{url('/getChapter')}}",
            type: "GET",
            data: {
                class: className,
                subject: subject
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                if (result.success) {
                    $('#chapter').empty();
                    $('#chapter').append('<option value="">Select Chapter </option>');
                    $.each(result.response, function(key, value) {
                        $('#chapter').append('<option value="' + value + '">' + value + '</option>');
                    });
                } else {
                    $.fn.notifyMe('error', 5, result.response);
                }
            },
            error: function(error_r) {
                $('.loader').fadeOut();
            }
        });
    }

    function getQuestion() {
        var subject = $('#subject').val();
        var className = $('#class').val();
        var chapter = $('#chapter').val();
        if (subject == '' || className == '')
            return;

        $('.loader').show();
        $.ajax({
            url: "{{url('/getQuestions')}}",
            type: "GET",
            data: {
                class: className,
                subject_id: subject,
                chapter: chapter
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                if (result.success) {
                    $('#question').empty();
                    let count = 1;
                    let data = "";
                    $.each(result.response, function(key, value) {
                        data += '<div class="col-md-1 mt-2">';
                        data += '<input type="checkbox" class="questionCheckbox" onclick="addQuestionToPaper(value.id,$(this),\'' + value.question + '\',' + value.id + ')" name="questions[]" value="' + value.id + '"> </div>';
                        data += '<div class="col-md-11  mt-2"> ';
                        // data += '<strong class="mr-1">Q. </strong>';
                        data += '<p class=" font-weight-bold questionText">' + value.question + '</p>';
                        data += '</div>';
                        count++;
                    });
                    $('#question').append(data);

                } else {
                    $.fn.notifyMe('error', 5, result.response);
                }
            },
            error: function(error_r) {
                $('.loader').fadeOut();
                console.log(error_r);
            }
        });
    }

    function addQuestionToPaper(val,obj, question, questionId) {
        if (obj.is(":checked")) {
            ;
            if (questionId == null) {
                let className = $('#class').val();
                let subject = $('#subject').val();
                let chapter = $('#chapter').val();
                let questionText = obj.parent().next().find('.newQuestion').val();
                let optionsHtml = obj.parent().next().find('.options');
                let answersHtml = obj.parent().next().find('.answers');
                let options = [];
                let answer = [];

                for (var i = 0; i < optionsHtml.length; i++) {
                    options.push(optionsHtml[i].value);
                }
                for (var i = 0; i < answersHtml.length; i++) {
                    if (answersHtml[i].checked)
                        answer.push(options[answersHtml[i].value]);
                }

                return insertQuestion(val,obj, questionText, options, answer, className, subject, chapter);

            }
            //  let data = '<div class="media " id="addedQuestion' + questionId + '"> ' +
            //   '<input type="hidden" name="questions[]" value="' + questionId + '" > ';
            // data += '<div class="media-body font-weight-bold">';
            // data += '<input type="hidden" value="' + questionId + '">';
            let data = '<p class="bg-light mb-2 font-weight-bold" id="addedQuestion' + questionId + '">' + question + '</p>';
            //data += '</div> </div>';
            let show = '<div class="row mb-2"><div class="col-md-10">';
            show += ' <p class="bg-light  font-weight-bold" id="addedQuestion' + questionId + '">' + question + '</p>';
            show += '</div>';
            show += '<div class="col-md-2">';
            show += '<input type="number" name="marks" class="form-control" id="questionmarks' + questionId + '" >';
            show += '</div></div>';
            $('#questionPaper').append(data);
            $('#questionPapershow').append(show);

        } else {
            if (questionId == null) {
                questionId = obj.attr('data-questionId');
                deleteQuestion(questionId);
            }

            console.log(obj.attr('data-questionId'), questionId);
            $("#addedQuestion" + questionId).remove();
        }
    }

    function insertQuestion(val,obj, questionText, options, answer, className, subject, chapter) {
        var checkBox1  = document.getElementById("checkbox1"+val);
        var checkBox2   = document.getElementById("checkbox2"+val);
        var checkBox3   = document.getElementById("checkbox3"+val);
        var checkBox4   = document.getElementById("checkbox4"+val);
        var opt1        = document.getElementById("option1"+val).value;
        var opt2        = document.getElementById("option2"+val).value;
        var opt3        = document.getElementById("option3"+val).value;
        var opt4        = document.getElementById("option4"+val).value;
        var question    = document.getElementById("exampleInputQuestion"+val);
        if(questionText && (checkBox1.checked==true ||checkBox2.checked==true || checkBox3.checked==true || checkBox4.checked==true) && (opt1 !='' && opt2 !='' && opt3 !='' && opt4 !='') ){

        // return;
        $('.loader').show();
        $.ajax({
            url: "{{url('/saveQuestion')}}",
            type: "POST",
            data: {
                question: questionText,
                options: options,
                answer: answer,
                class: className,
                subject_id: subject,
                chapter: chapter
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                if (result.success) {
                    obj.attr('data-questionId', result.response.id);
                    let data = '<div class="media " id="addedQuestion' + result.response.id + '">' +
                        '<input type="hidden" name="questions[]" value="' + result.response.id + '" >';
                    data += '<div class="media-body font-weight-bold">';
                    data += '<input type="hidden" value="' + result.response.id + '">';
                    data += '<textarea class="w-100 form-control border-0 rounded-0" style="resize: none;" rows="3" disabled>' +
                        result.response.question + '</textarea>';
                    data += '</div> </div>';

                    $('#questionPaper').append(data);
                } else {
                    $.fn.notifyMe('error', 5, result.response);
                }
            },
            error: function(error_r) {
                $('.loader').fadeOut();
            }
        });

        }
    else{
        if(!questionText){
        question.style.borderColor = "red";
        $("#check"+val).prop("checked", false);
       }
       else question.style.borderColor = "#ced4da";
     
     if(opt1 ==''){
        document.getElementById("option1"+val).style.borderColor = "red";
        $("#check"+val).prop("checked", false);
     }
     else  document.getElementById("option1"+val).style.borderColor = "#ced4da";

     if( opt2 ==''){
        document.getElementById("option2"+val).style.borderColor = "red";
        $("#check"+val).prop("checked", false);
     }
     else  document.getElementById("option2"+val).style.borderColor = "#ced4da";

     if(opt3 ==''){
        document.getElementById("option3"+val).style.borderColor = "red";
        $("#check"+val).prop("checked", false);
     }
     else  document.getElementById("option3"+val).style.borderColor = "#ced4da";
     
     if(opt4 ==''){
        document.getElementById("option4"+val).style.borderColor = "red";
        $("#check"+val).prop("checked", false);
    }
    else  document.getElementById("option4"+val).style.borderColor = "#ced4da";
 
    if(checkBox1.checked==false && checkBox2.checked==false && checkBox3.checked==false &&checkBox4.checked==false){
         alert("select atleast one answer");
        $("#check"+val).prop("checked", false);
      }
     }
    }

    function deleteQuestion(questionId) {
        $.ajax({
            url: "{{url('/deleteQuestion/')}}" + "/" + questionId,
            type: "POST",
            data: {
                id: questionId,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                if (result.success) {
                    $.fn.notifyMe('success', 5, result.response);
                } else {
                    $.fn.notifyMe('error', 5, result.response);
                }
            },
            error: function(error_r) {
                $('.loader').fadeOut();
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('#st').change(function() {
            var st = $('#timestart').val(); // start time Format: '9:00 PM'
            var et = $('#timeend').val(); // end time   Format: '11:00 AM' 

            //how do i compare time
            if (st > et) {
                alert('end time always greater then start time');
            }
        });
    });
</script>