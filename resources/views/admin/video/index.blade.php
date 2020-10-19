@extends('layouts.admin.app')
@section('content')
<style>
    #ongoing_wrapper .row:first-child {
        display: flex;
    }

    .classes-box {
        position: relative;
        border: 1px solid transparent;
        overflow: hidden;
        background-color: #fff;
        box-shadow: 0px 1px 7px gainsboro;
        transition: 300ms;
    }
</style>

<section class="main-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if($videos)


                <div class="card card-common mb-3">

                    <div class="card-header">
                        <span class="topic-heading">Videos</span>
                        <a href="{{route('video.add')}}" class="btn btn-sm btn-color float-right">Add Video</a>
                    </div>
                    <div class="card-body pt-3">
                        <div class="col-sm-12">
                            <table id="ongoing" class="table table-sm table-bordered display" style="width:100%" data-page-length="10" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                                <thead>
                                    <tr class="text-center">
                                        <th width="20%">Title</th>
                                        <th width="10%">Links</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($videos as $video)
                                    <tr class="text-center">
                                        <td>{{$video->title}}</td>
                                        <td>{{$video->link}}</td>
                                        <td>
                                            <a href="{{route('video.update', encrypt($video->id))}}">Edit</a> |
                                            <a href="javascript:void(0);" data-deleteModal="{{$video->id}}"> {{ __('Delete') }} </a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                @else
                <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
                    <svg class="icon icon-4x mr-3">
                        <use xlink:href="../images/icons.svg#icon_nodate"></use>
                    </svg>
                    No Record Found!
                </div>
                @endif
            </div>

        </div>
    </div>
</section>
<div class="modal fade" id="studentdeletModal" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light d-flex align-items-center">
                <h5 class="modal-title font-weight-bold">Delete Video</h5>
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
                        <input type="text" name="delete" class="form-control text-lowercase" id="delete" required>

                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-back px-4">
                            Delete
                        </button>
                        <button type="button" class="btn submit-btn" class="close" data-dismiss="modal" aria-label="Close">
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
        $('#ongoing').DataTable({


        });
    });
    $(document).on('click', '[data-deleteModal]', function() {
        var val = $(this).data('deletemodal');

        $('#studentdeletModal').modal('show');
        var route = "{{url('admin/video/destroy')}}" + "/" + val;
        $("#deleteform").attr('action', route);

    });
</script>
@endsection