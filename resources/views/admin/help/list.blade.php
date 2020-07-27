@extends('layouts.admin.app')

@section('content')
<section class="main-section">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card card-common mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4 col-lg-8 text-md-left mb-1">
                                <span class="topic-heading">Help Tickets</span>
                            </div>
                            <div class="col-md-8 col-lg-4 text-md-right mb-1">


                                <select id="category" name="category" class="form-control " onchange="getCategories()">
                                    <option value=''>Select Category</option>
                                    @if(count($categories)>0)
                                        @foreach($categories as $cl)
                                            <option value='{{$cl->id}}'>{{$cl->category}}</option>
                                        @endforeach
                                        <option value="all">Show All</option>
                                    @endif
                                </select>





                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-3">
                        <div class="row justify-content-center">
                            <div class="col-md-4 col-lg-3 text-md-left text-center mb-1">
                                <!-- <span data-dtlist="#ticketlist" class="mb-1">
                                        <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                                    </span> -->
                            </div>

                            <div class="col-sm-12" id="getticket">
                                <table id="ticket" class="table table-sm table-bordered display" data-page-length="100" data-order="[[0, &quot;desc&quot; ]]" style="width:100%" data-page-length="10" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                                    <thead>
                                        <tr class="text-center">
                                            <th>SNO</th>
                                            <th>Teacher Name</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Class Join link</th>
                                            <th>Create Date</th>
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
                        <input type="text" name="delete" class="form-control text-lowercase" id="delete">

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

    function getCategories(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var category   = $("#category").val();
        $.ajax({
            url: "{{route('filter-ticket')}}",
            type: 'POST',
            data: {
                category   : category
            },
            success: function(info) {
                $("#getticket").html(info);
                $("#getticket").show();
            }
        });
    }
</script>
@endsection