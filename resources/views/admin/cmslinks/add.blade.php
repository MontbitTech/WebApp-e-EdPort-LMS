@extends('layouts.admin.app')
@section('content')  
  <div class="body-wrapper">    
  <section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Add CMS Link</span>
          </div>
          <div class="card-body pt-4"> 
                  {!! Form::open(array('route' => ['cms.addlink'],'method'=>'POST','autocomplete'=>'off')) !!}
                   <div class="form-group row">
                  <label for="colFormLabel" class="col-md-4 col-form-label">Class:</label>
                  <div class="col-md-5">
                   {!! Form::select('class', $data['class'], null,array('class' => 'form-control','required'=>'required')) !!}
                  </div>
                </div>
							
                <div class="form-group row">
					<label for="colFormLabel" class="col-md-4 col-form-label">Subject:</label>
					<div class="col-md-5">
						<select name='subject' class='form-control'>
							<option value="">Select Subject</option>
							@foreach($subjects as $subject)
							
							<option value="{{$subject->id}}">{{$subject->subject_name}}</option>
							@endforeach
						</select>
					</div>
                </div>
				
				<div class="form-group row">
					<label for="colFormLabel" class="col-md-4 col-form-label">Topic:</label>
					<div class="col-md-5">
                    {!! Form::text('topic', "", array('placeholder' => 'Topic','class' => 'form-control')) !!}
					</div>
                </div>

          <div class="form-group row">
          <label for="colFormLabel" class="col-md-4 col-form-label">URL:</label>
          <div class="col-md-5">
                    {!! Form::text('link', "", array('placeholder' => 'URL','class' => 'form-control')) !!}
          </div>
                </div>

        <div class="form-group row">
          <label for="colFormLabel" class="col-md-4 col-form-label">Youtube URL:</label>
          <div class="col-md-5">
                    {!! Form::text('youtube', "", array('placeholder' => 'Youtube URL','class' => 'form-control')) !!}
          </div>
                </div>

          <div class="form-group row">
          <label for="colFormLabel" class="col-md-4 col-form-label">Wikipedia URL:</label>
          <div class="col-md-5">
          {!! Form::text('others', "", array('placeholder' => 'Wikipedia URL','class' => 'form-control')) !!}
          </div>
          </div>

          <div class="form-group row">
          <label for="colFormLabel" class="col-md-4 col-form-label">Academic URL:</label>
          <div class="col-md-5">
                    {!! Form::text('khan_academy', "", array('placeholder' => 'Academic URL','class' => 'form-control')) !!}
          </div>
                </div>

        <div class="form-group row">
          <label for="colFormLabel" class="col-md-4 col-form-label">Assignment URL:</label>
          <div class="col-md-5">
                    {!! Form::text('alink', "", array('placeholder' => 'Assignment URL','class' => 'form-control')) !!}
          </div>
                </div>
                 
				 
                   <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary btn-w140">Submit</button>
                        <a href="{{route('admincms.listtopics')}}" class="btn btn-danger">Back</a>
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