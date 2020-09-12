<div class="col-sm-12">
    <div class="card">
        <div class="card-header btn-ui">Classroom Reports
{{--            <a href="#" class="btn bg-white float-right m-0 ">Report</a>--}}
        </div>
        <div class="card body pt-2">

            <?php if (count($inviteClassData) > 0) { ?>
            <table id="teacherlist" class="table table-sm table-bordered display" style="width:100%"
                   data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60"
                   data-collast="120" data-filterplaceholder="Search Records ...">
                <thead>
                <tr>
                    <th>Classroom</th>
                    <th>Grade Average</th>
                    <th>Attendace Average</th>
                    <th>Classes Conducted</th>
                    <th>Submissions</th>
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
                        @if(isset($gradeAverage[$inviteClass->class_id]))
                            {{$gradeAverage[$inviteClass->class_id]}}
                        @endif
                    </td>
                    <td></td>
                    <td>
                        {{count($totalClassesOfClassrooms[$inviteClass->class_id]) - count($cancelledClassesOfClassrooms[$inviteClass->class_id])}}
                        / {{count($totalClassesOfClassrooms[$inviteClass->class_id])}}
                    </td>
                    <td>
                        <a href="javascript:void(0);" data-INVLiveLink="{{ $g_link.'/gb' }}"
                           id="Inv_live_c_link_{{$i}}"
                           class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
                            <svg class="icon font-10 mr-1">
                                <use xlink:href="../images/icons.svg#icon_dot"></use>
                            </svg>
                            Check Submissions
                        </a>
                    </td>
                </tr>


                <?php
                } ?>

                </tbody>
            </table>
            <?php
            $i++;
            } else {
            ?>
            <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
                <svg class="icon icon-4x mr-3">
                    <use xlink:href="../images/icons.svg#icon_nodate"></use>
                </svg>
                No Record Found!
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#teacherlist').DataTable({
            buttons: [
                'excelHtml5'
            ]
        });
    });
</script>