@extends('layouts.admin.app')

@section('content')
<section class="main-section">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">CMS Details</span>
			 <div class="float-right">
              <a type="button" class="btn btn-sm btn-success" href="{{route('cms.sampleCMSLinksDownload')}}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Download Sample File
              </a>
            </div>
            <div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-success" href="{{route('cms.cmslinksimport')}}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Import CMS Details
              </a>
            </div>
			<div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-info" href="{{route('cms.addlink')}}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Add CMS Details
              </a>
            </div>
          </div>
          <div class="card-body pt-3">
            <div class="row justify-content-center">
              <div class="col-md-4 col-lg-3 text-md-left text-center mb-1">
                <!-- <span data-dtlist="#teacherlist" class="mb-1">
                  <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                </span> -->
              </div>
              <div class="col-md-8 col-lg-9 text-md-right text-center mb-1">
                <!-- <span data-dtfilter="#teacherlist" class="mb-1">
                  <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                </span> -->
              </div>

      <div class="col-md-8 col-lg-9 text-md-right text-center mb-1">
         <span data-dtfilter="" class="mb-1">
                  <!-- <div class="spinner-border spinner-border-sm text-secondary" role="status" ></div> 
          <input type="text"  id="txtSerachByClass" class="form-control form-control-sm" placeholder="Search By Class..." />-->
          
          <select id="txtSerachClass" name="txtSerachClass" class="form-control form-control-sm" onchange="getRecord()">
          <option value=''>Select Class</option>
            @if(count($classes)>0)
            @foreach($classes as $cl)
              <option value='{{$cl->class_name}}'>{{$cl->class_name}}</option>
           @endforeach
          @endif
          </select>

        </span>
        
            <span data-dtfilter="" class="mb-1">
          
           <select id="txtSerachSubject" name="txtSerachSubject" class="form-control form-control-sm" onchange="getRecord()">
            <option value=''>Select Section</option>
            @if(count($subjects)>0)
            @foreach($subjects->unique('subject_name') as $sl)
              <option value='{{$sl->id}}'>{{$sl->subject_name}}</option>
            @endforeach
          @endif
          </select>
          
        </span>
        
        
              </div>

          <div class="col-sm-12" id="cms">
          <table id="cmsrecords" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 2, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
            <thead>
               <tr>
                <th>#</th>
                <th>Class</th>
                <th>Subject</th>
                <th>Topic</th>
                <th>Link</th>
                <th>Assignment Link</th>
                <th>Action</th>
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
<script type="text/javascript">
$(document).ready(function() {
  $('#teacher').DataTable({
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

<script>
    function getRecord(){

       $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
        var txtSerachClass   = $("#txtSerachClass").val();
        var txtSerachSubject = $("#txtSerachSubject").val();
        $.ajax({
            url: "{{url('filter-record')}}",
            type: 'POST',
            data: {
                txtSerachClass   : txtSerachClass,
                txtSerachSubject : txtSerachSubject
            },
            success: function(info) {
                $("#cms").html(info);
                $("#cms").show();
            }
        });
    }
</script>
@endsection