@extends('layouts.admin.app')
@section('content')
<div class="body-wrapper">
  <section class="main-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card card-common mb-3">
            <div class="card-header">
              <span class="topic-heading">Edit Student</span>
            </div>
            <div class="card-body pt-4">
              {!! Form::open(array('route' => ['student.edit',encrypt($student[0]->id)],'method'=>'POST','autocomplete'=>'off')) !!}
              <div class="form-group row">
                <label for="colFormLabel" class="col-md-4 col-form-label">Student Name:</label>
                <div class="col-md-5">
                  {!! Form::hidden('id', $student[0]->id, array('placeholder' => 'Your Name','class' => 'form-control')) !!}
                  {!! Form::text('fname', $student[0]->name, array('placeholder' => 'Your Name','class' => 'form-control','required'=>'required','readonly'=>'readonly')) !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="colFormLabel" class="col-md-4 col-form-label">Email:</label>
                <div class="col-md-5">
                  {!! Form::email('email', $student[0]->email, array('placeholder' => 'yourname@domain.com','class' => 'form-control')) !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="colFormLabel" class="col-md-4 col-form-label">Phone:</label>
                <div class="col-md-5">
                  {!! Form::text('phone', $student[0]->phone, array('placeholder' => 'Phone','class' => 'form-control')) !!}
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-md-4 col-form-label">Class:</label>
                <div class="col-md-5">
                  {!! Form::text('class', $student[0]->class_name, array('placeholder' => 'Class','class' => 'form-control','required'=>'required','readonly'=>'readonly')) !!}
                </div>
              </div>
              <div class="form-group row">
                <label for="colFormLabel" class="col-md-4 col-form-label">Section:</label>
                <div class="col-md-5">
                  {!! Form::text('section', $student[0]->section_name, array('placeholder' => 'Section','class' => 'form-control','required'=>'required','readonly'=>'readonly')) !!}
                </div>
              </div>

              <div class="form-group row">

                <div class="col-md-5 offset-4" style="margin-top: 10px;">
                  @if($student[0]->notify == "yes")
                  {!! Form::checkbox('notify', $student[0]->notify,true) !!}
                  @else
                  {!! Form::checkbox('notify', $student[0]->notify,false) !!}
                  @endif
                  <label for="colFormLabel" class="ml-2">
                    <small> <strong class="text-secondary">
                        SMS notification for student
                      </strong>
                    </small>
                  </label>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn submit-btn btn-w140">Submit</button>
                  <a href="{{route('list.students')}}" class="btn btn-back ml-3"><i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>Back</a>
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