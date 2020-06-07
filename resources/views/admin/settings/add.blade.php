@extends('layouts.admin.app')
@section('content')  
<?php 


?>

 <section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Create New Setting</span>
          </div>
			<div class="card-body pt-4">
				  {!! Form::open(array('route' => ['setting.add'],'method'=>'POST','autocomplete'=>'off')) !!}
				<div class="row">
				<div class="col-md-12">	
					<div class="form-group row">
					  <label for="colFormLabel" class="col-md-4 col-form-label">Item:</label>
					  <div class="col-md-4">
						<!--  {!! Form::text('class_name', null, array('placeholder' => 'Class Name','class' => 'form-control','required'=>'required','pattern'=>'[a-zA-Z0-9]+')) !!} -->
						 {!! Form::text('item', "", null,array('class' => 'form-control','required'=>'required', 'placeholder'=>'Enter Item name')) !!}
					 </div>
					</div>
					
					<div class="form-group row">
					  <label for="colFormLabel" class="col-md-4 col-form-label">Value:</label>
					  <div class="col-md-4">
						  {!! Form::text('ivalue', "", null,array('class' => 'form-control','required'=>'required', 'placeholder'=>'Enter Value')) !!}
					  </div>
					</div>
				</div>
			
				</div>
				<div class="row">
			
					<div class="col-md-12">
						<div class="form-group row">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary btn-w140">Submit</button>
								<a href="{{route('admin.listClass')}}" class="btn btn-danger">Back</a>
						   </div>
						 </div>
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