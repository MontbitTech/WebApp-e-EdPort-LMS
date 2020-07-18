@extends('layouts.admin.app')

@section('content')
<section class="main-section">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Class List</span>
            <div class="float-right">
              <a type="button" class="btn btn-sm btn-success" href="{{route('classes.add')}}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1">
                  <use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use>
                </svg> Create Class
              </a>
            </div>
          </div>
          <div class="card-body pt-3">
            <div class="row justify-content-center">
              <div class="col-md-4 col-lg-3 text-md-left text-center mb-1">
                <!-- <span data-dtlist="#subjectlist" class="mb-1">
                  <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                </span> -->
              </div>
              <div class="col-md-8 col-lg-9 text-md-right text-center mb-1">
                <!-- <span data-dtfilter="#subjectlist" class="mb-1">
                  <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                </span> -->
              </div>

               <div class="col-md-8 col-lg-9 text-md-right text-center mb-1">
         <span data-dtfilter="" class="mb-1">
                  <!-- <div class="spinner-border spinner-border-sm text-secondary" role="status" ></div> 
          <input type="text"  id="txtSerachByClass" class="form-control form-control-sm" placeholder="Search By Class..." />-->
          
          <select id="txtSerachByClass" name="txtSerachByClass" class="form-control form-control-sm" onchange="getSubject()">
          <option value=''>Select Class</option>
            @if(count($classes)>0)
            @foreach($classes as $cl)
              <option value='{{$cl->class_name}}'>{{$cl->class_name}}</option>
            @endforeach
          @endif
          </select>
          
        </span>
        
            <span data-dtfilter="" class="mb-1">
          
           <select id="txtSerachBySection" name="txtSerachBySection" class="form-control form-control-sm" onchange="getSubject()">
            <option value=''>Select Section</option>
            @if(count($section)>0)
            <option value='all'>All</option>
            @foreach($section as $sl)
              <option value='{{$sl->section_name}}'>{{$sl->section_name}}</option>
            @endforeach
          @endif
          </select>
          
        </span>
        
        
              </div>

          <div class="col-sm-12" id='subject'>
          <table id="subjectlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 2, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
          <thead>
            <tr>
            <th>#</th>
             <th>Class</th>
              <th>Section</th>
              <th>Subject</th>
              <th  class="text-center">Link</th>
         <th  class="text-center">Action</th>
            </tr>
          </thead>
          </table>
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
        <h5 class="modal-title font-weight-bold">Delete Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg class="icon">
            <use xlink:href="../images/icons.svg#icon_times2"></use>
          </svg>
        </button>
      </div>
      <div class="modal-body pt-4">
        <form action="{{route('classes.delete')}}" method="POST">
          @csrf
          <input type="hidden" name="txt_class_id" id="txt_class_id" />
          <!-- <div class="form-group text-center">
            <h4>Are You Sure ! </h4>
            <h4>You want to detele this class. </h4>
            <p style="color: #bf2d2d;font-size: 13px;">* if you delete this class, it will auto delete all associated record with this class like assignment, timetable, student, etc... </p>

          </div> -->
          <div class="form-group text-center">
            <h4>Type "delete" to confirm</h4>
          </div>
          <div class="form-group text-center ">
            <input type="text" name="delete" class="form-control" id="delete">

          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-danger px-4">
              Delete
            </button>
            <button type="button" class="btn btn-default" class="close" data-dismiss="modal" aria-label="Close">
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">

$(document).on('click', '[data-deleteModal]', function(){
 var val = $(this).data('deletemodal');
 //alert(val);
  $('#classdeletModal').modal('show');
  $("#txt_class_id").val(val);

  
});
  $(document).ready(function() {
    $('#teacherlist').DataTable({
      initComplete: function(settings, json) {
        $('[data-dtlist="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_length').find("label"));
        $('[data-dtfilter="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_filter').find("input[type=search]").attr('placeholder', $('#' + settings.nTable.id).attr('data-filterplaceholder')))
      }
    });
    $('.dateset').datepicker({
      dateFormat: "yy/mm/dd"
      // showAnim: "slide"
    })
  });

  $(document).on('click', '[data-deleteModal]', function() {
    var val = $(this).data('deletemodal');
    $('#classdeletModal').modal('show');
    $("#txt_class_id").val(val);

  });

</script>

<!-- <script>
  function getSubject(){
  var class_name   = $('#txtSerachByClass').val();
  var section_name = $('#txtSerachBySection').val();

  alert('yyy');
}
</script>
 -->
<script>
    function getSubject(){

       $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
        var txtSerachByClass   = $("#txtSerachByClass").val();
        var txtSerachBySection = $("#txtSerachBySection").val();
        $.ajax({
            url: "{{url('filter-subject')}}",
            type: 'POST',
            data: {
                txtSerachByClass   : txtSerachByClass,
                txtSerachBySection : txtSerachBySection
            },
            success: function(info) {
                $("#subject").html(info);
                $("#subject").show();
            if(txtSerachBySection){
            $('#subjectlist').DataTable({
            initComplete: function(settings, json) {
            $('[data-dtlist="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_length').find("label"));
            $('[data-dtfilter="#'+settings.nTable.id+'"').html($('#'+settings.nTable.id+'_filter').find("input[type=search]").attr('placeholder', $('#'+settings.nTable.id).attr('data-filterplaceholder')))
            }
            });
            $('.dateset').datepicker({
            dateFormat: "yy/mm/dd"
            // showAnim: "slide"
            })
            }
            }
        });
    }
</script>
@endsection