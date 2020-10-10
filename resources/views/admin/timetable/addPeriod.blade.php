@extends('layouts.admin.app')
@section('content')
<?php


?>

<section class="main-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="card card-common mb-3 mt-5">
					<div class="card-header">
						<span class="topic-heading">Create Extra Lecture</span>
					</div>
					<div class="card-body pt-4">
						{!! Form::open(array('route' => ['add.extracalss'],'method'=>'POST','autocomplete'=>'off')) !!}





						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Division:</label>
							<div class="col-md-6">

								<select name="class_id" id="class_id" class="form-control" required>
									<option value=""> Select Division </option>
									<?php
									foreach ($data['classData'] as $row) {
									?>

										<option value="<?= $row->id; ?>"> <?= 'Class ' . $row->class_name . ' - ' . $row->section_name . ' - ' . $row->subject_name; ?></option>
									<?php
									}

									?>
								</select>
							</div>
						</div>


						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Date:</label>
							<div class="col-md-6">
								<!--  {!! Form::select('days', $days, null,array('class' => 'form-control','required'=>'required')) !!} -->
								{!! Form::text('class_date', null, array('placeholder' => 'DD MM YYYY','class' => 'form-control ac-datepicker','required'=>'required',"onkeydown"=>"return false;")) !!}

							</div>
						</div>

						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Start Time :</label>
							<div class="col-md-6">
								{!! Form::text('start_time', null, array('placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required',"onkeydown"=>"return false;")) !!}
							</div>

						</div>

						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">End Time:</label>
							<div class="col-md-6">
								{!! Form::text('end_time', null, array('placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required',"onkeydown"=>"return false;")) !!}
							</div>
						</div>
						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Teacher:</label>
							<div class="col-md-6">
								{!! Form::select('teacher',$data['teacher'], null,array('class' => 'form-control','required'=>'required')) !!}
							</div>
						</div>
						<!--	<div class="form-group row">
												<label for="colFormLabel" class="col-md-4 col-form-label">Is Lunch:</label>
												<div class="col-md-8">
												{!! Form::checkbox('islunch',1,null, array('class' => 'form-control')) !!}
												</div>
											</div>
														-->

						<div class="form-group row">
							<label for="colFormLabel" class="col-md-4 col-form-label">Recurring:</label>
							<div class="col-md-6">
							{!! Form::select('recurring_days[]',$days,null,array('multiple'=>'multiple', 'id'=>'recurring_days', 'class' => 'multi-select','style'=>'width:100%','data-placeholder'=>'Select Days')) !!}
							</div>
						</div>





						<div class="form-group row">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn submit-btn btn-w140">Submit</button>
								<a href="{{route('list.timetable')}}" class="btn btn-back ml-3"><i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>Back</a>
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
			dateFormat: 'd M yy',
			minDate: 0, // 0 days offset = today
			// maxDate: 'today',
		});
		$('.ac-time').timepicker({
			controlType: 'select',
			oneLine: true,
			timeFormat: 'hh:mm tt'
		});
		$(function() {
		$('.multi-select').select2();
	})
	});
</script>
@endsection