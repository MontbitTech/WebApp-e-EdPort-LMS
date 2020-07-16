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
                <table id="teacherlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="" data-filterplaceholder="Search Records ...">
                  <thead>
                    <tr>
                      <th>Class</th>
                      <th>Section</th>
                      <th>Subject</th>
                      <th class="text-center">Link</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($classes)>0)
                    @php $i=0; @endphp
                    @foreach($classes as $cls)
                    <tr>
                      <td>{{$cls->class_name}}</td>
                      <td>{{$cls->section_name}}</td>
                      <td>{{$cls->studentSubject->subject_name}}</td>
                      <td class="text-center"><a href="{{ $cls->g_link }}" target="_blank">Class Link </a></td>
                      <td class="text-center">
                        <a href="javascript:void(0);" data-deleteModal="{{$cls->id}}">{{ __('Delete') }}</a>
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
@endsection