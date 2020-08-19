@extends('layouts.admin.app')
@section('content')
<?php


?>

<section class="main-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 mt-5">
				<div class="card card-common mb-3 mt-5">
					<div class="card-header">
						<span class="topic-heading">Add Classroom</span>
					</div>
					<div class="card-body pt-4">
						{!! Form::open(array('route' => ['classes.add'],'method'=>'POST','autocomplete'=>'off')) !!}


						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Division:</label>
							<div class="col-md-6">
								<!--  {!! Form::text('class_name', null, array('placeholder' => 'Class Name','class' => 'form-control','required'=>'required','pattern'=>'[a-zA-Z0-9]+')) !!} -->
								{!! Form::select('class_name', $data['class'], null,array('class' => 'form-control','required'=>'required')) !!}
							</div>
						</div>

						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Section :</label>
							<div class="col-md-6">
								<!--	{!! Form::text('section', null, array('placeholder' => 'Section','class' => 'form-control','required'=>'required')) !!} -->
								{!! Form::select('section', $data['section'], null,array('class' => 'form-control','required'=>'required')) !!}
							</div>

						</div>

						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Subjects:</label>
							<div class="col-md-6">
								{!! Form::select('subject[]', $data['subject'], null,array('multiple'=>'multiple', 'id'=>'subject', 'class' => 'subject','required'=>'required','style'=>'width:100%','data-placeholder'=>'Select Subjects')) !!}
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn submit-btn btn-w140">Submit</button>
								<a href="{{route('admin.listClass')}}" class="btn btn-back ml-3"> <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>Back</a>
							</div>
						</div>



						{!! Form::close() !!}

					</div>

				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$(function() {
		$('#subject').select2();
	})
</script>

@endsection