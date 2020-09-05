@extends('layouts.admin.app')

@section('content')
<script src="{{ asset('js/jquery.shorten.js') }}"></script>
<section class="main-section">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card card-common mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4 col-lg-8 text-md-left mb-1">
                                <span class="topic-heading">Help Tickets</span>&nbsp;
                                <a type="button" class="btn btn-sm btn-color" onclick="refresh()">
                                        <i class="fa fa-refresh mr-1 icon-4x" aria-hidden="true"></i>
                                    
                                    </a>

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
                                <table id="ticketlist" class="table table-sm table-bordered display" data-page-length="100" style="width:100%" data-page-length="10" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Teacher Name</th>
                                            <th>Issue</th>
                                            <th>Status</th>
                                            <th>Comments</th>
                                            <th>Create Date</th>
                                        </tr>
                                    </thead>

                                    @if(count($helpTickets) > 0)
                                    @php
                                    $n = count($helpTickets);
                                    $n-=1;
                                    $i = 0;
                                    @endphp
                                    <tbody id="ticketlistBody">

                                        @foreach($helpTickets as $help)
                                        <tr id="help_id_{{ $help->id }}">
                                            <td>{{++$i}}</td>
                                            <td>
                                                @if($help->teacher)
                                                {{$help->teacher->name}} </br> ( <span style="font-weight:600;font-size:12px;color:#007bff">{{$help->teacher->phone}} </span>)
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <b>Category</b> :
                                                @if($help->help_ticket_category_id==null)
                                                @if($help->studentClass)
                                                {{($help->help_type == 2)?$help->studentClass->class_name:''}}

                                                {{($help->help_type == 2)?$help->studentClass->section_name:''}}
                                                @endif
                                                @if($help->studentSubject)
                                                {{($help->help_type == 2)?$help->studentSubject->subject_name:''}}
                                                @endif
                                                @endif
                                                @foreach($categories as $category)
                                                @if($category->id == $help->help_ticket_category_id)
                                                {{$category->category}}
                                                @endif
                                                @endforeach
                                                @if(isset($help->studentClass->class_name))
                                                ({{$help->studentClass->class_name}} {{$help->studentClass->section_name}})
                                                @endif
                                                <br>
                                                @if($help->description)
                                                <b>Description</b> :
                                                {{isset($help->description)?$help->description:''}}
                                                <br>
                                                @endif
                                                @if($help->class_join_link)
                                                <a href="javascript:void(0);" data-helplink="{{$help->class_join_link}}" class="delete-color" id="{{ $help->id}}">Join Live</a>
                                                @endif
                                            </td>
                                            <td style="width: 15%">
                                                <select name="status" class="form-control" data-selectStatus="{{ $help->id }}" {{($help->status == 3)?'disabled':''}}>
                                                    <option value="1" {{($help->status == 1)?'selected':''}}>
                                                        Pending
                                                    </option>
                                                    <option value="2" {{($help->status == 2)?'selected':''}}>In
                                                        Progress
                                                    </option>
                                                    <option value="3" {{($help->status == 3)?'selected':''}}>
                                                        Closed
                                                    </option>
                                                </select>
                                            </td>
                                            <td class="text-center comment">
                                                {{isset($help->comments)?$help->comments:''}}
                                            </td>
                                            <td>
                                                <span style="font-size:14px;">{{date("d/m/Y h:i a",strtotime($help->created_at))}} </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<div class="modal fade" id="addCommentModal" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light d-flex align-items-center">
                <h5 class="modal-title font-weight-bold">Closing Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg class="icon">
                        <use xlink:href="../images/icons.svg#icon_times2"></use>
                    </svg>
                </button>
            </div>
            <div class="modal-body pt-4">
                @csrf
                <input type="hidden" name="help_id" id="help_id" />
                <input type="hidden" name="status_id" id="status_id">
                <div class="form-group text-center">
                    <h4>Please enter your reason to close</h4>
                </div>
                <div class="form-group text-center ">
                    <textarea name="close_ticket" class="form-control text-lowercase" id="close_ticket"></textarea>

                </div>
                <div class="form-group text-center">
                    <button type="button" class="btn btn-back px-4" onclick="changeTicketStatus()">
                        Close Ticket
                    </button>
                    <button type="button" class="btn submit-btn" class="close" data-dismiss="modal" aria-label="Close" onclick="window.open('{{ url('/admin/support-help') }}','_self');">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
         $('#ticketlist').DataTable({

            initComplete: function(settings, json) {
                $('[data-dtlist="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_length').find("label"));
                $('[data-dtfilter="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_filter').find("input[type=search]").attr('placeholder', $('#' + settings.nTable.id).attr('data-filterplaceholder')))


                    // setTimeout(function() {
                    // location.reload(true);
                    // }, 3000);
            }
        });
        $('.dateset').datepicker({
            dateFormat: "yy/mm/dd"
            // showAnim: "slide"
        })

    });
    $(document).on('click', '[data-addCommentModal]', function() {
        var val = $(this).data('deletemodal');

        $('#studentdeletModal').modal('show');
        var route = "{{url('admin/help-category-delete')}}" + "/" + val;

    });

    function getCategories() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var category = $("#category").val();
        $.ajax({
            url: "{{route('filter-ticket')}}",
            type: 'POST',
            data: {
                category: category
            },
            success: function(info) {
                $("#getticket").html(info);
                $("#getticket").show();
            }
        });
    }

    $(document).on('click', '[data-helplink]', function() {
        var liveurl = $(this).attr("data-helplink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No assignement url found!');
        }
    });
    $(document).on('change', '[data-selectStatus]', function() {
        var help_id = $(this).attr("data-selectStatus");
        if ($(this).val != '') {
            var status_id = $(this).val();

            if (status_id == 3) {
                $('#addCommentModal').modal('show');
                $('#help_id').val(help_id);
                $('#status_id').val(status_id);
            } else
                changeTicketStatus(help_id, status_id);
        }
    });


    function changeTicketStatus(help_id = null, status_id = null, comment = '') {
        if (help_id == null && status_id == null) {
            help_id = $('#help_id').val();
            status_id = $('#status_id').val();
            comment = $('#close_ticket').val();
        }

        if (status_id == 3) {
            if (comment == '') {
                $.fn.notifyMe('error', 4, 'Comment field cannot be empty!');
                return;
            }
        }

        if (help_id != '') {
            $.ajax({
                type: 'POST',
                url: '{{ route("helpStatus.update") }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    help_id: help_id,
                    status_id: status_id,
                    comment: comment
                },
                success: function(data) {
                    var res = JSON.parse(data);
                    $.fn.notifyMe('success', 4, res.message);
                    window.open("{{ url('/admin/support-help') }}", "_self");
                },
                error: function() {
                    $.fn.notifyMe('error', 4, 'There is some error while update status!');
                }
            });
        }
    }
</script>
<script language="javascript">
    $(document).ready(function() {

        $(".comment").shorten({
            "showChars": 100,
            "moreText": "See More",
        });

        $(".comment-small").shorten({
            showChars: 10
        });

    });
</script>

<script>
    function refresh(){
        location.reload(true);
    }
</script>

  @endsection