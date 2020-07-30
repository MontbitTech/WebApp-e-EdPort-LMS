@extends('layouts.admin.app')

@section('content')
<section class="main-section">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">CMS Details</span>

            <div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-secondary" href="{{route('cms.cmslinksimport')}}">
                <i class="fa fa-upload mr-1 " aria-hidden="true"></i>
                Import CMS Details
              </a>
            </div>
            <div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-secondary" href="{{route('cms.addlink')}}">
                <i class="fa fa-user-plus mr-1" aria-hidden="true"></i>
                Add CMS Details
              </a>
            </div>
          </div>
          <div class="card-body pt-3">
            <div class="row justify-content-center">
              <!--div class="col-md-4 col-lg-3 text-md-left text-center mb-1">
            <span data-dtlist="#teacherlist" class="mb-1">
                  <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                </span> 
              </!--div-->
              <!--div class="col-md-8 col-lg-9 text-md-right text-center mb-1">
                <span data-dtfilter="#teacherlist" class="mb-1">
                  <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                </span>
              </!--div-->
              <div class="col-md-6 col-lg-6 text-md-left text-center mb-1" id="appenddata">
                <button style="float: left;display:none;" id="deleteall" class="btn btn-sm btn-secondary delete_all" data-url="{{ url('admin/cmsDeleteAll') }}"> <i class="fa fa-trash mr-1 " aria-hidden="true"></i>Delete Selected</button>

              </div>
              <div class="col-md-6 col-lg-6 text-md-right text-center mb-1">
                <!-- <div class="spinner-border spinner-border-sm text-secondary" role="status" ></div> 
          <input type="text"  id="txtSerachByClass" class="form-control form-control-sm" placeholder="Search By Class..." />-->
                <span data-dtfilter="" class="mb-1">
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
                    <option value=''>Select Subject</option>
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
                      <th>Class</th>
                      <th>Subject</th>
                      <th>Topic</th>
                      <th>e-EdPort</th>
                      <th>Youtube</th>
                      <th>Wikipedia</th>
                      <th>My School</th>
                      <th>Assignment</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($cms)>0)
                    @php $i=0; @endphp

                    @foreach($cms as $list)

                    <tr>
                      <td class="text-center">{{$list->class}}</td>
                      <td>{{$list->Subject->subject_name}}</td>
                      <td>{{$list->topic}}</td>

                      @if($list->link)
                      <td class="text-center">
                        <a href="{{$list->link}}" target="_blank">Link</a>
                      </td>
                      @else
                      <td class="text-center">
                        <a href="{{route('cms.editlink', encrypt($list->id))}}" class="text-danger w-100"> Insert Link</a>
                      </td>
                      @endif

                     @if($list->youtube)
                      <td class="text-center">
                        <a href="{{$list->youtube}}" target="_blank">Link</a>
                      </td>
                      @else
                      <td class="text-center">
                        <a href="{{route('cms.editlink', encrypt($list->id))}}" class="text-danger w-100"> Insert Link</a>
                      </td>
                      @endif
                      
                       @if($list->others)
                      <td class="text-center">
                        <a href="{{$list->others}}" target="_blank">Link</a>
                      </td>
                      @else
                      <td class="text-center">
                        <a href="{{route('cms.editlink', encrypt($list->id))}}" class="text-danger w-100"> Insert Link</a>
                      </td>
                      @endif

                       @if($list->khan_academy)
                      <td class="text-center">
                        <a href="{{$list->khan_academy}}" target="_blank">Link</a>
                      </td>
                      @else
                      <td class="text-center">
                        <a href="{{route('cms.editlink', encrypt($list->id))}}" class="text-danger w-100"> Insert Link</a>
                      </td>
                      @endif      
                      
                      @if($list->assignment_link)
                      <td class="text-center">
                        <a href="{{$list->assignment_link}}" target="_blank">Link</a>
                      </td>
                      @else
                      <td class="text-center">
                        <a href="{{route('cms.editlink', encrypt($list->id))}}" class="text-danger w-100"> Insert Link</a>
                      </td>
                      @endif
                        <td>
                          <a href="{{route('cms.editlink', encrypt($list->id))}}">Edit</a> | 
                          <a href="#"
                          onclick="event.preventDefault();
                          document.getElementById('delete-cms-form{{$list->id}}').submit();">
                          {{ __('Delete') }}
                        </a>

                        <form id="delete-cms-form{{$list->id}}" action="{{ route('cms.deletelink', encrypt($list->id)) }}" method="POST" style="display: none;">
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
</section>

<script>
  function getRecord() {

    $(".buttons-csv").remove();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var txtSerachClass = $("#txtSerachClass").val();
    var txtSerachSubject = $("#txtSerachSubject").val();
    $.ajax({
      url: "{{url('filter-record')}}",
      type: 'POST',
      data: {
        txtSerachClass: txtSerachClass,
        txtSerachSubject: txtSerachSubject
      },
      success: function(info) {
        $("#cms").html(info);
        $("#cms").show();
        $("#deleteall").show();

        if (txtSerachClass) {
          var table = $('#cmsrecords').DataTable({
            dom: 'Bfrtip',
            bFilter: false,
            buttons: [{
              extend: 'csvHtml5',
              autoFilter: true,
              sheetName: 'Exported data',
              text: '<i class="fa fa-download mr-1 " aria-hidden="true"></i>Export CMS Details',
              className: 'btn btn-secondary btn-sm ml-2',
              init: function(api, node, config) {
                $(node).removeClass('dt-button')
              },
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
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

<script>
  $(document).ready(function() {
  $('#cmsrecords').DataTable({
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
</script>
@endsection