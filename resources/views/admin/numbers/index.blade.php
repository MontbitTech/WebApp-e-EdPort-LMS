@extends('layouts.admin.app')

@section('content')
<section class="main-section">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Student Details</span>
			 <div class="float-right">
              <a type="button" class="btn btn-sm btn-success" href="{{route('admin.sampleStudentsDownload')}}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Download Sample File
              </a>
            </div>
            <div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-success" href="{{route('admin.studentsimport')}}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Import Student Details
              </a>
            </div>
			<div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-info" href="{{route('student.add')}}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Add Student Details
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
          <table id="teacherlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 2, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Class</th>
                <th>Section</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Notify</th>
				<th>Action</th>
              </tr>
            </thead>
            
          <tbody>
           @if(count($lists)>0)
              @php $i=0; @endphp
                @foreach($lists as $list)
                  <tr>
                    <td>{{++$i}}</td>
                    <td>{{$list->name}}</td>
                    <td>{{$list->class_name}}</td>
                    <td>{{$list->section_name}}</td>
                    <td>{{$list->email}}</td>
                    <td>{{$list->phone}}</td>
                    <td>
						@if ($list->notify=="yes")
							<input type="checkbox" checked disabled>
						@else
							<input type="checkbox"  disabled>
						@endif
					</td>
					<td>
						<a href="{{route('student.edit', encrypt($list->id))}}">Edit</a> | 
						<a href="#"
						onclick="event.preventDefault();
						document.getElementById('delete-student-form{{$list->id}}').submit();">
						{{ __('Delete') }}
						</a>

					  <form id="delete-student-form{{$list->id}}" action="{{ route('student.delete',encrypt($list->id)) }}" method="POST" style="display: none;">
						@csrf
					  </form>
                  </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
        </div>
      </div>
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
  $('.dateset').datepicker({
    dateFormat: "yy/mm/dd"
    // showAnim: "slide"
  })
});
</script>
@endsection