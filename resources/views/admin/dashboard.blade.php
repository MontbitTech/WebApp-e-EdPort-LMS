@extends('layouts.admin.app')

@section('content')
<section class="main-section">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card card-common mb-3">
		
          <div class="card-header">
            <span class="topic-heading">Teachers List</span>
			 <div class="float-right">
              <a type="button" class="btn btn-sm btn-success" href="{{route('admin.sampleTeacherDownload')}}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Download Sample File
              </a>
            </div>
			 <div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-success" href="{{ route('admin.teacherimport') }}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Import Teacher Details
              </a>
            </div>
			
            <div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-info" href="{{route('teacher.add')}}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Add Teacher
              </a>
            </div>
          </div>
          <div class="card-body pt-3">
            <div class="row justify-content-center">
              <div class="col-md-4 col-lg-3 text-md-left text-center mb-1">
                <span data-dtlist="#teacherlist" class="mb-1">
                  <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                </span>
              </div>
              <div class="col-md-8 col-lg-9 text-md-right text-center mb-1">
                <span data-dtfilter="#teacherlist" class="mb-1">
                  <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                </span>
              </div>
              <div class="col-sm-12">
          <table id="teacherlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone No</th>
                <th  class="text-center">gMeet URL</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
           @foreach($teacher as $user)
				<tr>
                  <td>{{++$i}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->phone}}</td>
                  <td  class="text-center">
					@if($user->g_meet_url)
						<a href="{{$user->g_meet_url}}" target="_blank">gMeet URL</a>
					@else
						<a href="javascript:void(0)" ></a>
					@endif
				</td>
                  <td><a href="{{route('teacher.edit', encrypt($user->id))}}">Edit</a> | 
                       <a href="{{ route('teacher.delete', encrypt($user->id)) }}"
                       >
                        {{ __('Delete') }}
                      </a>

             <!--  <form id="delete-teacher-form" action="{{ route('teacher.delete', encrypt($user->id)) }}" method="POST" style="display: none;">
                @csrf
				 onclick="event.preventDefault();
                        document.getElementById('delete-teacher-form').submit();"
              </form> -->
                  </td>
                </tr>
              @endforeach
           
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </div>
	
        <div class="card card-common mb-3">
			@if(count($onGoingClasses) > 0)

          <div class="card-header">
            <span class="topic-heading">On Going Classes</span>
		  </div>
		<div class="card-body pt-3">
			  <div class="col-sm-12">
			  <table id="ongoing" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120">
					<thead>
					  <tr class="text-center">
						<th width="20%">Name</th>
						<th width="10%">Class</th>
						<th width="20%">Subject</th>
						<th width="20%">Time</th>
						<th width="30%">Google Meet</th>
					  </tr>
					</thead>
					<tbody>
					@foreach($onGoingClasses as $ongoing)
						<tr class="text-center">
						  <td>{{$ongoing->name}}</td>
						  <td>{{$ongoing->class_name . " " . $ongoing->section_name}}</td>
						  <td>{{$ongoing->subject_name}}</td>
						  <td>{{date('H:i',strtotime($ongoing->from_timing)) . "-" . date('H:i',strtotime($ongoing->to_timing)) }}</td>
						  <td>
						  @if($ongoing->g_meet_url)
								<a href="{{$ongoing->g_meet_url}}" target="_blank">Join Link</a>
							@else
								<a href="javascript:void(0)" >Join Link</a>
							@endif
						
						  </td>
						</tr>
					@endforeach
					</tbody>
			  </table>
			</div>
        </div>
		@endif
	</div>
	
	
  </div>
</div>
</div>
</section>
<script type="text/javascript">
$(document).ready(function() {
	
	
  $('#teacherlist').DataTable({
    initComplete: function(settings, json) {
      $('[data-dtlist="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_length').find("label"));
      $('[data-dtfilter="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_filter').find("input[type=search]").attr('placeholder', $('#'+settings.nTable.id).attr('data-filterplaceholder')))
    }
  });
  
  
  $('#ongoing').DataTable({
    initComplete: function(settings, json) {
      $('[data-dtlist="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_length').find("label"));
      $('[data-dtfilter="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_filter').find("input[type=search]").attr('placeholder', $('#'+settings.nTable.id).attr('data-filterplaceholder')))
    }
  });
  
  
  $('.dateset').datepicker({
    dateFormat: "yy/mm/dd"
    // showAnim: "slide"
  })
});
</script>
@endsection