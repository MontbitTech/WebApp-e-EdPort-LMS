@extends('student.include.layout')
@section('content')

<div class="container">
    <div class="row">
        <div class="teacher-register-box">
            <div class="register-logo">
                <a href="">
                    <img src="{{asset('student/assets/img/logo.png')}}" width="40" alt="[school_name_logo]" class="brand-image ">
                    <b>Delhi Public School</b>
                    <!-- <img src="{{asset('student/assets/img/logo.png')}}" width="3.5rem" alt="[school_name_logo]" class="brand-image"> -->
                </a>
            </div>

            <div class="card">
                <div class="card-body register-card-body">
                    <h4 class="login-box-msg"> Student Admission</h4>

                    <form action="" method="post">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="select_name"> Full Name</label>
                                        <input type="text" class="form-control" id="select_name" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="select_name">Full Name Of Guardian</label>
                                        <input type="text" class="form-control" id="select_name" placeholder="Full Name of Guardian">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">

                                <div class="row">
                                    <div class="col-md-6 mt-1">
                                        <label for="select_dob"> Email</label>
                                        <input type="email" class="form-control" id="select_name" placeholder="Email">
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <label for="select_dob">D.O.B</label>
                                        <input type="date" class="form-control" id="select_name" placeholder="D.O.B">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="row">
                                    <div class="col-md-6 mt-1">
                                        <label for="select_dob">Contact Number</label>
                                        <input type="text" class="form-control" id="select_name" placeholder="Contact Number">
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <label for="select_dob">Guardian's Contact Number </label>
                                        <input type="text" class="form-control" id="select_name" placeholder="Contact Number">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group mb-0 pb-0">

                                            <label for="select_dob">Gender</label>
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <input type="radio" name="radio1">
                                                    <label class="form-check-label">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="radio" name="radio1">
                                                    <label class="form-check-label">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group mb-0 pb-0">


                                            <label for="select_address">Address.</label>
                                            <textarea class="form-control" id="select_address" rows="3" placeholder="Enter ..."></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                        <label for="select_class">Class </label>

                                        <select data-placeholder="Select Class" class="form-control select1" id="select_class" name="select_class">
                                            <option>Select Class </option>
                                            <option>I</option>
                                            <option>II </option>
                                            <option>IX </option>
                                            <option>X </option>
                                            <option>XI </option>
                                            <option>XII </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="select_stream">Stream</label>
                                        <select data-placeholder="Select Stream" class="form-control select1" id="select_stream" name="select_stream">
                                            <option value="pcm">PCM </option>
                                            <option value="pcb">PCB </option>
                                            <option value="Computer">Computer </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <label> Document's</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Birth Certificate</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group align-baseline">

                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Last School Marksheet/report card </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Transfer Certificate</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Character Certificate</label>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="form-group">
                                <label>Declaration</label>
                                <div class="col-12 mt-1">

                                    <label for="checkboxSuccess1" class="form-check-label">
                                        <input type="checkbox" id="checkboxSuccess1">
                                        The information provided in this form is correct to the best of my knowledge.
                                    </label>
                                </div>
                                <div class="col-12 mt-1">

                                    <label for="checkboxSuccess2" class="form-check-label">
                                        <input type="checkbox" id="checkboxSuccess2">
                                        In case of any information furnished by me is found to be incorrect, the school
                                        has the right to take any action it deems fit,
                                        including expulsion at anytime after admission.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-info btn-lg m-auto btn-block" style="width:100px">Send</button>
                </div>
                <a href="login.html" class="text-center">I already have a membership</a>
            </div>

        </div>
    </div>
</div>




@endsection