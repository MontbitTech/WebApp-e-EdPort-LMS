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
                @if(count($onGoingClasses) > 0)
                <div class="card card-common mb-3">

                    <div class="card-header">
                        <span class="topic-heading">Ongoing lectures</span>
                    </div>
                    <div class="card-body pt-3">
                        <div class="col-sm-12">
                            <table id="ongoing" class="table table-sm table-bordered display" style="width:100%" data-page-length="100" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                                <thead>
                                    <tr class="text-center">
                                        <th width="20%">Teacher Name</th>
                                        <th width="10%">Division-section</th>
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
                                        <td>{{date('h:i a',strtotime($ongoing->from_timing)) . "-" . date('h:i a',strtotime($ongoing->to_timing)) }}</td>
                                        <td>
                                            @if($ongoing->g_meet_url)
                                            <a href="{{$ongoing->g_meet_url}}" target="_blank" class="link-color">Join Link</a>
                                            @endif
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#ongoing').DataTable({
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