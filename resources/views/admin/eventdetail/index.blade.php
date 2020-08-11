@extends('layouts.admin.app')
@section('content')

<style>
    #eventdetail_wrapper .row:first-child {
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
                @if(count($eventDetails) > 0)
                <div class="card card-common mb-3">

                    <div class="card-header">
                        <span class="topic-heading">Csv Uploads</span>
                    </div>
                    <div class="card-body pt-3">
                        <div class="col-sm-12">
                            <table id="eventdetail" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 2, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                                <thead>
                                    <tr class="text-center">
                                        <th width="20%">Event</th>
                                        <th width="20%">Status</th>
                                        <th width="20%">Created At</th>
                                        <th width="20%">Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($eventDetails as $events)
                                    <tr class="text-center">
                                        <td>{{$events->event_name}}</td>
                                        @if($events->job=='')
                                        <td>done</td>
                                        @else
                                        <td>processing</td>
                                        @endif
                                        <td>{{$events->created_at}}</td>
                                        <td>{{$events->updated_at}}</td>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#eventdetail').DataTable({
            initComplete: function(settings, json) {
                $('[data-dtlist="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_length').find("label"));
                $('[data-dtfilter="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_filter').find("input[type=search]").attr('placeholder', $('#' + settings.nTable.id).attr('data-filterplaceholder')))
            },
            "lengthMenu": [
                [100, 200, 500, -1],
                [100, 200, 500, "All"]
            ]
        });
    });
</script>
@endsection