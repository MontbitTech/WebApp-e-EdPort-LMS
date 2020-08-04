@extends('layouts.admin.app')

@section('content')
<style>
  #ongoing_wrapper .row:first-child {
    display: flex;
  }
</style>
<section class="main-section">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card card-common mb-3">

          <div class="card-header">
            <span class="topic-heading">Teachers List</span>
            <div class="float-right mr-3" id="appenddata">

            </div>
            <div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-secondary" href="{{ route('admin.teacherimport') }}">
                <i class="fa fa-upload mr-1 " aria-hidden="true"></i>
                Import Teacher Details
              </a>
            </div>

            <div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-secondary" href="{{route('teacher.add')}}">
                <i class="fa fa-user-plus mr-1" aria-hidden="true"></i>
                Add Teacher
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

                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone No</th>
                      <th class="text-center">gMeet URL</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($teacher as $user)
                    <tr>

                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->phone}}</td>
                      @if($user->g_meet_url)
                      <td class="text-center">
                        <a href="{{$user->g_meet_url}}" target="_blank">gMeet URL</a>
                      </td>
                      @else
                      <td class="text-center ">
                        <a href="{{route('teacher.edit', encrypt($user->id))}}" class="text-danger w-100"> Insert URL</a>
                      </td>
                      @endif
                      <td><a href="{{route('teacher.edit', encrypt($user->id))}}">Edit</a> |
                        <a href="javascript:void(0);" data-deleteModal="{{$user->id}}">
                          {{ __('Delete') }}
                        </a>


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
              <table id="ongoing" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
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
<div class="modal fade" id="studentdeletModal" data-backdrop="static" tabindex="-1" role="dialog">
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
        <form id="deleteform" method="get">
          @csrf
          <input type="hidden" name="txt_student_id" id="txt_student_id" />
          <div class="form-group text-center">
            <h4>Type "delete" to confirm</h4>
          </div>
          <div class="form-group text-center ">
            <input type="text" name="delete" class="form-control" id="delete" required>

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
    var table = $('#teacherlist').DataTable({

      buttons: [{
        extend: 'csvHtml5',
        autoFilter: true,
        sheetName: 'Exported data',
        text: '<i class="fa fa-download mr-1 " aria-hidden="true"></i>Export Teacher Details',
        className: 'btn btn-secondary btn-sm',
        init: function(api, node, config) {
          $(node).removeClass('dt-button')
        },
        exportOptions: {
          columns: [0, 1, 2]
        }

      }],
      initComplete: function(settings, json) {
        $('[data-dtlist="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_length').find("label"));
        $('[data-dtfilter="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_filter').find("input[type=search]").attr('placeholder', $('#' + settings.nTable.id).attr('data-filterplaceholder')))
      },
      "columnDefs": [{
        "width": "16%",
        "targets": 0
      }]
    });
    table.buttons().container()
      .appendTo('#appenddata');
    $('#ongoing').DataTable({
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

    $('#studentdeletModal').modal('show');
    var route = "{{url('admin/delete-teacher')}}" + "/" + val;
    $("#deleteform").attr('action', route);

  });
</script>
@endsection