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
              <a type="button" class="btn btn-sm btn-secondary" href="{{route('cms.sampleCMSLinksDownload')}}">
                <i class="fa fa-download mr-1 " aria-hidden="true"></i>
                Download Sample File
              </a>
            </div>
            <div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-secondary" href="{{route('cms.cmslinksimport')}}">
                <i class="fa fa-upload mr-1 " aria-hidden="true"></i>
                Import CMS Details
              </a>
            </div>
            <div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-secondary" href="{{route('cms.addlink')}}">
                <i class="fa fa-user-plus mr-1" aria-hidden="true"></i>Add CMS Details
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
                      <th>Class</th>
                      <th>Subject</th>
                      <th>Topic</th>
                      <th>Link</th>
                      <th>Assignment Link</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    @if(count($lists)>0)
                    @php $i=0; @endphp


                    @foreach($lists as $list)
                    @php
                    $enc = encrypt($list->id);
                    @endphp

                    <tr>
                      <td>{{++$i}}</td>
                      <td class="text-center">{{$list->class}}</td>
                      <td>{{$list->subject_name}}</td>
                      <td>{{$list->topic}}</td>
                      <td>
                        @if(empty($list->link))
                        <?= "" ?>
                        @else
                        <a href='{{$list->link}}' target="_blank">Open Link</a>
                        @endif
                      </td>
                      <td>
                        @if(empty($list->assignment_link))
                        <?= "" ?>
                        @else
                        <a href='{{$list->assignment_link}}' target="_blank">Open Assignment Link</a></td>
                      @endif
                      <td>
                        <a href="{{route('cms.editlink', $enc)}}">Edit</a> |
                        <a href="#" onclick="event.preventDefault();
						document.getElementById('delete-cms-form{{$list->id}}').submit();">
                          {{ __('Delete') }}
                        </a>

                        <form id="delete-cms-form{{$list->id}}" action="{{ route('cms.deletelink', $enc) }}" method="POST" style="display: none;">
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