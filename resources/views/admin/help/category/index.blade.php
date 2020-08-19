@extends('layouts.admin.app')

@section('content')
<section class="main-section">

    @if(count($categories)>0)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card card-common mb-3">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-md-4 col-lg-8 text-md-left ">
                                <span class="topic-heading"> Category</span>
                            </div>
                            <div class="col-md-8 col-lg-4 text-md-right ">
                                <a href="{{route('admin.help-category-add')}}" class="btn btn-color  text-white m-0 btn-sm">
                                    <i class="fa fa-plus mr-2 icon-4x" aria-hidden="true"></i>
                                    Add Category
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-3">
                        <table id="teacherlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 2, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $cl)
                                <tr>
                                    <td>{{$cl->id}}</td>
                                    <td class="text-center">{{$cl->category}}</td>
                                    <td>

                                        <a href="{{route('admin.help-category-edit', encrypt($cl->id))}}" class="edit-color">Edit</a> |
                                        <a href="javascript:void(0);" data-deleteModal="{{$cl->id}}" class="delete-color">
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
    @endif
</section>
<div class="modal fade" id="studentdeletModal" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light d-flex align-items-center">
                <h5 class="modal-title font-weight-bold">Delete Category</h5>
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

        $('#studentdeletModal').modal('show');
        var route = "{{url('admin/help-category-delete')}}" + "/" + val;
        $("#deleteform").attr('action', route);

    });
</script>
@endsection