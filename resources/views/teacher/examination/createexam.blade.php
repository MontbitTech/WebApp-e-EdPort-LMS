 <style>
     .test {
         background-color: white;
         margin-top: -16px;
         margin-left: 11px;
         padding-right: 0px;
         position: absolute;
     }
 </style>
 <link rel="stylesheet" href="{{asset('css/multipleexam.css')}}">
 <div class="col-md-12 col-lg-12 col-12 px-0 mb-5 border-line">
     <ul id="progressbar" class="text-center">
         <li class="active step0" id="step1">Exam name</li>
         <li class="step0" id="step2">Create Exam</li>
         <li class="step0" id="step3">Submit</li>
         <li class="step0" id="step4">t/c</li>
     </ul>
     <div class="card  card-hiden-new b-0 show">
         <div class="row justify-content-center">
             <div class="col-lg-10 col-md-11">

                 <div class="form-group"> <label class="form-control-label">Examination Name</label>
                     <input type="text" id="examname" name="examname" placeholder="Please enter exam name here ..." class="color-btn" onblur="validate1(2)"> </div>
             </div>
         </div>


         <div class="row d-flex justify-content-center">
             <div class="circle">
                 <div class="fa-long-arrow-right next btn" id="next1" onclick="validate1(0)">Next</div>
             </div>
         </div>
     </div>
     <div class="card card-hiden b-0">
         <!-- <button class="fas fa-plus  addquestionexam"> </button> -->
         <div class="row justify-content-center">
             <div class="col-lg-12 col-md-12">
                 <form>
                     <div class="row mb-3 px-3">
                         <div class="col-md-4">
                             <select class="form-control" name="" id="">
                                 <option value="" selected>Select Class</option>
                                 <option value="">10 A</option>
                                 <option value=""> 11</option>
                             </select>
                         </div>
                         <div class="col-md-4">
                             <select class="form-control" name="" id="">
                                 <option value="" selected>Select Subject</option>
                                 <option value="">Hindi</option>
                                 <option value=""> English</option>
                             </select>
                         </div>
                         <div class="col-md-4">
                             <select class="form-control" name="" id="">
                                 <option value="" selected>Select Chapter</option>
                                 <option value="">Chapter 1</option>
                                 <option value="">Chapter 2</option>
                             </select>
                         </div>
                         <div class="circle">
                             <button class="fas fa-plus addquestionexam py-1" data-toggle="tooltip" data-placement="right" title="Add Question">
                             </button>
                         </div>
                     </div>
                     <div class="row  px-3">
                         <div class="col-md-1">
                             <input type="checkbox" checked name="" id="" checked>
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
                             <input type="checkbox" checked name="" id="" checked>
                         </div>
                         <div class="col-md-11  mt-2">
                             <div class="media">
                                 <strong class="mr-1">Q.2 </strong>
                                 <div class="media-body font-weight-bold">
                                     Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, beatae repellat amet
                                     voluptate fugiat expedita laudantium debitis ipsam reprehenderit doloribus.
                                 </div>
                             </div>
                         </div>


                     </div>
                     <div class="createquestion px-3"></div>
                     <hr>
                     <div class="form-group px-3">
                         <h3 for="exampleInputQuestionname" class="mb-0 text-center"> Exam Name</h3>
                         <!-- <input type="text" class="form-control input-xs" id="exampleInputQuestionname" placeholder="Exam name"> -->
                     </div>
                     <div class="media px-3">
                         <strong class="mr-1">Q.1 </strong>
                         <div class="media-body font-weight-bold">
                             <textarea name="" id="" class="w-100 form-control border-0 rounded-0" style="resize: none;" rows="3" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, beatae repellat amet  voluptate fugiat expedita laudantium debitis ipsam reprehenderit doloribus.
                                   </textarea>
                         </div>
                     </div>
                     <div class="media px-3">
                         <strong class="mr-1">Q.2 </strong>
                         <div class="media-body font-weight-bold">
                             <textarea name="" id="" class="w-100 form-control border-0 rounded-0" style="resize: none;" rows="3" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, beatae repellat amet  voluptate fugiat expedita laudantium debitis ipsam reprehendeorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, beatae repellat amet  voluptate fugiat expedita laudantium debitis ipsam reprehenderit doloribus.
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
                 <div class=" fa-long-arrow-right next btn" id="next2" onclick="validate2(0)">Next
                 </div>
             </div>
         </div>
     </div>
     <div class="card  card-hiden b-0">
         <div class="row d-flex justify-content-center text-center">

             <div class="col-md-8">
                 <h2 class="mb-4">Assign Examination</h2>
                 <div class="col-md-12 mt-1 ">
                     <div class="form-group">
                         <label for="times">Date </label>
                         <input type="datetime-local" id="birthdaytime" class="form-control input-xs" name="birthdaytime">
                     </div>
                 </div>
                 <div class="col-md-5 d-inline-block  pr-0   mb-4 mt-2  mr-4  ">
                     <label for="times">Time</label>
                     <input type="number" id="birthdaytime" class="form-control input-xs" name="birthdaytime">
                 </div>
                 <div class="col-md-5 d-inline-block mt-2 ml-4">
                     <label for="times">Total Point</label>
                     <input type="number" id="birthdaytime" class="form-control input-xs" name="birthdaytime">
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
                 <div class="fa-long-arrow-right next btn" id="next2" onclick="validate2(0)">Next </div>
             </div>
         </div>
         <!-- <div class="row d-flex justify-content-center">
                            <div class="check"> <img src="https://i.imgur.com/g6KlBWR.gif" class="check-mark">
                            </div>
                        </div> -->
     </div>
     <div class="card card-hiden-new b-0 ">
         <div class="row d-flex justify-content-around m-0 p-0">
             <div class="col-lg-5 col-md-5 col-12 mb-5 p-0 m-0 border">
                 <div class="row m-0 p-0">
                     <div class="col-md-12 p-0 m-0">
                         <div class="test"> Full Screen while giving exam </div>
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
             <div class="col-lg-5 col-md-5 col-12 mb-5 p-0 m-0 border">
                 <div class="row m-0 p-0">
                     <div class="col-md-12 p-0 m-0">
                         <div class="test"> Multitasking while giving exam </div>
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
             <div class="col-lg-5 col-md-5 col-12 mb-5 p-0 m-0 border">
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
             <div class="col-lg-5 col-md-5 col-12 mb-5 p-0 m-0 border">
                 <div class="row m-0 p-0">
                     <div class="col-md-12 p-0 m-0">
                         <div class="test"> Full Screen while giving exam </div>
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
             <div class="col-lg-5 col-md-5 col-12 mb-5 p-0 m-0 border">
                 <div class="row m-0 p-0">
                     <div class="col-md-12 p-0 m-0">
                         <div class="test">System compatibility test </div>
                     </div>
                     <div class="col-md-8 mt-2">systemIncompatible</div>
                     <div class="col-md-4 p-0 mt-2 m-0 justify-content-center text-center">
                         <label class="switch  ">
                             <input type="checkbox">
                             <span class="slider round"></span>
                         </label>

                     </div>
                     <div class="col-md-12 col-lg-12 col-12 mb-2">
                         <textarea name="" id="" cols="10" rows="1" class="form-control" style="resize: none;" placeholder="systemIncompatibleReason"></textarea>
                     </div>
                     <!-- <div class="col-md-8 mt-2"> systemIncompatibleReason</div>
                     <div class="col-md-4 p-0 my-2 m-0">
                         <input type="number" name="name" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

                     </div> -->
                 </div>
             </div>
             <div class="col-lg-5 col-md-5 col-12 mb-5 p-0 m-0 border">
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
                     <div class="col-md-8 mt-2"> userNotAloneWarningCo </div>
                     <div class="col-md-4 p-0 my-2 m-0">
                         <input type="number" name="name" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

                     </div>
                     <div class="col-md-8 mt-2"> userNotVisibleWarning </div>
                     <div class="col-md-4 p-0 my-2 m-0">
                         <input type="number" name="name" id="name" placeholder="1-5" class="form-control m-auto w-75  " min="1" max="5">

                     </div>
                 </div>
             </div>
             <div class="col-lg-5 col-md-5 col-12 mb-5 p-0 m-0 border">
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
             <div class="col-lg-5 col-md-5 col-12 mb-5 p-0 m-0 border">
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
             <div class="col-lg-5 col-md-5 col-12 mb-5 p-0 m-0 border">
                 <div class="row m-0 p-0">
                     <div class="col-md-12 p-0 m-0">
                         <div class="test">Right click usage while giving exam </div>
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
             <div class="col-lg-5 col-md-5 col-12 mb-5 p-0 m-0 border">
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
             <div class="col-lg-5 col-md-5 col-12 mb-5 p-0 m-0 border">
                 <div class="row m-0 p-0">
                     <div class="col-md-12 p-0 m-0">
                         <div class="test"> Exam termination </div>
                     </div>
                     <div class="col-md-8 mt-2">examTerminated</div>
                     <div class="col-md-4 p-0 mt-2 m-0 justify-content-center text-center">
                         <label class="switch  ">
                             <input type="checkbox">
                             <span class="slider round"></span>
                         </label>

                     </div>
                     <div class="col-md-12 col-lg-12 col-12 mb-2">
                         <textarea name="" id="" cols="10" rows="1" class="form-control" style="resize: none;" placeholder="examTerminationReason"></textarea>
                     </div>

                 </div>
             </div>
             <div class="col-lg-5 col-md-5 col-12 mb-5 p-0 m-0 border">
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
                         <textarea name="" id="" cols="10" rows="1" class="form-control" style="resize: none;" placeholder="examPausedReason"></textarea>
                     </div>

                 </div>
             </div>
             <div class="col-lg-5 col-md-5 col-12 mb-5 p-0 m-0 border">
                 <div class="row m-0 p-0">
                     <div class="col-md-12 p-0 m-0">
                         <div class="test">Examination URLs</div>
                     </div>

                     <div class="col-md-12 col-lg-12 col-12 my-2">
                         <textarea name="" id="" cols="10" rows="1" class="form-control" style="resize: none;" placeholder="displayResultURL"></textarea>
                     </div>
                     <div class="col-md-12 col-lg-12 col-12 mb-2">
                         <textarea name="" id="" cols="10" rows="1" class="form-control" style="resize: none;" placeholder="errorPageURL"></textarea>
                     </div>

                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-md-12 col-lg-12 col-12 text-center">
                 <div class="btn text-white" style="background-color:#373c8e;">Submit</div>
             </div>
         </div>
     </div>
 </div>
 <script src="{{asset('js/createexam.js')}}"></script>