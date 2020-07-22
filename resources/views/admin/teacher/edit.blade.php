@extends('layouts.admin.app')
@section('content')
<?php

$value =  "yourname@" . $domain->value;

?>
<div class="body-wrapper">
  <section class="main-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10 mt-5">
          <div class="card card-common mb-3 mt-5">
            <div class="card-header">
              <span class="topic-heading">Edit Teacher</span>
            </div>
            <div class="card-body pt-4">
              {!! Form::open(array('route' => ['teacher.edit',$teacher->id],'method'=>'POST','autocomplete'=>'off')) !!}
              <div class="form-group row">
                <label for="colFormLabel" class="col-md-4 col-form-label">Teacher Name:</label>
                <div class="col-md-5">
                  {!! Form::text('fname', $teacher->name, array('placeholder' => 'Your Name','class' => 'form-control','required'=>'required')) !!}
                </div>
              </div>

              <!--<div class="form-group row">
                  <label for="colFormLabel" class="col-md-4 col-form-label">Last Name:</label>
                  <div class="col-md-5">
                      {!! Form::text('lname', $teacher->last_name, array('placeholder' => 'Last Name','class' => 'form-control','required'=>'required')) !!}
                  </div>
                </div> -->

              <div class="form-group row">
                <label for="colFormLabel" class="col-md-4 col-form-label">Email:</label>
                <div class="col-md-5">
                  {!! Form::email('email', $teacher->email, array('placeholder' => $value,'class' => 'form-control','required'=>'required')) !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="colFormLabel" class="col-md-4 col-form-label">Phone:</label>
                <div class="col-md-5">
                  {!! Form::text('phone', $teacher->phone, array('placeholder' => 'Phone','class' => 'form-control','required'=>'required')) !!}
                </div>
              </div>
              {!! Form::hidden('user_gid', $teacher->g_user_id) !!}
              <div class="form-group row">
                <label for="colFormLabel" class="col-md-4 col-form-label">gMeet URL:</label>
                <div class="col-md-5">
                  {!! Form::text('g_meet_url',$teacher->g_meet_url, array('placeholder' => 'gMeet URL','class' => 'form-control')) !!}
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-secondary btn-w140">Submit</button>
                  <a href="{{route('admin.dashboard')}}" class="btn btn-danger ml-3"><i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>Back</a>
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