@extends('layouts.admin.app')
@section('content')
<div class="body-wrapper">
  <section class="main-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card card-common mb-3">
            <div class="card-header">
              <span class="topic-heading">Add Student</span>
            </div>
            <div class="card-body pt-4">
              {!! Form::open(array('route' => ['student.add'],'method'=>'POST','autocomplete'=>'off')) !!}
              <div class="form-group row">
                <label for="colFormLabel" class="col-md-4 col-form-label">Student Name:</label>
                <div class="col-md-5">
                  {!! Form::text('fname', "", array('placeholder' => "Student's Name",'class' => 'form-control','required'=>'required')) !!}
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-md-4 col-form-label">Class:</label>
                <div class="col-md-5">
                  {!! Form::select('class', $data['class'], null,array('class' => 'form-control','required'=>'required')) !!}
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-md-4 col-form-label">Section:</label>
                <div class="col-md-5">
                  {!! Form::select('section', $data['section'], null,array('class' => 'form-control','required'=>'required')) !!}
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-md-4 col-form-label">Email:</label>
                <div class="col-md-5">
                  {!! Form::email('email', "", array('placeholder' => 'studentname@domain.com','class' => 'form-control','required'=>'required')) !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="colFormLabel" class="col-md-4 col-form-label">Phone:</label>
                <div class="col-md-5">
                  {!! Form::text('phone', "", array('placeholder' => 'Phone','class' => 'form-control','required'=>'required')) !!}
                </div>
              </div>

              <div class="form-group row mt-0">

                <div class="col-md-5   offset-md-4">
                  {!! Form::checkbox('notify', "no", false, array('placeholder' => 'Section','class' => 'ml-2')) !!}
                  <label for="colFormLabel" class="ml-2">
                    <small> <strong class="text-secondary">
                        Notification For Student
                      </strong>
                    </small>
                  </label>
                </div>

              </div>

              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-secondary btn-w140">Submit</button>
                  <a href="{{route('list.students')}}" class="btn btn-danger"> <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>Back</a>
                </div>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection