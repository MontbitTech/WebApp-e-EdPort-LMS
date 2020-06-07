@extends('layouts.admin.app')
@section('content')  
 <section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Profile</span>
          </div>
          <div class="card-body pt-4">
              {!! Form::open(array('route' => ['admin.profile'],'method'=>'POST','autocomplete'=>'off')) !!}
				 <div class="form-group row">
                  <label for="colFormLabel" class="col-md-4 col-form-label">First Name:</label>
                  <div class="col-md-5">
                    {!! Form::text('fname',$first_name,array('class' => 'form-control','required'=>'required')) !!}
                </div>
                </div>
				
				 <div class="form-group row">
                  <label for="colFormLabel" class="col-md-4 col-form-label">Last Name:</label>
                  <div class="col-md-5">
                    {!! Form::text('lname',$last_name,array('class' => 'form-control','required'=>'required')) !!}
                </div>
                </div>
			  
                <div class="form-group row">
                  <label for="colFormLabel" class="col-md-4 col-form-label">Email:</label>
                  <div class="col-md-5">
                    {!! Form::text('email',$email,array('class' => 'form-control','disabled')) !!}
                </div>
                </div>
               <div class="form-group row">
                  <label for="colFormLabel" class="col-md-4 col-form-label">Phone No:</label>
                  <div class="col-md-5">
                    {!! Form::text('phone_no',$phone_no,array('class' => 'form-control','required'=>'required')) !!}
                </div>
              </div>
                <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary btn-w140">Submit</button>
                    <a href="{{route('admin.dashboard')}}" class="btn btn-danger">Back</a>
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