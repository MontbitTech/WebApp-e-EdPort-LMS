@extends('layouts.admin.app')

@section('content')





<section class="main-section">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Help Tickets</span>
           
          </div>
          <div class="card-body pt-3">
            <div class="row justify-content-center">
              <div class="col-md-4 col-lg-3 text-md-left text-center mb-1">
                <span data-dtlist="#ticketlist" class="mb-1">
					<div class="spinner-border spinner-border-sm text-secondary" role="status"></div> 
                </span>
              </div>
              <div class="col-md-8 col-lg-9 text-md-right text-center mb-1">
                <span data-dtfilter="#ticketlist" class="mb-1">
                   <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                </span>
              </div>
              <div class="col-sm-12">
                <table id="ticketlist" class="table table-sm table-bordered display" data-page-length="100" data-order="[[0, &quot;desc&quot; ]]" style="width:100%" data-page-length="10"data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                  <thead>
                    <tr class="text-center">
                      <th>SNO</th>
                      <th>Teacher Name</th>
                      <th>Class</th>
                      <th>Subject</th>
                      <th>Description</th>
					   <th>Status</th>
                      <th>Class Join link</th>
                      <th>Create Date</th>
                    </tr>
                  </thead>
                 
                    @if(count($support_help) > 0)
                    @php
                      $n = count($support_help);
                      $n-=1;
					  $i = 0;
                    @endphp
                  <tbody id="ticketlist_tbody">
				 
                    @foreach($support_help as $help)
                      <tr>
                        <td>{{++$i}}</td>
                        <td>
                          @if($help->teacher)
                            {{$help->teacher->name}} </br> ( <span style="font-weight:600;font-size:12px;color:#007bff">{{$help->teacher->phone}} </span>)
                          @endif
                        </td>
                        <td class="text-center">
                          @if($help->studentClass)
                           {{($help->help_type == 2)?$help->studentClass->class_name:''}}
                          @endif
						   @if($help->studentClass)
                            {{($help->help_type == 2)?$help->studentClass->section_name:''}}
                          @endif
                        </td>
                       
                        <td>    
                          @if($help->studentSubject)
                            {{($help->help_type == 2)?$help->studentSubject->subject_name:''}}
                          @endif
                        </td>
                        <td>{{isset($help->description)?$help->description:''}}</td>
						 <td>    
                         <select name="status" class="form-control" data-selectStatus="{{ $help->id }}" >
							<option value="1" {{($help->status == 1)?'selected':''}} >Pending</option>
							<option value="2" {{($help->status == 2)?'selected':''}} >In Progress</option>
							<option value="3" {{($help->status == 3)?'selected':''}} >Closed</option>
						 </select>
                        </td>
                        <td class="text-center">
                          @if($help->class_join_link)
                            <a href="javascript:void(0);" data-helplink="{{$help->class_join_link}}" id="{{ $help->id}}" >Join Live</a>
                          @endif
                        </td>
                        <td>
                          <span style="font-size:14px;">{{date("d/m/Y h:i a",strtotime($help->created_at))}} </span>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
				   @endif
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
  
  var tbl = $('#ticketlist').DataTable({
    initComplete: function(settings, json) {
      $('[data-dtlist="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_length').find("label"));
      $('[data-dtfilter="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_filter').find("input[type=search]").attr('placeholder', $('#'+settings.nTable.id).attr('data-filterplaceholder')))
    }
  });
  $('.dateset').datepicker({
    dateFormat: "yy/mm/dd"
    // showAnim: "slide"
  });
  
   $('.ac-time').timepicker({
    controlType: 'select',
    oneLine: true,
    timeFormat: 'hh:mm tt'
  });
  
});


$(document).on('click', '[data-helplink]', function(){
   var liveurl = $(this).attr("data-helplink");
   if(liveurl!=''){
		//$('#viewClassModal').modal('show');
		//$("#thedialog").attr('src','https://google.com');
		window.open(liveurl,"dialog name", "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No assignement url found!');
   }
});

$(document).on('change','[data-selectStatus]', function(){
	var help_id = $(this).attr("data-selectStatus");
	if($(this).val != '')
	{
		var status_id = $(this).val();
		if(help_id != '')
		{
			$.ajax({
					type:'POST',
					url:'{{ route("helpStatus.update") }}',
					headers:{'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
					data:{help_id:help_id,status_id:status_id},
					success:function(data){
						var res = JSON.parse(data);
						$.fn.notifyMe('success',4,res.message);
					},
					error:function(){
						$.fn.notifyMe('error',4,'There is some error while update status!');
					}
				
			});
		}
	}
});

 
</script>
@endsection