@extends('layouts.admin.app')

@section('content')

<section class="main-section">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Settings</span>
            <!--<div class="float-right">
              <a type="button" class="btn btn-sm btn-success" href="">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Add Setting
              </a>
            </div>-->
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
          <table id="teacherlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="" data-col1="60" data-collast="" data-filterplaceholder="Search Records ...">
            <thead>
              <tr>
                <th style="width: 30%;">Item</th>
                <th class="padding-left:30%;text-left;">Value</th>
				<th  class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
			 @if(count($settings)>0)
              @php $i=0; @endphp
                @foreach($settings as $st)
                  <tr>
                    <td><div class="padding-left:30%;text-left;">{{$st->item}}</div></td>
                    <td><div class="padding-left:5%;text-left;">
					@if($st->item == "schoollogo")
						
					 <form method="post" id="profile_form" action = "{{route('admin.school_logo')}}" enctype="multipart/form-data">
						 @csrf
						<label class="profile-picture" >
						  <input type="file" name="profile_picture" id="uploadphoto" onchange="readURL(this);" accept=".jpg,.jpeg,.png,.gif">
						  <img src="{{$st->value }}" id="img-preview" width="50px">
						  <span><svg class="icon"><use xlink:href="{{asset('images/icons.svg#icon_pen')}}"></use></svg></span>

						</label>
					  </form>

					@else
						{{$st->value}}
					@endif
					</div>
					</td>
					<td class="text-center">
					@if((strpos($st->permission, 'E') !== false))
						<a href="{{route('setting.edit', encrypt($st->id))}}">Edit</a>
					@endif
					<!--|
						<a href="javascript:void(0);"  data-deleteModal="{{$st->id}}" >{{ __('Delete') }}</a>-->
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


<div class="modal fade" id="classdeletModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light d-flex align-items-center">
        <h5 class="modal-title font-weight-bold">Delete setting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg class="icon"><use xlink:href="../images/icons.svg#icon_times2"></use></svg>
        </button>
      </div>
      <div class="modal-body pt-4">
        <form action="{{route('setting.delete')}}" method="POST">
			@csrf
				<input type="hidden" name="txt_setting_id" id="txt_setting_id"/>
          <div class="form-group text-center">
				<h4>Are You Sure ! </h4> 	
				<h4>You want to detele this setting. </h4>
				<p style="color: #bf2d2d;font-size: 13px;">* if you delete this setting, system might not function correctly or visuals may impact</p>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-warning px-4">
              Delete
            </button>
			<button type="button" class="btn btn-primary" class="close" data-dismiss="modal" aria-label="Close">
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



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

$(document).on('click', '[data-deleteModal]', function(){
 var val = $(this).data('deletemodal');
  $('#classdeletModal').modal('show');
  $("#txt_setting_id").val(val);
  
});

function readURL(input) {

  $('#profile_form').submit();
}

</script>
@endsection