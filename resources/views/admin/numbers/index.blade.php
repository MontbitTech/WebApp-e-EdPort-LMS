@extends('layouts.admin.app')

@section('content')

<section class="main-section">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Student List</span>

            <div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-secondary" href="{{route('admin.studentsimport')}}">

                <i class="fas fa-file-import icon-4x mr-1"></i>
                Import Students
              </a>
            </div>
            <div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-secondary" href="{{route('student.add')}}">
                <i class="fa fa-user-graduate mr-1" aria-hidden="true"></i>
                Add Student
              </a>
            </div>
          </div>
          <div class="card-body pt-3">
            <div class="row justify-content-center">
              <!--div class="col-md-4 col-lg-3 text-md-left text-center mb-1">
              <span data-dtlist="#teacherlist" class="mb-1">
                  <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                </span> 
              </!--div>
              <div-- class="col-md-8 col-lg-9 text-md-right text-center mb-1">
               <span data-dtfilter="#teacherlist" class="mb-1">
                  <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                </span> 
              </div-->

              <div class="col-md-6 col-lg-6 text-md-left text-center mb-1">
                <span data-dtfilter="" class="mb-1">
                  <!-- <div class="spinner-border spinner-border-sm text-secondary" role="status" ></div> 
                     <input type="text"  id="txtSerachByClass" class="form-control form-control-sm" placeholder="Search By Class..." />-->

                  <select id="txtSerachClass" name="txtSerachClass" class="form-control form-control-sm" onchange="getStudent()">
                    <option value=''>Select Division</option>
                    @if(count($classes)>0)
                    <option value='all-class'>All</option>
                    @foreach($classes->unique('class_name') as $cl)
                    <option value='{{$cl->class_name}}'>{{$cl->class_name}}</option>
                    @endforeach
                    @endif
                  </select>

                </span>

                <span data-dtfilter="" class="mb-1">

                  <select id="txtSerachSection" name="txtSerachSection" class="form-control form-control-sm" onchange="getStudent()">
                    <option value=''>Select Section</option>
                    @if(count($sections)>0)
                    <option value='all-section'>All</option>
                    @foreach($sections->unique('section_name') as $sl)
                    <option value='{{$sl->section_name}}'>{{$sl->section_name}}</option>
                    @endforeach
                    @endif
                  </select>

                </span>


              </div>
              <div class="col-md-6 col-lg-6 text-md-right text-center mb-1">
                <!-- id="appenddata"> -->
                <button style="display:none;" id="deleteall" class="btn btn-sm btn-secondary float-right delete_all"" data-url=" {{ url('admin/deleteAllStudent') }}"><i class="fa fa-trash mr-1 " aria-hidden="true"></i>Delete</button>
                <span class="float-right mr-2" id="appenddata"></span>
              </div>
              <div class="col-sm-12" id="student">
                <table id="studentlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 0, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                  <thead>
                    <tr>
                      <th>Division</th>
                      <th>Section</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>SMS Notification</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i=0; @endphp
                    @foreach($students as $list)
                    <tr>
                      <td>{{$list->class->class_name}}</td>
                      <td>{{$list->class->section_name}}</td>
                      <td>{{$list->name}}</td>
                      <td>{{$list->email}}</td>
                      <td>{{$list->phone}}</td>
                      <td>
                        @if ($list->notify=="yes")
                        <input type="checkbox" checked disabled>
                        @else
                        <input type="checkbox" disabled>
                        @endif
                      </td>
                      <td>
                        <a href="{{route('student.edit', encrypt($list->id))}}">Edit</a> |
                        <a href="#" data-deleteModal="{{$list->id}}" class='deleteStudent' value='{{$list->id}}'>
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
        <form action="{{url('/admin/delete-student/1')}}" method="POST">
          @csrf
          <input type="hidden" name="txt_student_id" id="txt_student_id" />
          <!-- <div class="form-group text-center">
            <h4>Are You Sure ! </h4>
            <h4>You want to detele this class. </h4>
            <p style="color: #bf2d2d;font-size: 13px;">* if you delete this class, it will auto delete all associated record with this class like assignment, timetable, student, etc... </p>

          </div> -->
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#studentlist').DataTable({
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

  $(document).on('click', '.deleteStudent', function() {
    var val = $(this).attr('value');
    $('#classdeletModal').modal('show');
    $("#txt_student_id").val(val);

  });
</script>

<script>
  function getStudent() {
    $(".buttons-csv").remove();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var txtSerachClass = $("#txtSerachClass").val();
    var txtSerachSection = $("#txtSerachSection").val();
    $.ajax({
      url: "{{url('filter-student')}}",
      type: 'POST',
      data: {
        txtSerachClass: txtSerachClass,
        txtSerachSection: txtSerachSection
      },
      success: function(info) {
        $("#student").html(info);
        $("#student").show();
      }
    });
    var txtSerachClass = $("#txtSerachClass").val();
    var txtSerachSection = $("#txtSerachSection").val();
    $.ajax({
      url: "{{url('filter-student')}}",
      type: 'POST',
      data: {
        txtSerachClass: txtSerachClass,
        txtSerachSection: txtSerachSection
      },
      success: function(info) {
        $("#student").html(info);
        $("#student").show();
        $("#deleteall").show();
        if (txtSerachClass) {
          var table = $('#studentlist').DataTable({
            'dom': 'Brtip',
            buttons: [{
              extend: 'csvHtml5',
              autoFilter: true,
              sheetName: 'Exported data',
              text: '<i class="fas fa-file-export mr-1 icon-2x"  ></i>Export Student  Details',
              className: 'btn btn-secondary btn-sm ml-2',
              init: function(api, node, config) {
                $(node).removeClass('dt-button')
              },
              exportOptions: {
                columns: [3, 1, 2, 4, 5]
              },

              customize: function(csv) {
                var csvRows = csv.split();
                csvRows[0] = csvRows[0].replace('"Name"', '"name"')
                csvRows[0] = csvRows[0].replace('"Division"', '"class"')
                csvRows[0] = csvRows[0].replace('"Section"', '"section"')
                csvRows[0] = csvRows[0].replace('"Email"', '"email"')
                csvRows[0] = csvRows[0].replace('"Phone"', '"phone"')
                return csvRows;
              }

            }],
            initComplete: function(settings, json) {
              $('[data-dtlist="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_length').find("label"));
              $('[data-dtfilter="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_filter').find("input[type=search]").attr('placeholder', $('#' + settings.nTable.id).attr('data-filterplaceholder')))
            }
          });
          table.buttons().container()
            .appendTo('#appenddata');
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