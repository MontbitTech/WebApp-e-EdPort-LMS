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
{{--                @include('teacher.examination.exam')--}}
{{--                @include('teacher.examination.questionadd')--}}
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

                        <div class="card-footer card-border-exam clearfix">
                            <a href="javascript:void(0)" class="btn btn-sm btn-info" style="width:100%;background-color: #373c8e;">Assign</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('js/examination.js')}}"></script>
@endsection