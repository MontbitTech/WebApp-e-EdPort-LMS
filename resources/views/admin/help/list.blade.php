@extends('layouts.admin.app')

@section('content')





    <section class="main-section">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="card card-common mb-3">
                        <div class="card-header">
                            <span class="topic-heading">Help Tickets</span>

                        </div>
                        <div class="card-body pt-3">
                            <div class="row justify-content-center">
                                <div class="col-md-4 col-lg-3 text-md-left text-center mb-1">
                <!-- <span data-dtlist="#ticketlist" class="mb-1">
					<div class="spinner-border spinner-border-sm text-secondary" role="status"></div> 
                </span> -->
                                </div>

                        <div class="col-md-8 col-lg-9 text-md-right text-center mb-1">
                        <span data-dtfilter="" class="mb-1">

                        <select id="category" name="category" class="form-control form-control-sm" onchange="getCategories()">
                        <option value=''>Select Category</option>
                        @if(count($categories)>0)
                        @foreach($categories as $cl)
                        <option value='{{$cl->id}}'>{{$cl->category}}</option>
                        @endforeach
                        @endif
                        </select>

                        </span>

                        </div>

                        <div class="col-sm-12" id="getticket">
                                    <table id="ticket" class="table table-sm table-bordered display"
                                           data-page-length="100" data-order="[[0, &quot;desc&quot; ]]"
                                           style="width:100%" data-page-length="10" data-col1="60" data-collast="120"
                                           data-filterplaceholder="Search Records ...">
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
    <script type="text/javascript">
        $(document).ready(function () {

            var tbl = $('#ticketlist').DataTable({
                initComplete: function (settings, json) {
                    $('[data-dtlist="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_length').find("label"));
                    $('[data-dtfilter="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_filter').find("input[type=search]").attr('placeholder', $('#' + settings.nTable.id).attr('data-filterplaceholder')))
                }
            });
            $('.dateset').datepicker({
                dateFormat: "yy/mm/dd"
                // showAnim: "slide"
            });

            $('.ac-time').timepicker({
                controlType: 'select',
                oneLine    : true,
                timeFormat : 'hh:mm tt'
            });

        });


        $(document).on('click', '[data-helplink]', function () {
            var liveurl = $(this).attr("data-helplink");
            if (liveurl != '') {
                //$('#viewClassModal').modal('show');
                //$("#thedialog").attr('src','https://google.com');
                window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
            } else {
                alert('No assignement url found!');
            }
        });

        $(document).on('change', '[data-selectStatus]', function () {
            var help_id = $(this).attr("data-selectStatus");
            if ($(this).val != '') {
                var status_id = $(this).val();
                if (help_id != '') {
                    $.ajax({
                        type   : 'POST',
                        url    : '{{ route("helpStatus.update") }}',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data   : { help_id: help_id, status_id: status_id },
                        success: function (data) {
                            var res = JSON.parse(data);
                            $.fn.notifyMe('success', 4, res.message);
                        },
                        error  : function () {
                            $.fn.notifyMe('error', 4, 'There is some error while update status!');
                        }

                    });
                }
            }
        });

</script>

<script>

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