@extends('layouts.admin.app')
@section('content')  

 <section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Edit Setting</span>
          </div>
			<div class="card-body pt-4">Setting
				  {!! Form::open(array('route' => ['setting.edit',encrypt($settings->id)],'method'=>'POST','autocomplete'=>'off')) !!}
				<div class="row">
				<div class="col-md-12">	
						<div class="form-group row">
						  <label for="colFormLabel" class="col-md-4 col-form-label">Item</label>
						  <div class="col-md-4">
							<!--  {!! Form::text('class_name', null, array('placeholder' => 'Class Name','class' => 'form-control','required'=>'required','pattern'=>'[a-zA-Z0-9]+')) !!} -->
							 {!! Form::text('item', $settings->item,array('class' => 'form-control','required'=>'required','disabled')) !!}
						 </div>
						</div>
						
						<div class="form-group row">
						  <label for="colFormLabel" class="col-md-4 col-form-label">Value:</label>
						  <div class="col-md-4">
							  {!! Form::text('ivalue', $settings->value ,array('class' => 'form-control','required'=>'required')) !!}
						  </div>
						</div>
				</div>
			
				<input type="hidden" name="id" value="{{$settings->id}}"/>
			
				</div>
				<div class="row">
			
					<div class="col-md-12">
						<div class="form-group row">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary btn-w140">Submit</button>
								<a href="{{route('admin.settings')}}" class="btn btn-danger">Back</a>
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

  
$(document).ready(function(){
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