@extends('layouts.admin.app')

@section('content')

<section class="main-section">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Time Table</span>
            <div class="float-right">
              <a type="button" class="btn btn-sm btn-success" href="{{route('admin.timetableimport')}}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Import Time Table
              </a>
            </div>
			 <div class="float-right  mr-3">
              <a type="button" class="btn btn-sm btn-success" href="{{route('add.extracalss')}}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Add ExtraClass
              </a>
            </div>
			<!-- <div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-success" href="{{route('admin.sampleDownload')}}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Download Sample File
              </a>
            </div> -->
          </div>
          <div class="card-body pt-3">
            <div class="row justify-content-center">
              <div class="col-md-4 col-lg-3 text-md-left text-center mb-1">
                <span data-dtlist="#teacherlist" class="mb-1">
                 <!--  <div class="spinner-border spinner-border-sm text-secondary" role="status"></div> -->
				 <a href='' target='_blank' id='download' style='display:none;'>Download/View</a>
                </span>
              </div>
              <div class="col-md-8 col-lg-9 text-md-right text-center mb-1">
				 <span data-dtfilter="" class="mb-1">
                  <!-- <div class="spinner-border spinner-border-sm text-secondary" role="status" ></div> 
				  <input type="text"  id="txtSerachByClass" class="form-control form-control-sm" placeholder="Search By Class..." />-->
				  
				  <select id="txtSerachByClass" name="txtSerachByClass" class="form-control form-control-sm" onchange="getData()">
					<option value=''>Select Class</option>
				    @if(count($class)>0)
						@foreach($class as $cl)
							<option value='{{$cl->class_name}}'>{{$cl->class_name}}</option>
						@endforeach
					@endif
				  </select>
				  
				</span>
			  
                <span data-dtfilter="" class="mb-1">
                  <!-- <div class="spinner-border spinner-border-sm text-secondary" role="status" ></div> 
				  <input type="text"  id="txtSerachBySection" class="form-control form-control-sm" placeholder="Search By Section..." />-->
				  
				   <select id="txtSerachBySection" name="txtSerachBySection" class="form-control form-control-sm"onchange="getData()">
				   	<option value=''>Select Section</option>
				    @if(count($section)>0)
						@foreach($section as $sl)
							<option value='{{$sl->section_name}}'>{{$sl->section_name}}</option>
						@endforeach
					@endif
				  </select>
				  
				</span>
				
				
              </div>
			 
			   
              <div class="col-sm-12" id='timetable'>
				  <table id="teacherlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 2, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
					<thead>
					  <tr>
						<th id='classname' ></th>
						<th>Time</th>
						<th>Monday</th>
						<th>Tuesday</th>
						<th>Wednesday</th>
						<th>Thursday</th>
						<th>Friday</th>
						<th>Saturday</th>
					  </tr>
					</thead>
				  </table>
			  </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</section>

<script>
    function getData()
    {
        var cl = document.getElementById("txtSerachByClass");
        var sl = document.getElementById("txtSerachBySection");
        var dl = document.getElementById("download");
        var tt = document.getElementById("timetable");
        var url = "{{ route('list.filtertimetable') }}";
		
		if(cl.value == ""){
			cl.focus();
			return false;
		}
		else if(sl.value == ""){
			sl.focus();
			return false;
		}
		else{
			$.ajax({
				
				url: url,
				type: "POST",
				data: {txtclass:cl.value,txtsubject:sl.value},
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				/* contentType: false,
				cache: false,
				processData:false, */
				success: function(data)
				{
					tt.innerHTML = data["html"];
					if( data["data"] != "")
					{	dl.href= "{{ url('/dl-timetable')}}" +"/"+cl.value+"_"+sl.value+"_timetable.pdf";
						dl.style.display = "block";
					}
				}
			});	
		}
    }   
</script>

<!--
<script type="text/javascript">
$(document).ready(function() {
		  var table = $('#teacherlist').DataTable({
			  
			    dom: 'Bfrtip',
				
			/* 	lengthMenu: [
						[ 10, 25, 50,100, -1 ],
						[ '10', '25', '50','100', 'all' ]
				], */
				buttons: [
					//'pageLength',
					//'pdf'
				],
				"searching": false,
				
		    /*  initComplete: function(settings, json) {
			  
			  $('[data-dtlist="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_length').find("label"));
			  
			  $('[data-dtfilter="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_filter').find("input[type=search]").attr('placeholder', $('#'+settings.nTable.id).attr('data-filterplaceholder')))
			}, */ 
			
		  });
		  $('.dateset').datepicker({
			dateFormat: "yy/mm/dd"
			// showAnim: "slide"
		  })

		  
		// $('#teacherlist').DataTable();
		 
		// #column3_search is a <input type="text"> element
		$('#txtSerachBySection').on( 'keyup', function () {
			table
				.columns( 3 )
				.search( this.value )
				.draw();
		} );

		$('#txtSerachByClass').on( 'keyup', function () {
			table
				.columns( 2 )
				.search( this.value )
				.draw();
		} );

		
		
		
		
});

</script>
-->

@endsection