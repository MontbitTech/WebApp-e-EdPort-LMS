@extends('layouts.teacher.app')
@section('content')
<style>
    .card-header {
        padding-bottom: 4px;
    }
</style>
<style>
    .fieldlabels {
        color: #455A64 !important;
        text-align: left
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: #455A64;
        padding-left: 0px;
        margin-top: 30px
    }

    #progressbar li {
        list-style-type: none;
        font-size: 13px;
        width: 33.33%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar #step1:before {
        content: "1";
        color: #373c8e
    }

    #progressbar #step2:before {
        content: "2";
        color: #373c8e
    }

    #progressbar #step3:before {
        content: "3";
        color: #373c8e
    }

    #progressbar li:before {
        width: 40px;
        height: 40px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        background: #455A64;
        border-radius: 50%;
        margin: auto;
        padding: 0px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: #455A64;
        position: absolute;
        left: 0;
        top: 21px;
        z-index: -1
    }

    #progressbar li:last-child:after {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        position: absolute;
        left: -50%
    }

    #progressbar li:nth-child(2):after {
        left: -50%
    }

    #progressbar li:first-child:after {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        position: absolute;
        left: 50%
    }

    #progressbar li:last-child:after {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px
    }

    #progressbar li:first-child:after {
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #373c8e
    }

    .card-hiden:hover {
        box-shadow: none !important;
    }

    .card-hiden {
        /* background-color: #373c8e; */
        box-shadow: none !important;
        padding: 60px 40px 40px 40px;
        /* z-index: 0; */
        display: none
    }

    .card-hiden.show {
        display: block
    }

    .form-control-label {
        font-size: 22px !important;
        color: #373c8e;
        letter-spacing: 1px
    }

    ::placeholder {
        color: #373c8e;
        opacity: 1;
        font-weight: 300
    }

    :-ms-input-placeholder {
        color: #373c8e;
        font-weight: 300
    }

    ::-ms-input-placeholder {
        color: #373c8e;
        font-weight: 300
    }

    .color-btn,
    textareas,
    buttons {
        background-color: #373c8e !important;
        padding: 8px 15px 8px 15px;
        border-radius: 0px !important;
        margin-bottom: 25px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        color: #2C3E50;
        background-color: #ECEFF1;
        border: none;
        border-bottom: 1px solid #ccc;
        font-size: 18px !important;
        color: #373c8e !important;
        font-weight: 300
    }

    input:focus,
    textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border-bottom: 1px solid #9FA8DA;
        outline-width: 0;
        font-weight: 400
    }

    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0
    }

    .circle {
        position: relative
    }

    .fa-long-arrow-right {
        color: #373c8e;
        background-color: #373c8e;
        padding: 12px;
        margin: 5px;
        border-radius: 50%;
        border: 3px solid #373c8e;
        position: absolute;
        left: -28px;
        top: 12px;
        cursor: pointer
    }

    .fa-long-arrow-right:hover {
        color: #FFF;
        background-color: #B39DDB
    }

    .fa-long-arrow-left {
        position: absolute;
        left: 20px;
        top: 20px;
        color: #373c8e;
        cursor: pointer
    }

    .check-mark {
        width: 180px;
        height: 180px
    }
</style>

<section class="main-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-lg-8 col-12">
                <div class="col-md-12 col-lg-12 col-12 px-0 mb-5">
                    <ul id="progressbar" class="text-center">
                        <li class="active step0" id="step1">Exam name</li>
                        <li class="step0" id="step2">Create Exam</li>
                        <li class="step0" id="step3">Submit</li>
                    </ul>
                    <div class="card card-hiden b-0 show">
                        <div class="row justify-content-center">
                            <div class="col-lg-10 col-md-11">
                                <!-- <div class="form-group"> <label class="form-control-label">Who I'm building
                                        for?</label> <input type="text" id="name" name="name" placeholder="Enter your name here ..." class="color-btn" onblur="validate1(1)">
                                </div> -->
                                <div class="form-group"> <label class="form-control-label">Examination Name</label>
                                    <input type="text" id="examname" name="examname" placeholder="Please enter exam name here ..." class="color-btn" onblur="validate1(2)"> </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="circle">
                                <div class="fa fa-long-arrow-right next" id="next1" onclick="validate1(0)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-hiden b-0">
                        <div class="fa fa-long-arrow-left prev"> </div>
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
                                            <button class="fas fa-plus next addquestionexam" id="next2" onclick="validate2(0)">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row  px-3">
                                        <div class="col-md-1">
                                            <input type="checkbox" name="" id="" checked>
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
                                            <input type="checkbox" name="" id="" checked>
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
                                    <div class="createquestion row px-3"></div>
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
                        <div class="row d-flex justify-content-center">
                            <div class="circle">
                                <div class="fa fa-long-arrow-right next" id="next2" onclick="validate2(0)">
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

                                <a href="javascript:void(0)" class="btn btn-sm btn-info col-md-12" style="background-color: #373c8e;">Assign</a>

                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="check"> <img src="https://i.imgur.com/g6KlBWR.gif" class="check-mark">
                            </div>
                        </div>
                    </div>
                </div>
                @include('teacher.examination.exam')
                @include('teacher.examination.questionadd')

                <!--Teacher-Examination-Exam-Create -->

                <!-- <div class="col-md-12 px-0">
                    <div class="card card-info  ">
                        <div class="card-header pt-1 pb-0 border-transparent text-white" style="background-color: #373c8e;">
                            <h4 class="card-title d-inline">Create Question Paper</h4>
                            <div class="card-tools d-inline">
                                <button type="button" class="btn btn-tool text-white float-right" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body card-border-exam">
                            <form role="form">
                                <div class="form-group">
                                    <label for="exampleInputQuestionname" class="mb-0">Enter Paper Name</label>
                                    <input type="text" class="form-control input-xs" id="exampleInputQuestionname" placeholder="Exam name">
                                </div>
                                <hr>
                                <label for="exampleInputQuestion1" class="align-top">Question 1</label>
                                <div class="form-group mb-0 pb-1">
                                    <textarea name="" id="exampleInputQuestion1" class="w-100 form-control" rows="3" placeholder="Insert your question" style="resize: none;"></textarea>
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
                                            <td class="mb-0 mt-0 pt-1 pb-0">
                                                <input class="form-control form-control-sm  " type="text" placeholder="option 4">
                                            </td>
                                            <td class="mb-0 mt-0 pt-0 pb-0">
                                                <input type="checkbox" class=" form-control-sm  ml-4 ">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="newquestion"></div>
                                <div class="row">
                                    <div class="col-md-6 col-6 col-lg-6">
                                        <button class="btn btn-info addquestion w-100 mb-1" style="background-color: #373c8e;"><i class="fas fa-plus mr-3"></i>Add More Question</button>
                                    </div>
                                    <div class="col-md-6 col-6 col-lg-6">
                                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div> -->

            </div>
            <div class="col-md-4 col-lg-4 col-12">

                <div class="col-md-12 px-0">
                    <div class="card card-info ">
                        <div class="card-header border-transparent text-white pt-1 pb-0" style="background-color: #373c8e;;">
                            <h4 class="card-title d-inline">Assign Examination</h4>
                            <div class="card-tools d-inline">
                                <button type="button" class="btn btn-tool text-white float-right " data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body card-body-border pt-2 pb-0 ">
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
                            <div class="col-md-12 mt-1 ">
                                <label class="d-block mb-2">Question Paper</label>
                                <select data-placeholder="Question Paper" class="form-control select2" style="width: 100%;">

                                    <option value="">Question Paper</option>
                                    <option value="Summer">Summer</option>
                                    <option value="Winter">Winter</option>
                                    <option value="Unit">Unit</option>
                                </select>
                            </div>
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
                        </div>
                    </div>
                    <div class="card-footer card-border-exam clearfix">
                        <a href="javascript:void(0)" class="btn btn-sm btn-info" style="width:100%;background-color: #373c8e;">Assign</a>
                    </div>

                </div>
            </div>
            <!-- <div class="position-fixed bg-white border-radius-2" style="right: 1em;bottom: 1em;">
                    <a href=""><i class="fas fa-plus "></i> </a>
                </div> -->
        </div>
        <!-- ./Teacher-Examination-Exam-Form-Edit -->


        <!-- Examination-Exam-Details -->


    </div>
    </div>
</section>
<script src="{{asset('js/examination.js')}}"></script>
<script>
    var max_fields = 100000; //maximum input boxes allowed
    var wrapper = $(".createquestion"); //Fields wrapper
    var add_button = $(".addquestionexam"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(`
            <div class="col-md-1 mt-2">
                                            <input type="checkbox" name="" id="" checked>
                                        </div>
                         <div class=" col-md-11 p-0  mx-0">
                                                        
                                    <label for="exampleInputQuestion` + x + `" class="align-top">Question ` + x + `</label>
                                    <a href="#" style="float:right;" class="remove_field"><i class="fas fa-times"></i></a>
                                   <div class="form-group mb-0 pb-1">                                   
                                      <textarea name="" id="exampleInputQuestion` + x + `" class="w-100 form-control" rows="3" placeholder="Insert your question" style="resize: none;" ></textarea>
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
                            </div>`); //add input box
        }
    });

    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });
</script>
<script>
    function collapse(el) {
        $(el).parent().removeAttr('open');
        $(el).siblings(':not(summary)').removeAttr('style');
    }
    $(function() {
        //Set accessibility attributes
        $('summary').each(function() {
            $(this).attr('role', 'button');
            if ($(this).parent().is('[open]')) {
                $(this).attr('aria-expanded', 'true');
            } else {
                $(this).attr('aria-expanded', 'false');
            }
        });

        //Event handler
        $('summary').on('click', function(e) {
            e.preventDefault();
            if ($(this).parent().is('[open]')) {
                $(this).attr('aria-expanded', 'false');
                $(this).siblings(':not(summary)').css('transform', 'scaleY(0)');
                window.setTimeout(collapse, 300, $(this));
            } else {
                $(this).parent().attr('open', '');
                $(this).attr('aria-expanded', 'true');
            }
        });
    });
</script>
<script>
    // function validate1(val) {
    //     // v1 = document.getElementById("name");
    //     v2 = document.getElementById("examname");

    //     //flag1 = true;
    //     flag2 = true;

    //     // if (val >= 1 || val == 0) {
    //     //     if (v1.value == "") {
    //     //         v1.style.borderColor = "red";
    //     //         flag1 = false;
    //     //     } else {
    //     //         v1.style.borderColor = "white";
    //     //         flag1 = true;
    //     //     }
    //     // }

    //     if (val >= 2 || val == 0) {
    //         if (v2.value == "") {
    //             v2.style.borderColor = "red";
    //             flag2 = false;
    //         } else {
    //             v2.style.borderColor = "white";
    //             flag2 = true;
    //         }
    //     }

    //     // flag = flag1 && flag2;
    //     flag = flag2;
    //     return flag;
    // }

    // function validate2(val) {
    //     v1 = document.getElementById("web-title");
    //     v2 = document.getElementById("desc");

    //     flag1 = true;
    //     flag2 = true;

    //     if (val >= 1 || val == 0) {
    //         if (v1.value == "") {
    //             v1.style.borderColor = "red";
    //             flag1 = false;
    //         } else {
    //             v1.style.borderColor = "white";
    //             flag1 = true;
    //         }
    //     }

    //     if (val >= 2 || val == 0) {
    //         if (v2.value == "") {
    //             v2.style.borderColor = "red";
    //             flag2 = false;
    //         } else {
    //             v2.style.borderColor = "white";
    //             flag2 = true;
    //         }
    //     }

    //     flag = flag1 && flag2;

    //     return flag;
    // }

    $(document).ready(function() {

        var current_fs, next_fs, previous_fs;

        $(".next").click(function() {

            str1 = "next1";
            str2 = "next2";

            if (!str1.localeCompare($(this).attr('id')) == true) {
                val1 = true;
            } else {
                val1 = false;
            }

            if (!str2.localeCompare($(this).attr('id')) == true) {
                val2 = true;
            } else {
                val2 = false;
            }

            if ((!str1.localeCompare($(this).attr('id')) && val1 == true) || (!str2.localeCompare($(
                    this).attr('id')) && val2 == true)) {
                current_fs = $(this).parent().parent().parent();
                next_fs = $(this).parent().parent().parent().next();

                $(current_fs).removeClass("show");
                $(next_fs).addClass("show");

                $("#progressbar li").eq($(".card-hidden").index(next_fs)).addClass("active");

                current_fs.animate({}, {
                    step: function() {

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });

                        next_fs.css({
                            'display': 'block'
                        });
                    }
                });
            }
        });

        $(".prev").click(function() {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            $(current_fs).removeClass("show");
            $(previous_fs).addClass("show");

            $("#progressbar li").eq($(".card").index(next_fs)).removeClass("active");

            current_fs.animate({}, {
                step: function() {

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });

                    previous_fs.css({
                        'display': 'block'
                    });
                }
            });
        });

    });
</script>
@endsection