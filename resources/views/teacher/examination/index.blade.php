@extends('layouts.teacher.app')

@section('content')

<style>
    .card-border {
        border-right: 1px solid black !important;
        border-left: 1px solid black !important;
        border-bottom: 1px solid black !important;
    }
</style>

<section class="main-section">
    <div class="container-fluid">
        <div class="row">

            <!-- Examination-Exam-Create -->

            <div class="col-md-8">
                <div class="card card-info collapsed-card ">
                    <div class="card-header border-transparent text-white" style="background-color: #373c8e;">
                        <h3 class="card-title d-inline">Create Question Paper</h3>
                        <div class="card-tools d-inline">
                            <button type="button" class="btn btn-tool text-white float-right" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>


                    <div class="card-body card-border">
                        <form role="form">
                            <div class="form-group">
                                <label for="exampleInputQuestion" class="mb-0">Enter Paper Name</label>
                                <input type="text" class="form-control input-xs" id="exampleInputQuestion" placeholder="Exam name">
                            </div>
                            <hr>
                            <label for="exampleInputQuestion" class="align-top">Question 1</label>
                            <div class="form-group mb-0 pb-1">

                                <textarea name="" id="exampleInputQuestion" class="w-100" rows="3" placeholder="Insert your question" style="resize: none;"></textarea>
                                <!-- <input type="text" class="form-control form-control-sm" id="exampleInputQuestion" placeholder="Insert your question"> -->
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

                            <button class="btn btn-info addquestion w-100 mb-1" style="background-color: #373c8e;"><i class="fas fa-plus mr-3"></i>Add More Question</button>


                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>

                </div>

                <!-- ./Examination-Exam-Form-Create -->

                <!-- Examination-Exam-Form-Edit -->
                <!-- <div class="card card-info collapsed-card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Modifying My Existing Question Paper</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>


                    <div class="card-body">
                        <select class="form-control select2">
                            <option value="">Select Question Paper</option>
                            <option value="12th">12th Board Exam</option>
                            <option value="10th">10th Board Exam</option>
                            <option value="8th">8th Board Exam</option>
                        </select>
                        <div class="12th exam mt-3">
                            <form role="form">
                                <div class="form-group">
                                    <label for="exampleInputQuestion" class="mb-0">Question Paper Name</label>
                                    <input type="text" class="form-control input-xs" id="exampleInputQuestion" value="Company " placeholder="Exam name">
                                </div>
                                <hr>
                                <label for="exampleInputQuestion" class="align-top">Question 1</label>
                                <div class="form-group mb-0 pb-1">

                                    <textarea name="" id="exampleInputQuestion" class="w-100" rows="3">your company name</textarea>
                                   
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
                                                <input class="form-control form-control-sm  " value="MontBit" type="text" placeholder="option 1">

                                            </td>
                                            <td class="mb-0 mt-0 pt-0 pb-0">
                                                <input type="checkbox" class=" form-control-sm  ml-4 " checked>
                                            </td>

                                            <td class="mb-0 mt-0 pt-0 pb-1">
                                                <input class="form-control form-control-sm  " value="info" type="text" placeholder="option 2">

                                            </td>
                                            <td class="mb-0 mt-0 pt-0 pb-0">
                                                <input type="checkbox" class=" form-control-sm  ml-4 ">
                                            </td>
                                        </tr>
                                        <tr>

                                            <td class="mb-0 mt-0 pt-1 pb-0">
                                                <input class="form-control form-control-sm  " value="company" type="text" placeholder="option 3">

                                            </td>
                                            <td class="mb-0 mt-0 pt-0 pb-0">
                                                <input type="checkbox" class=" form-control-sm  ml-4 ">
                                            </td>
                                            <td class="mb-0 mt-0 pt-1 pb-0">
                                                <input class="form-control form-control-sm  " value="no" type="text" placeholder="option 4">

                                            </td>
                                            <td class="mb-0 mt-0 pt-0 pb-0">
                                                <input type="checkbox" class=" form-control-sm  ml-4 ">
                                            </td>
                                        </tr>




                                    </tbody>

                                </table>
                                <div class="newquestion"></div>

                                <button class="btn btn-info addquestion w-100 mb-1"><i class="fas fa-plus mr-3"></i>Add More Question</button>


                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </form>
                        </div>
                    </div>

                </div> -->
            </div>

            <!-- ./Examination-Exam-Form-Edit -->


            <!-- Examination-Exam-Details -->

            <div class="col-md-4">
                <div class="card card-info collapsed-card ">
                    <div class="card-header border-transparent text-white" style="background-color: #373c8e;;">
                        <h3 class="card-title d-inline">Assign Question Paper</h3>
                        <div class="card-tools d-inline">
                            <button type="button" class="btn btn-tool text-white float-right " data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>
                    </div>
                    <div class="card-border">
                        <div class="card-body pt-2 pb-0 ">
                            <div class="col-md-12 mt-1">
                                <label class="d-block mb-2">Question Paper</label>
                                <select data-placeholder="Question Paper" class="form-control select2" style="width: 100%;">

                                    <option value="">Question Paper</option>
                                    <option value="Summer">Summer</option>
                                    <option value="Winter">Winter</option>
                                    <option value="Unit">Unit</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-1">
                                <label class="d-block mb-2">Class</label>
                                <select class="form-control select1 " data-placeholder="Class" name="select1" id="select1" style="width: 100%;">
                                    <option value="">Class</option>
                                    <option value="1">X</option>
                                    <option value="2">XI</option>
                                    <option value="3">XII</option>
                                    <option value="4">V</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-1">

                                <div class="1 box">
                                    <strong class="d-block mb-2">Batch</strong>
                                    <input type="checkbox" id="checkboxSuccess1" checked>
                                    <label for="checkboxSuccess1" class="mr-3">Evening</label>
                                    <input type="checkbox" id="checkboxSuccess2" checked>
                                    <label for="checkboxSuccess2" class="mr-3">Morning</label>
                                    <input type="checkbox" id="checkboxSuccess3" checked>
                                    <label for="checkboxSuccess3">Afternoon</label>
                                </div>
                                <div class="2 box">
                                    <strong class="d-block mb-2">Batch</strong>
                                    <input type="checkbox" id="checkboxSuccess1" checked>
                                    <label for="checkboxSuccess1" class="mr-3">Evening</label>
                                    <input type="checkbox" id="checkboxSuccess2" checked>
                                    <label for="checkboxSuccess2">Morning</label>
                                </div>
                                <div class="3 box">
                                    <strong class="d-block mb-2">Batch</strong>
                                    <input type="checkbox" id="checkboxSuccess1" checked>
                                    <label for="checkboxSuccess1" class="mr-3">Afternoon</label>
                                    <input type="checkbox" id="checkboxSuccess2" checked>
                                    <label for="checkboxSuccess2">Morning</label>
                                </div>
                                <div class="4 box">
                                    <strong class="d-block mb-2">Batch</strong>
                                    <input type="checkbox" id="checkboxSuccess1" checked>
                                    <label for="checkboxSuccess1" class="mr-3">Afternoon</label>
                                    <input type="checkbox" id="checkboxSuccess2" checked>
                                    <label for="checkboxSuccess2">Evening</label>
                                </div>


                            </div>


                        </div>
                        <div class="card-footer clearfix">
                            <a href="javascript:void(0)" class="btn btn-sm btn-info" style="width:100%;background-color: #373c8e;">Assign</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        var max_fields = 100000; //maximum input boxes allowed
        var wrapper = $(".newquestion"); //Fields wrapper
        var add_button = $(".addquestion"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(`
                                    <div class="">
                                    <hr>
                                   
                                    
                                    <label for="exampleInputQuestion" class="align-top">Question ` + x + `</label>
                                    <a href="#" style="float:right;" class="remove_field"><i class="fas fa-times"></i></a>
                                   <div class="form-group mb-0 pb-1">
                                   
                                      <textarea name="" id="exampleInputQuestion" class="w-100" rows="3" placeholder="Insert your question" style="resize: none;" ></textarea>
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
        })
    });
</script>
<script>
    $(document).ready(function() {
        $("select").change(function() {
            $(this).find("option:selected").each(function() {
                var optionValue = $(this).attr("value");
                if (optionValue) {
                    $(".box").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else {
                    $(".box").hide();
                }
            });
        }).change();
    });
    $(document).ready(function() {
        $("select").change(function() {
            $(this).find("option:selected").each(function() {
                var optionValue = $(this).attr("value");
                if (optionValue) {
                    $(".new").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else {
                    $(".new").hide();
                }
            });
        }).change();
    });
</script>

@endsection