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
						<span class="topic-heading">Edit Classroom</span>
					</div>
					<div class="card-body pt-4">
						{!! Form::open(array('route' => ['classes.edit',$classes->id],'method'=>'POST','autocomplete'=>'off')) !!}
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									<label for="colFormLabel" class="col-md-4 col-form-label">Division:</label>
									<div class="col-md-4">
										<!--  {!! Form::text('class_name', null, array('placeholder' => 'Class Name','class' => 'form-control','required'=>'required','pattern'=>'[a-zA-Z0-9]+')) !!} -->
										{!! Form::select('', $data['class'], $classes->class_name,array('class' => 'form-control','required'=>'required','disabled')) !!}
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabel" class="col-md-4 col-form-label">Subjects:</label>
									<div class="col-md-4">
										{!! Form::select('', $data['subject'], $classes->subject_id ,array('class' => 'form-control','required'=>'required','disabled')) !!}
									</div>
								</div>

								<div class="form-group row">
									<label for="colFormLabel" class="col-md-4 col-form-label">Section :</label>
									<div class="col-md-4">
										<!--	{!! Form::text('section', null, array('placeholder' => 'Section','class' => 'form-control','required'=>'required')) !!} -->
										{!! Form::select('section', $data['section'], $classes->section_name ,array('class' => 'form-control','required'=>'required')) !!}
									</div>

								</div>
							</div>

							<input type="hidden" name="g_class_id" value="$classes->g_class_id" />
							<input type="hidden" name="class_name" value="$classes->class_name" />
							<input type="hidden" name="subject_id" value="$classes->subject_id" />
							<input type="hidden" name="old_section_name" value="$classes->section_name" />

						</div>
						<div class="row">

							<div class="col-md-12">
								<div class="form-group row">
									<div class="col-md-6 offset-md-4">
										<button type="submit" class="btn submit-btn btn-w140">Submit</button>
										<a href="{{route('admin.listClass')}}" class="btn btn-back">Back</a>
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

<script type="text/javascript">
	$(document).ready(function() {
		$('.ac-datepicker').datepicker({
			dateFormat: 'd M yy'
		});
		$('.ac-time').timepicker({
			controlType: 'select',
			oneLine: true,
			timeFormat: 'hh:mm tt'
		});
	});
</script>
@endsection