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
                @if(count($inviteClassData) > 0)
                <div class="card card-common mb-3">

                    <div class="card-header">
                        <span class="topic-heading">Reports</span>
                    </div>
                    <div class="card-body pt-3">
                        <div class="col-sm-12">
                    <table id="reports" class="table table-sm table-bordered display" style="width:100%"
                   data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120"
                   data-filterplaceholder="Search Records ...">
                <thead>
                <tr>
                    <th style="width:20%">Classroom</th>
                    <th style="width:20%">Grade Average</th>
                    <th style="width:20%">Attendance Percentage</th>
                    <th style="width:20%">Classes Conducted</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach ($inviteClassData as $inviteClass) {
                $section_name = '';
                $subject_name = '';
                $cls = '';
                $g_link = '';
                if ( $inviteClass->studentClass ) {
                    $cls = $inviteClass->studentClass->class_name;
                    $section_name = $inviteClass->studentClass->section_name;
                    $g_link = $inviteClass->studentClass->g_link;
                }
                if ( $inviteClass->studentSubject ) {
                    $subject_name = $inviteClass->studentSubject->subject_name;
                }
                ?>
                <tr>
                    <td>{{ $cls }} {{ $section_name }} Std {{ $subject_name }} </td>
                    <td>
                        <!-- @if(isset($gradeAverage[$inviteClass->class_id]))
                            {{$gradeAverage[$inviteClass->class_id]}}
                        @endif -->

                        <!-- 111 -->
                    </td>
                    <td>
                        @if(isset($attendanceAverage[$inviteClass->class_id]))
                            {{$attendanceAverage[$inviteClass->class_id]}}
                        @endif
                    </td>
                    <td>
                        @if(isset($totalClassesOfClassrooms[$inviteClass->class_id]) && isset($cancelledClassesOfClassrooms[$inviteClass->class_id]))
                            {{count($totalClassesOfClassrooms[$inviteClass->class_id]) - count($cancelledClassesOfClassrooms[$inviteClass->class_id])}}
                            / {{count($totalClassesOfClassrooms[$inviteClass->class_id])}}
                        @endif
                    </td>
                    <!-- <td>
                        <a href="javascript:void(0);" data-INVLiveLink="{{ $g_link.'/gb' }}" id="Inv_live_c_link_{{$i}}"
                           class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
                            <svg class="icon font-10 mr-1">
                                <use xlink:href="../images/icons.svg#icon_dot"></use>
                            </svg>
                            Check Submissions
                        </a>
                    </td> -->
                </tr>


                <?php
                } ?>

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
        $('#reports').DataTable({
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