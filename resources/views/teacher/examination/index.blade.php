@extends('layouts.teacher.app')
@section('content')
<style>
    .card-header {
        padding-bottom: 4px;
    }
</style>
<section class="main-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-lg-8 col-12">
                @include('teacher.examination.createexam')
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
@endsection