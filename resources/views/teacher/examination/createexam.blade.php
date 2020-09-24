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
        <li class="step0" id="step3">Submit</li>
        <li class="step0" id="step4">t/c</li>
    </ul>
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
                <div class="fa-long-arrow-right next btn" id="next1">Next</div>
            </div>
        </div>
    </div>
    <div class="card bg-data card-hiden b-0">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <form>
                    <div class="row mb-3 px-3">
                        <div class="col-md-4">
                            <select class="form-control">
                                <option value="" selected>Select Class</option>
                                <option value="">10 A</option>
                                <option value=""> 11</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control">
                                <option value="" selected>Select Subject</option>
                                <option value="">Hindi</option>
                                <option value=""> English</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control">
                                <option value="" selected>Select Chapter</option>
                                <option value="">Chapter 1</option>
                                <option value="">Chapter 2</option>
                            </select>
                        </div>
                        <div class="circle">
                            <button class="fas fa-plus data py-1" data-toggle="tooltip" data-placement="right" title="Add Question">
                            </button>
                        </div>
                    </div>
                    <div class="row  px-3">
                        <div class="col-md-1">
                            <input type="checkbox" checked checked>
                        </div>
                        <div class="col-md-11  ">
                            <div class="media">
                                <strong class="mr-1">Q.1 </strong>
                                <div class="media-body font-weight-bold">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, eligendi.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-1 mt-2">
                            <input type="checkbox" checked checked>
                        </div>
                        <div class="col-md-11  mt-2">
                            <div class="media">
                                <strong class="mr-1">Q.2 </strong>
                                <div class="media-body font-weight-bold">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, beatae repellat
                                    amet
                                    voluptate fugiat expedita laudantium debitis ipsam reprehenderit doloribus.
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="createdata px-3"></div>
                    <hr>
                    <div class="form-group px-3">
                        <h3 for="exampleInputQuestionname" class="mb-0 text-center"> Exam Name</h3>
                        <!-- <input type="text" class="form-control input-xs" id="exampleInputQuestionname" placeholder="Exam name"> -->
                    </div>
                    <div class="media px-3">
                        <strong class="mr-1">Q.1 </strong>
                        <div class="media-body font-weight-bold">
                            <textarea class="w-100 form-control border-0 rounded-0" style="resize: none;" rows="3" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, beatae repellat amet  voluptate fugiat expedita laudantium debitis ipsam reprehenderit doloribus.
                                   </textarea>
                        </div>
                    </div>
                    <div class="media px-3">
                        <strong class="mr-1">Q.2 </strong>
                        <div class="media-body font-weight-bold">
                            <textarea class="w-100 form-control border-0 rounded-0" style="resize: none;" rows="3" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, beatae repellat amet  voluptate fugiat expedita laudantium debitis ipsam reprehendeorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, beatae repellat amet  voluptate fugiat expedita laudantium debitis ipsam reprehenderit doloribus.
                                                </textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
    <div class="card bg-data  card-hiden b-0">
        <div class="row d-flex justify-content-center text-center">

            <div class="col-md-8">
                <h2 class="mb-4">Assign Examination</h2>
                <div class="col-md-12 mt-1 ">
                    <div class="form-group">
                        <label for="times">Date </label>
                        <input type="datetime-local" id="birthdaytime" class="form-control input-xs" name="birthdaytime">
                    </div>
                </div>
                <div class="col-md-12 mt-1 ">
                    <label class="d-block mb-2">Class</label>
                    <select class="form-control select1 " data-placeholder="Class" name="select1" id="select1" style="width: 100%;">
                        <option value="">Class</option>
                        <option value="1">X</option>
                        <option value="2">XI</option>
                        <option value="3">XII</option>
                        <option value="4">V</option>
                    </select>
                </div>
                <div class="col-md-5 d-inline-block  pr-0   mb-4 mt-2  mr-4  ">
                    <label for="times">Time</label>
                    <input type="number" id="timedate" class="form-control input-xs" name="birthdaytime">
                </div>
                <div class="col-md-5 d-inline-block mt-2 ml-4">
                    <label for="times">Total Point</label>
                    <input type="number" id="point" class="form-control input-xs" name="birthdaytime">
                </div>
                <div class="col-md-5 d-inline-block  pr-0   mb-4 mt-2  mr-4  ">
                    <label for="times">Start Time</label>
                    <input type="time" id="timestart" class="form-control input-xs" name="birthdaytime">
                </div>
                <div class="col-md-5 d-inline-block mt-2 ml-4">
                    <label for="times">End Time</label>
                    <input type="time" id="timeend" class="form-control input-xs" name="birthdaytime">
                </div>
                <!--
                <a href="javascript:void(0)" class="btn btn-sm btn-info col-md-12" style="background-color: #373c8e;">Assign</a> -->

            </div>
        </div>
        <div class="row d-flex justify-content-center m-auto">
            <div class="circle ">
                <div class="fa-long-arrow-left prev btn">Prev</div>
            </div>
            <div class="circle">
                <div class="fa-long-arrow-right next btn" id="next3">Next</div>
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
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div class="col-md-8 mt-2"> fullScreenExitAttempts</div>
                    <div class="col-md-4 p-0 my-2 m-0">
                        <input type="number" name="name" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

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
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div class="col-md-8 mt-2"> multitaskingAttempts</div>
                    <div class="col-md-4 p-0 my-2 m-0">
                        <input type="number" name="name" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

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
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div class="col-md-8 mt-2">userAudioWarningCount</div>
                    <div class="col-md-4 p-0 my-2 m-0">
                        <input type="number" name="name" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

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
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div class="col-md-8 mt-2"> fullScreenExitAttempts</div>
                    <div class="col-md-4 p-0 my-2 m-0">
                        <input type="number" name="name" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-12 mb-3 p-0 m-0 border">
                <div class="row m-0 p-0">
                    <div class="col-md-12 p-0 m-0">
                        <div class="test">Examination URLs</div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-12 my-3">
                        <textarea cols="10" rows="1" class="form-control" style="resize: none;" placeholder="displayResultURL"></textarea>
                    </div>
                    <div class="col-md-12 col-lg-12 col-12 my-3">
                        <textarea cols="10" rows="1" class="form-control" style="resize: none;" placeholder="errorPageURL"></textarea>
                    </div>

                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-12 mb-3 p-0 m-0 border">
                <div class="row m-0 p-0">
                    <div class="col-md-12 p-0 m-0">
                        <div class="test">User Video Tracking while giving exam</div>
                    </div>
                    <div class="col-md-8 mt-2">userVideoTracki</div>
                    <div class="col-md-4 p-0 mt-2 m-0 justify-content-center text-center">
                        <label class="switch  ">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div class="col-md-8 mt-2"> userNotAloneWarningCo</div>
                    <div class="col-md-4 p-0 my-2 m-0">
                        <input type="number" name="name" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

                    </div>
                    <div class="col-md-8 mt-2"> userNotVisibleWarning</div>
                    <div class="col-md-4 p-0 my-2 m-0">
                        <input type="number" name="name" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

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
                            <input type="checkbox" checked>
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
                            <input type="checkbox" checked>
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
                            <input type="checkbox" checked>
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
                            <input type="checkbox" checked>
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
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div class="col-md-12 col-lg-12 col-12 mb-2">
                        <textarea cols="10" rows="1" class="form-control" style="resize: none;" placeholder="examTerminationReason"></textarea>
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
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div class="col-md-12 col-lg-12 col-12 mb-2">
                        <textarea cols="10" rows="1" class="form-control" style="resize: none;" placeholder="examPausedReason"></textarea>
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
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>

                    </div>
                    <div class="col-md-12 col-lg-12 col-12 mb-2">
                        <textarea cols="10" rows="1" class="form-control" style="resize: none;" placeholder="systemIncompatibleReason"></textarea>
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
</div>
<script src="{{asset('js/createexam.js')}}"></script>
<script>
    var max_fieldss = 100000; //maximum input boxes allowed
    var wrappers = $(".createdata"); //Fields wrapper
    var add_buttons = $(".data"); //Add button ID
    console.log(add_buttons);
    var xx = 2; //initlal text box count
    $(add_buttons).click(function(e) { //on add input button click
        e.preventDefault();
        if (xx < max_fieldss) { //max input box allowed
            xx++; //text box increment
            $(wrappers).append(`<div class="row">
            <div class="col-md-1 mt-2">
                                            <input type="checkbox"  checked>
                                        </div>
                         <div class=" col-md-11 p-0  mx-0">
                                                   
                                    <label for="exampleInputQuestion` + xx + `" class="align-top"> <strong>Q. ` + xx + `</strong></label>
                                    <a href="#" style="float:right;" class="remove_field"><i class="fas fa-times"></i></a>
                                   <div class="form-group mb-0 pb-1">                                   
                                      <textarea  id="exampleInputQuestion` + xx + `" class="w-100 form-control" rows="3" placeholder="Insert your question" style="resize: none;" ></textarea>
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
                                                    <input class="form-control form-control-sm  " type="text" placeholder="option 1">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 ">
                                                </td>
                                                 <td class="mb-0 mt-0 pt-0 pb-1">
                                                    <input class="form-control form-control-sm  " type="text" placeholder="option 2">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 ">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="mb-0 mt-0 pt-1 pb-0">
                                                    <input class="form-control form-control-sm  " type="text" placeholder="option 3">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 ">
                                                </td>
                                                <td class="mb-0 mt-0 pt-0 pb-0">
                                                    <input class="form-control form-control-sm  " type="text" placeholder="option 4">
                                                </td>
                                                <td class="mb-0 mt-0 pt-1 pb-0">
                                                    <input type="checkbox" class=" form-control-sm  ml-4 ">
                                                </td>
                                            </tr>                     
                                        </tbody>
                                   </table>                                    
                            </div>
                            </div>`); //add input box
        }
    });

    $(wrappers).on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent().parent('div').remove();
        xx--;
    });

    {
        {
            --$('#createExam').on('click', function(e) {
                    --
                }
            } {
                {
                    --
                    var title = $('#next1').val();
                    --
                }
            } {
                {
                    --console.log(title);
                    --
                }
            } {
                {
                    --$('.loader').show();
                    --
                }
            } {
                {
                    --$.ajax({
                            --
                        }
                    } {
                        {
                            --type: 'POST', --
                        }
                    } {
                        {
                            --url: '{{ url("/examination/create") }}', --
                        }
                    } {
                        {
                            --headers: {
                                --
                            }
                        } {
                            {
                                --'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') --
                            }
                        } {
                            {
                                --
                            }, --
                        }
                    } {
                        {
                            --data: {
                                --
                            }
                        } {
                            {
                                --title: title, --
                            }
                        } {
                            {
                                --
                            }, --
                        }
                    } {
                        {
                            --success: function(result) {
                                --
                            }
                        } {
                            {
                                --$('.loader').fadeOut();
                                --
                            }
                        } {
                            {
                                --console.log(result);
                                --
                            }
                        } {
                            {
                                --
                            }, --
                        }
                    } {
                        {
                            --error: function() {
                                --
                            }
                        } {
                            {
                                --$('.loader').fadeOut();
                                --
                            }
                        } {
                            {
                                --$.fn.notifyMe('error', 4, 'There is some error while creating exam!');
                                --
                            }
                        } {
                            {
                                --
                            }--
                        }
                    } {
                        {
                            --
                        });
                    --
                }
            } {
                {
                    --
                }) --
        }
    }
</script>