@extends('layouts.teacher.app')
@php $i = 1;$k=$i;@endphp
@section('content')
<style>
    .top-padding {
        padding-top: 0.625rem !important;
    }
</style>
<?php
$cls = 0;
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/datatables.min.js"></script>

<section class="main-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <ul class="nav nav-tabs1 nav-pills" id="myTab" role="tablist">
                    <li class="nav-item mb-1">
                        <a class="nav-link shadow-sm active tab-nav" data-toggle="tab" href="#ulclasses" role="tab" aria-selected="true">Today's Live Classes</a>
                    </li>
                    <li class="nav-item mb-1">
                        <a class="nav-link shadow-sm tab-nav" data-toggle="tab" href="#plclasses" role="tab">Past Classes</a>
                    </li>
                    <!-- <li class="nav-item mb-1">
                        <a class="nav-link shadow-sm" data-toggle="tab" href="#newInvitationclasses" role="tab">Assignment Submission Summary</a>
                    </li> -->
                    <li class="nav-item mb-1 ">
                        <a class="nav-link shadow-sm tab-nav" data-toggle="tab" href="#upcomingclasses" role="tab">Future
                            Classes</a>
                    </li>
                    <li class="nav-item mb-1 ml-md-auto ">
                        <a class="nav-link shadow-sm mr-0 tab-nav" data-toggle="modal" href="#addClassModal" role="modal">
                            <svg class="icon mr-1">
                                <use xlink:href="../images/icons.svg#icon_plus"></use>
                            </svg>
                            Add Classes
                        </a>
                    </li>
                </ul>
                <div class="tab-content pt-3">
                    @include('teacher.dashboard.todayclass')
                    <!-- ///////////////// -->
                    <!-- Past Live Classes -->
                    <!-- ///////////////// -->
                    @include('teacher.dashboard.pastclass')
                    <!-- ///////////////// -->
                    <!-- Past Live Classes End -->
                    <!-- ///////////////// -->


                    <!-- ///////////////// -->
                    <!-- Upcoming  Classes -->
                    <!-- ///////////////// -->

                    @include('teacher.dashboard.upcomingclass')

                    <!---
                        Invitation
                         -->
                    <!-- <div class="tab-pane fade" id="newInvitationclasses">

                        <div class="col-sm-12">
                            <?php if (count($inviteClassData) > 0) { ?>
                                <table id="teacherlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                                    <thead>
                                        <tr>
                                            <th>Class</th>
                                            <th>Section</th>
                                            <th>Subject</th>
                                            <th>Submissions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $i = 0;
                                        foreach ($inviteClassData as $row) {
                                            $section_name = '';
                                            $subject_name = '';
                                            $cls = '';
                                            $g_link = '';
                                            if ($row->studentClass) {
                                                $cls = $row->studentClass->class_name;
                                                $section_name = $row->studentClass->section_name;
                                                $g_link = $row->studentClass->g_link;
                                            }
                                            if ($row->studentSubject) {
                                                $subject_name = $row->studentSubject->subject_name;
                                            }
                                        ?>
                                            <tr>

                                                <td>{{ $cls }} Std</td>
                                                <td>{{ $section_name }}</td>
                                                <td>{{ $subject_name }}</td>
                                                <td><a href="javascript:void(0);" data-INVLiveLink="{{ $g_link.'/gb' }}" id="Inv_live_c_link_{{$i}}" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
                                                        <svg class="icon font-10 mr-1">
                                                            <use xlink:href="../images/icons.svg#icon_dot"></use>
                                                        </svg>
                                                        Check Submissions
                                                    </a></td>
                                            </tr>


                                        <?php
                                        }
                                        $i++;
                                        ?>

                                    </tbody>
                                </table>
                            <?php
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
                    </div> -->
                    <!-- ./Teacher-AssignedClasses -->

                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="viewStudentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="purchaseshowdatadiv"></div>
    </div>
</div>

<!-- Class Box Help Modal -->
<div class="modal fade" id="classhelpModal" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light d-flex align-items-center">
                <h5 class="modal-title font-weight-bold">Help Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg class="icon">
                        <use xlink:href="../images/icons.svg#icon_times2"></use>
                    </svg>
                </button>
            </div>
            <div class="modal-body pt-4">
                <form>
                    <div class="form-group">
                        <select name="help_ticket_category" class="form-control" required>
                            <option value="">Please select a category</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" value="" rows="5" placeholder="Write help message..." required="required"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary px-4">
                            <svg class="icon mr-2">
                                <use xlink:href="../images/icons.svg#icon_send"></use>
                            </svg>
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Class Modal -->
@include('teacher.dashboard.addclass')
<!-- End -->
<div class="modal fade" id="notifyModal" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light d-flex align-items-center">
                <h5 class="modal-title font-weight-bold">Notify Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg class="icon">
                        <use xlink:href="../images/icons.svg#icon_times2"></use>
                    </svg>
                </button>
            </div>
            <div class="modal-body pt-4">

                {!! Form::open(array('route' => ['student-notify'],'method'=>'POST','autocomplete'=>'off','id'=>'frm_class_notify')) !!}


                <input type="hidden" id="date_class_id" value="" name="dateClass_id" />
                <input type="hidden" id="data_subject_id" value="" name="subject_id" />
                <input type="hidden" id="data_class_id" value="" name="class_id" />
                <input type="hidden" id="data_gmeet_url" value="" name="gmeet_url" />
                <input type="hidden" id="data_to_timing" value="data_to_timing" />
                <input type="hidden" id="data_from_timing" value="data_from_timing" />
                <input type="hidden" id="data_cancelled" name="cancelled" value="0" />

                <div class="container-fluid">
                    <div class="form-group row">
                        <nav class="nav flex-column">
                            <div class=" nav-link active btn btn-md btn-primary " id="notify">
                                Class Invitation
                            </div>
                            <div class=" nav-link btn btn-md btn-primary mt-2 " id="cancel">
                                Class Cancellation
                            </div>
                            <div class=" nav-link btn btn-xs btn-primary mt-2" id="custom">
                                Custom
                            </div>

                        </nav>
                        <div class="col-md-9 col-lg-9 col-9">
                            <div class="mt-2">
                                {!! Form::textarea('notificationMsg', null, array('id'=>'notificationMsg','placeholder' => 'Notify Students','class' => 'form-control','required'=>'required','rows'=>'3','style'=>'resize: none')) !!}
                            </div>
                            <div class="form-group  mt-3 ml-5 ">
                                <button type="submit" class="btn btn-primary px-4 mr-2">Notify</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Past Edit Class Modal -->
<div class="modal fade" id="pasteditClassModal" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light d-flex align-items-center">
                <h5 class="modal-title font-weight-bold">Edit Past Class Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg class="icon">
                        <use xlink:href="../images/icons.svg#icon_times2"></use>
                    </svg>
                </button>
            </div>
            <div class="modal-body pt-4">

                <form>

                    <input type="hidden" id="txt_past_datecalss_id" value="" name="txt_past_datecalss_id" />
                    <input type="hidden" id="txt_boxID" value="" name="txt_boxID" />

                    <!-- <div class="form-group row">
                        <label for="inputDesc" class="col-md-4 col-form-label text-md-right">Description:</label>
                        <div class="col-md-6">
                            {!! Form::textarea('past_edit_description', null, array('id'=>'past_edit_description','placeholder' => 'Class Description','class' => 'form-control','required'=>'required','rows'=>'3')) !!}
                        </div>
                    </div> -->
                    <!-- <div class="form-group row">
                        <label for="class_liveurl" class="col-md-4 col-form-label text-md-right"> Recording URL
                            <small>(Link)</small>:</label>
                        <div class="col-md-6">
                            {!! Form::textarea('past_edit_rec_liveUrl', null, array('id'=>'past_edit_rec_liveUrl','placeholder' => 'Enter Recording Live url','class' => 'form-control','required'=>'required','rows'=>'3')) !!}

                        </div>
                    </div> -->
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <button type="button" id="update_pastClass" class="btn btn-primary px-4">Save Class
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End -->

<!-- Edit Class Modal -->

<!-- End -->



<script>
    $('.btn-collapse').click(function() {
        $(this).find('.toggle-class').toggleClass('fas fa-plus fas fa-minus');
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ac-datepicker').datepicker({
            dateFormat: 'd M yy',
            minDate: 0,
        });
        $('.ac-time').timepicker({
            controlType: 'select',
            oneLine: true,
            timeFormat: 'hh:mm tt'
        });

        $('.due-time').timepicker({
            controlType: 'select',
            oneLine: true,
            timeFormat: 'hh:mm tt'
        });
    });

    $('#submit').click(function() {
        var valuestart = $("#addClassStartTime").val();
        var valueend = $("#addClassEndTime").val();
        var timeStart = new Date("01/01/2007 " + valuestart);
        var timeEnd = new Date("01/01/2007 " + valueend);

        var diff = (timeEnd - timeStart) / 60000; //dividing by seconds and milliseconds
        var minutes = diff % 60;
        var hours = (diff - minutes) / 60;
        if (timeStart >= timeEnd) {
            var response = confirm("Class end-time can't be before/equal to class start-time.");
        } else {
            var response = confirm("You have set class duration of " + hours + " hours and " + minutes + " minute");
        }
        if (response) {
            $('#frm_add_class').unbind('submit').submit();
        } else {
            $('#frm_add_class').submit(function() {
                return false;
            });
        }
    });

    $(document).on('click', '[data-LiveLink]', function() {
        var liveurl = $(this).attr("data-LiveLink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "_blank"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No Join link found!');
        }
    });
    $(document).on('change', '[data-AssLiveLink]', function() {
        var liveurl = $(this).val();
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No assignement url found!');
        }
    });
    $(document).on('click', '[data-topiclink]', function() {
        var liveurl = $(this).attr("data-topiclink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "_blank"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No content url found!');
        }
    });

    $(document).on('click', '[data-youtubelink]', function() {
        var liveurl = $(this).attr("data-youtubelink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "_blank"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No content url found!');
        }
    });

    $(document).on('click', '[data-wikipedialink]', function() {
        var liveurl = $(this).attr("data-wikipedialink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "_blank"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No content url found!');
        }
    });

    $(document).on('click', '[data-academylink]', function() {
        var liveurl = $(this).attr("data-academylink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "_blank"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No content url found!');
        }
    });

    $(document).on('click', '[data-book]', function() {
        var liveurl = $(this).attr("data-book");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "_blank"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No content url found!');
        }
    });
    /*
    past calsses
    */
    $(document).on('click', '[data-pastLiveLink]', function() {
        var liveurl = $(this).attr("data-pastLiveLink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No Video recording found!');
        }
    });
    $(document).on('click', '[data-pasttopiclink]', function() {
        var liveurl = $(this).attr("data-pasttopiclink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "dialog name"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No content url found!');
        }
    });
    $(document).on('click', '[data-futuretopiclink]', function() {
        var liveurl = $(this).attr("data-futuretopiclink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "dialog name"); //, "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No content url found!');
        }
    });
    $(document).on('change', '[data-passAssLiveLink]', function() {
        var liveurl = $(this).val();
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No assignement url found!');
        }
    });
    $(document).on('click', '[data-pasteditModal]', function() {
        var val = $(this).data('pasteditmodal');
        $('#pasteditClassModal').modal('show');
        $("#past_edit_description").val($("#past_desc" + val).val());
        //$("#past_edit_rec_liveUrl").val($("#past_recURL" + val).val());
        $("#txt_past_datecalss_id").val($("#pastdateClass_id" + val).val());
        $("#txt_boxID").val(val);
    });
    $(document).on('click', '#update_pastClass', (function() {
        var id = $("#txt_boxID").val();
        var rec_url = $('#past_edit_rec_liveUrl').val();
        var desc = $('#past_edit_description').val();
        var dateClass_id = $("#txt_past_datecalss_id").val();
        $('.loader').show();
        $.ajax({
            url: "{{url('edit-past-class')}}",
            type: "POST",
            data: {
                rec_url: rec_url,
                description: desc,
                dateClass_id: dateClass_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, response.message);
                    $('#pasteditClassModal').modal('hide');
                    $('#past_live_c_link_' + id).attr('data-pastLiveLink', response.rec_url);
                    $("#past_desc" + id).val(desc);
                    $("#past_recURL" + id).val(response.rec_url);
                    //window.open(response.cource_url,"title","dialogWidth:400px;dialogHeight:300px");
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            }
        });
    }));
    /* past classess end  */
    $(document).on('click', '[data-INVLiveLink]', function() {
        var liveurl = $(this).attr("data-INVLiveLink");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No Class url found!');
        }
    });
    $(document).on('click', '[data-createModal]', function() {
        var id = $(this).data('createmodal');
        $('#new_assignment').val($("#dateClass_id" + id).val());
        $("#row_id").val(id);
        $('#g_class_id').val($('#g_class_id_' + id).val());
        $("#ass_class_id").val($('#txt_class_id' + id).val());
        $("#ass_subject_id").val($('#txt_subject_id' + id).val());
        $("#ass_teacher_id").val($('#txt_teacher_id' + id).val());
        var class_id = $('[data-createmodal="' + id + '"]').data('class_modal');
        var subject_id = $('[data-createmodal="' + id + '"]').data('subject_modal');
        //var teacher_id = $('[data-createmodal="'+id+'"]').data('teacher_modal');
        /* console.log(id);
            console.log(class_id);
           console.log(subject_id);
           exit; */
        $("#txt_aTitle").val('');
        $("#txt_topin_name").val('');
        $('#createAssiModal').modal('show');
        $('.loader').show();
        $.ajax({
            url: "{{url('get-assignment')}}",
            type: "POST",
            data: {
                class_id: class_id,
                subject_id: subject_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    var AssigmentData = response.data;
                    var topics = response.topics;
                    var data = '';
                    var topicData = '<option value="">Select Topic</option>';
                    AssigmentData.forEach(function(val) {
                        data += '<li> <a href="javascript:void(0);" onclick="give_assignment(\'' + id + '\',\'' + val.g_live_link + '\',\'' + val.id + '\',\'' + val.g_title + '\')" >' + val.g_title + '</a>';
                        data += ' ( <a  href="javascript:void(0);" data-viewAssignment="' + val.g_live_link + '" > View </a>) </li>';
                    });
                    topics.forEach(function(val) {
                        topicData += '<option value="' + val.id + '">' + val.topicname + '</option>';
                    });
                    $("#sel_topic").html('');
                    $("#sel_topic").append(topicData);
                    $("#li_assignment").html('');
                    $("#li_assignment").append(data);
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            }
        });
    });

    function give_assignment(id, link, classwork_id, title) {
        ///console.log(id);
        //console.log(link);
        var dateClass_id = $('#new_assignment').val();
        //var class_id = $('[data-createmodal="'+id+'"]').data('class_modal');
        //var subject_id = $('[data-createmodal="'+id+'"]').data('subject_modal');
        $('.loader').show();
        $.ajax({
            url: "{{url('give-assignment')}}",
            type: "POST",
            data: {
                dateClass_id: dateClass_id,
                classwork_id: classwork_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                ///  console.log(result);
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    //$('#new_a_link_'+edit_assignment).attr('href',new_assignment_url);
                    var data = '<option value="' + link + '">' + title + '</option>';
                    $('#view_a_link_' + id).append(data);
                    $.fn.notifyMe('success', 5, response.message);
                    $('#createAssiModal').modal('hide');
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            }
        });
    }
    $(document).on('click', '#assignment_create', (function() {
        $('#assignment_create').prop('disabled', true);
        $('#attach_file').prop('disabled', true);
        $('#cancel_assignment').prop('disabled', true);
        var id = $("#row_id").val();
        var class_id = $('#ass_class_id').val();
        var subject_id = $('#ass_subject_id').val();
        var teacher_id = $('#ass_teacher_id').val();
        //var timing_id = $('[data-createmodal="'+id+'"]').data('timing_modal');
        var g_class_id = $('#g_class_id').val();
        var txt_topic_name = $('#txt_topin_name').val();
        var sel_topic_name = $('#sel_topic').val();
        var assignment_title = $('#txt_aTitle').val();
        var description = $('#txt_description').val();
        var dueDate = $('#txt_due_date').val();
        var dueTime = $('#txt_due_time').val();
        var point = $('#txt_point').val();
        var dateClass_id = $('#new_assignment').val();
        $('.loader').show();
        $.ajax({
            url: "{{url('create-assignment')}}",
            type: "POST",
            data: {
                g_class_id: g_class_id,
                txt_topic_name: txt_topic_name,
                sel_topic_name: sel_topic_name,
                assignment_title: assignment_title,
                class_id: class_id,
                subject_id: subject_id,
                teacher_id: teacher_id,
                dateClass_id: dateClass_id,
                description: description,
                dueDate: dueDate,
                dueTime: dueTime,
                point: point

            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                // location.reload(true);
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, response.message);
                    $('#createAssiModal').modal('hide');
                    var data = '<option value="' + response.cource_url + '">' + assignment_title + '</option>';
                    $('#view_a_link_' + id).append(data);
                    $('#assignment_create').prop('disabled', false);
                    $('#attach_file').prop('disabled', false);
                    $('#cancel_assignment').prop('disabled', false);
                    $("#assignmentmodal").css('display', 'inline');
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                    $('#assignment_create').prop('disabled', false);
                    $('#attach_file').prop('disabled', false);
                    $('#cancel_assignment').prop('disabled', false);
                }
            },
            error: function() {
                $('.loader').fadeOut();
                $('#assignment_create').prop('disabled', false);
                $('#attach_file').prop('disabled', false);
                $('#cancel_assignment').prop('disabled', false);
                $.fn.notifyMe('error', 4, 'Something went wrong please reload this page and try again');
            }

        });
    }));
    $(document).on('click', '#attach_file', (function() {
        $('#assignment_create').prop('disabled', true);
        $('#attach_file').prop('disabled', true);
        $('#cancel_assignment').prop('disabled', true);
        var id = $("#row_id").val();
        var class_id = $('#ass_class_id').val();
        var subject_id = $('#ass_subject_id').val();
        var teacher_id = $('#ass_teacher_id').val();
        //var timing_id = $('[data-createmodal="'+id+'"]').data('timing_modal');
        var g_class_id = $('#g_class_id').val();
        var txt_topic_name = $('#txt_topin_name').val();
        var sel_topic_name = $('#sel_topic').val();
        var assignment_title = $('#txt_aTitle').val();
        var description = $('#txt_description').val();
        var dueDate = $('#txt_due_date').val();
        var dueTime = $('#txt_due_time').val();
        var point = $('#txt_point').val();
        var dateClass_id = $('#new_assignment').val();
        $('.loader').show();
        $.ajax({
            url: "{{url('create-assignment')}}",
            type: "POST",
            data: {
                g_class_id: g_class_id,
                txt_topic_name: txt_topic_name,
                sel_topic_name: sel_topic_name,
                assignment_title: assignment_title,
                class_id: class_id,
                subject_id: subject_id,
                teacher_id: teacher_id,
                dateClass_id: dateClass_id,
                description: description,
                dueDate: dueDate,
                dueTime: dueTime,
                point: point

            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();

                // location.reload(true);
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, response.message);
                    $('#createAssiModal').modal('hide');
                    window.open(response.cource_url, "title", "dialogWidth:400px;dialogHeight:300px");
                    var data = '<option value="' + response.cource_url + '">' + assignment_title + '</option>';
                    $('#view_a_link_' + id).append(data);
                    $('#assignment_create').prop('disabled', false);
                    $('#attach_file').prop('disabled', false);
                    $('#cancel_assignment').prop('disabled', false);
                    $("#assignmentmodal").css('display', 'inline');
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                    $('#assignment_create').prop('disabled', false);
                    $('#attach_file').prop('disabled', false);
                    $('#cancel_assignment').prop('disabled', false);
                }
            },
            error: function() {
                $('.loader').fadeOut();
                $('#assignment_create').prop('disabled', false);
                $('#attach_file').prop('disabled', false);
                $('#cancel_assignment').prop('disabled', false);
                $.fn.notifyMe('error', 4, 'Something went wrong please reload this page and try again');
            }
        });
    }));
    $(document).on('change', '[data-selecttopic]', function() {
        var getid = $(this).attr('data-selecttopic');
        if ($(this).val() != '') {
            $('#icon' + getid).show();
            var topic_id = $(this).val();
            var dateWork_id = getid;
            if (dateWork_id != '') {
                $('.loader').show();
                $.ajax({
                    type: 'POST',
                    url: '{{ route("classtopic.update") }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': dateWork_id,
                        'topic_id': topic_id
                    },
                    success: function(result) {
                        $('.loader').fadeOut();
                        var response = JSON.parse(result);
                        $('#icon' + dateWork_id).load(' #icon' + dateWork_id);
                        if (response.youtube_link != null) {
                            $('#youtube_' + dateWork_id).attr('style', 'display:block');
                            $('#youtube_' + dateWork_id).attr('data-youtubelink', response.youtube_link);
                        }

                        if (response.wikipedia_link != null) {
                            $('#wikipedia_' + dateWork_id).attr('style', 'display:block');
                            $('#wikipedia_' + dateWork_id).attr('data-wikipedialink', response.wikipedia_link);
                        }

                        if (response.academy_link != null) {
                            $('#academy_' + dateWork_id).attr('style', 'display:block');
                            $('#academy_' + dateWork_id).attr('data-academylink', response.academy_link);
                        }

                        if (response.book_url != null) {
                            $('#book_' + dateWork_id).attr('style', 'display:block');
                            $('#book_' + dateWork_id).attr('data-book', response.book_url);
                        }
                        $.fn.notifyMe('success', 4, response.message);
                    },
                    error: function() {
                        $('.loader').fadeOut();
                        $.fn.notifyMe('error', 4, 'There is some error while saving description text!');
                    }
                });
            }
        } else {
            $('#icon' + getid).hide();
        }
    });
    /*help ajax */
    $('[data-id=help]').click(function() {
        var getBoxId = $(this).attr("data-classhelp");
        var dateClass_id = $("#dateClass_id" + getBoxId).val();
        var class_id = $("#txt_class_id" + getBoxId).val();
        var subject_id = $("#txt_subject_id" + getBoxId).val();
        var description = $('#class_description_' + getBoxId).text();
        var joinlive = $('#live_c_link_' + getBoxId).attr('data-LiveLink');
        var help_type = 2;
        $('.loader').show();
        $.ajax({
            url: "{{route('teacher.generate_ticket')}}",
            type: "POST",
            data: {
                class_id: class_id,
                subject_id: subject_id,
                help_type: help_type,
                description: description,
                joinlive: joinlive,
                dateClass_id: dateClass_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, response.message);
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            },
            error: function(error_r) {
                $('.loader').fadeOut();
                var obj = JSON.parse(error_r.responseText);
                $.each(obj.errors, function(key, value) {
                    $.fn.notifyMe('error', 5, value);
                });
            }
        });
    });

    $(document).on('click', '[data-editModal]', function() {
        var val = $(this).data('editmodal');
        $('#editClassModal').modal('show');
        //$("#edit_description").val($("#txt_desc" + val).val());
        $("#from_timing").val($("#txt_from_timing" + val).val());
        $("#end_timing").val($("#txt_to_timing" + val).val());
        $("#edit_join_liveUrl").val($("#txt_gMeetURL" + val).val());
        //$("#edit_notify_stdMessage").val($("#txt_stdMessage" + val).val());
        $("#txt_datecalss_id").val($("#dateClass_id" + val).val());
        $("#txt_g_class_id").val($("#g_class_id_" + val).val());
        $("#class_name").val($("#txt_class_name" + val).val());
        $("#section_name").val($("#txt_section_name" + val).val());
        $("#class_date").val($("#txt_today_date" + val).val());

    });


    // $("#purchaseshowdivid").click(function() {
    $('[data-id=view_student]').click(function() {
        $('#purchaseshowdatadiv').hide();
        var getBoxId = $(this).attr("data-view");
        var dateclass_id = $(this).attr('data-dateclass');
        $.ajax({
            url: '{{ url("/teacher/getStudent") }}',
            type: "GET",
            data: {
                dateclass_id: dateclass_id
            },
            success: function(result) {

                $('#purchaseshowdatadiv').html(result);
                $('#purchaseshowdatadiv').show();

            }

        });
    });

    $("#frm_class_edit").on('submit', (function(e) {
        // e.preventDefault();
        var dateClass_id = $("#txt_datecalss_id").val();
        var description = $("#edit_description").val();
        var join_liveUrl = $("#edit_join_liveUrl").val();
        var notify_stdMessage = $("#edit_notify_stdMessage").val();
        $('.loader').show();
        $.ajax({
            url: "{{url('edit-live-class')}}",
            type: "POST",
            data: {
                dateClass_id: dateClass_id,
                description: description,
                join_liveUrl: join_liveUrl,
                notify_stdMessage: notify_stdMessage
            },
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                //console.log(response.data);
                if (response.status == 'success') {
                    $("#liveurl_" + dateClass_id).attr("data-livelink", join_liveUrl);
                    $('#editClassModal').modal('hide');
                    $.fn.notifyMe('success', 5, response.message);
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            },
            error: function(error_r) {
                $('.loader').fadeOut();
                var obj = JSON.parse(error_r.responseText);
                console.log(obj);
                $.each(obj.errors, function(key, value) {
                    $.fn.notifyMe('error', 5, value);
                });
            }
        });
    }));


    $(document).on('click', '[data-notify]', function() {
        var val = $(this).data('notify');
        $('#notifyModal').modal('show');
        $("#date_class_id").val($("#dateClass_id" + val).val());
        $("#data_subject_id").val($("#txt_subject_id" + val).val());
        $("#data_class_id").val($("#txt_class_id" + val).val());
        $("#data_gmeet_url").val($("#txt_gMeetURL" + val).val());
        $("#data_from_timing").val($("#txt_from_timing" + val).val());

        var from_timing = $("#data_from_timing").val();
        var to_timing = $("#txt_to_timing" + val).val();
        var gmeet_url = $("#data_gmeet_url").val();
        var class_w = $("#txt_class_name" + val).val();
        // var d = $("#txt_today_date" + val).val();
        var section = $("#txt_section_name" + val).val();


        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }

        today.setHours(today.getHours());
        var isPM = today.getHours() >= 12;
        var isMidday = today.getHours() == 12;
        var result = document.querySelector('#result');
        var time = [today.getHours() - (isPM && !isMidday ? 12 : 0),
                today.getMinutes() || '00'
            ].join(':') +
            (isPM ? ' pm' : ' am');

        var timePresent = new Date("01/01/2007 " + time);
        var timeFrom = new Date("01/01/2007 " + from_timing);
        if (timePresent >= timeFrom) {
            $('#cancel').hide();
        }
        if (timePresent <= timeFrom) {
            $('#cancel').show();
        }

        today = mm + '-' + dd + '-' + yyyy;
        var s_name = $("#txt_subject_name" + val).val();
        $('#notify').click(function() {
            let vale = "The class will start from " + to_timing + ". Please Join " + gmeet_url
            $('#notificationMsg').val(vale);
            $('#data_cancelled').val(0);
        });
        $('#cancel').click(function() {
            let vale = "Dear " + class_w + section + " Students Please note that the " + s_name + " Class scheduled on " + today + " at " + from_timing + " is Cancelled"
            // let vale = "Dear  Student Subject '" + s_name + " Class" + +d + " scheduled on dd/mm/yyyy at 00:00 AM/PM is Cancelled "
            $('#notificationMsg').val(vale);
            $('#data_cancelled').val(1);
        });
        $('#custom').click(function() {
            let vale = ""
            $('#notificationMsg').val(vale);
            $('#data_cancelled').val(0);
        });

        $('#notificationMsg').val("The class will start from " + from_timing + ". Please Join " + gmeet_url);

    });


    $("#frm_class_notify").on('submit', (function(e) {
        // e.preventDefault();
        var dateClass_id = $("#date_class_id").val();
        var subject_id = $("#data_subject_id").val();
        var class_id = $("#data_class_id").val();
        var gmeet_url = $("#data_gmeet_url").val();
        //alert(class_id);
        $('.loader').show();
        $.ajax({
            url: "{{url('student-notify')}}",
            type: "POST",
            data: {
                dateClass_id: dateClass_id,
                subject_id: subject_id,
                class_id: class_id,
                gmeet_url: gmeet_url,
                notificationMsg: notificationMsg
            },
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, response.message);
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            },
            error: function(error_r) {
                $('.loader').fadeOut();
                var obj = JSON.parse(error_r.responseText);
                console.log(obj);
                $.each(obj.errors, function(key, value) {
                    $.fn.notifyMe('error', 5, value);
                });
            }
        });
    }));
    /* Invitaion Accept */
    $('[data-id=accept]').click(function() {
        var id = $(this).attr("data-invaccept");
        var g_code = $("#txt_inv_code" + id).val();
        var inv_id = $("#txt_inv_id" + id).val()
        //alert(id);
        $('.loader').show();
        $.ajax({
            url: "{{route('teacher.acceptClass')}}",
            type: "POST",
            data: {
                id: inv_id,
                g_code: g_code
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, response.message);
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            },
            error: function(error_r) {
                $('.loader').fadeOut();
                var obj = JSON.parse(error_r.responseText);
                $.each(obj.errors, function(key, value) {
                    $.fn.notifyMe('error', 5, value);
                });
            }
        });
    });
    $(document).on('click', '[data-viewAssignment]', function() {
        var liveurl = $(this).attr("data-viewAssignment");
        if (liveurl != '') {
            //$('#viewClassModal').modal('show');
            //$("#thedialog").attr('src','https://google.com');
            window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
        } else {
            alert('No assignement url found!');
        }
    });
    // Notify Students
    $('[data-id=notify_student]').click(function() {
        var getBoxId = $(this).attr("data-notifyMe");
        var dateClass_id = $("#dateClass_id" + getBoxId).val();
        var class_id = $("#txt_class_id" + getBoxId).val();
        var subject_id = $("#txt_subject_id" + getBoxId).val();
        var g_meet_url = $("#txt_gMeetURL" + getBoxId).val();
        if (g_meet_url == '') {
            $.fn.notifyMe('error', 5, 'First update the JOIN LIVE class link');
            return false;
        }
        $('.loader').show();
        $.ajax({
            url: '{{ url("student-notify") }}',
            type: "POST",
            data: {
                class_id: class_id,
                subject_id: subject_id,
                dateClass_id: dateClass_id,
                g_meet_url: g_meet_url
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $(this).prop('disable', true);
                $('#notifyurl_' + getBoxId + ' span').text('Sending...');
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, response.message);
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            },
            complete: function() {
                $('.loader').fadeOut();
                $(this).prop('disable', false);
                $('#notifyurl_' + getBoxId + ' span').text('Announcement');
            },
            error: function(error_r) {
                $('.loader').fadeOut();
                $(this).prop('disable', false);
                $('#notifyurl_' + getBoxId + ' span').text('Announcement');
                var obj = JSON.parse(error_r.responseText);
                $.each(obj.errors, function(key, value) {
                    $.fn.notifyMe('error', 5, value);
                });
            }
        });
    });

    // Description or Class  note
    $(document).on('mouseover', '.text-editwrapper textarea', function() {
        $(this).prop("disabled", false);
    });
    $(document).on('mouseout', '.text-editwrapper textarea', function() {
        $(this).prop("disabled", true);
    });
    $(document).on('focusout', '.text-editwrapper textarea', function() {
        var thiz = $(this);
        var id = thiz.parent().find('.text-edit1').attr('data-savedesc');
        var getDescText = (thiz.parent().find('.text-edit1').val().replace(/\$/g, '')).trim();
        var dateClass_id = $("#dateClass_id" + id).val();


        if (getDescText.length > 255) {
            $.fn.notifyMe('error', 4, 'Not To be Exceed More than 255 Char,You have Written ' + getDescText.length + ' Char');
        } else {
            $('.loader').show();
            $.ajax({
                type: 'POST',
                url: '{{ url("update-classNotes") }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'dateClass_id': dateClass_id,
                    'description': getDescText
                },
                success: function(result) {
                    $('.loader').fadeOut();
                    var response = JSON.parse(result);

                    if (response.status == 'success') {
                        $.fn.notifyMe('success', 5, response.message);
                        $("#txt_desc" + id).val(getDescText);
                    } else {
                        $.fn.notifyMe('error', 5, response.message);
                    }


                    //$.fn.notifyMe('success',4,'Description has been saved!');
                },
                error: function() {
                    $('.loader').fadeOut();
                    // thiz.parent().find('.text-edit').removeClass('active');
                    $.fn.notifyMe('error', 4, 'There is some error while saving class note text!');
                }
            });
        }
    });


    function viewPastClass(id) {
        var class_date = $('#pastclassdata' + id).val();
        $('#plclasses').hide();
        $.ajax({
            type: 'GET',
            url: '{{ url("/teacher/class/viewPastClass") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'class_date': class_date,
            },
            success: function(result) {
                $('#plclasses').html(result);
                $('#plclasses').show();

            },
            error: function() {}
        });
        $('active1').addClass('bgcolor');
        //var class_date1 = $('#pastclassdata{{$i}}');
        //console.log(class_date1);
    }

    function viewFutureClass(id) {
        var class_date = $('#futureclassdata' + id).val();
        $('#upcomingclasses').hide();
        $.ajax({
            type: 'GET',
            url: '{{ url("/teacher/class/viewFutureClass") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'class_date': class_date,
            },
            success: function(result) {
                $('#upcomingclasses').html(result);
                $('#upcomingclasses').show();

            },
            error: function() {}
        });
        $('active1').addClass('bgcolor');
        //var class_date1 = $('#pastclassdata{{$i}}');
        //console.log(class_date1);
    }

    function viewAssignment(id) {
        $('.loader').show();
        $.ajax({
            type: 'POST',
            url: '{{ url("/teacher/class/assignments") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'class_id': id,
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                let data = '';
                response.data.forEach(function(classAssignment) {
                    $('#assignmentList').find('tbody').find('tr').remove();
                    data += '<tr>';
                    data += '<td>' + classAssignment.g_title + '</td>';
                    data += '<td><a href="' + classAssignment.g_live_link + '" class="text-decoration-none" target="_blank">Check Assignment</a></td>';
                    data += '<td><a href="' + classAssignment.g_live_link.replace("details", "submissions") + '" class="text-decoration-none" target="_blank">Check Submissions</a></td>';
                    data += '</tr>';

                    $('#assignmentList').find('tbody').append(data);
                });
                if (data) {
                    $('#viewassigment').removeClass('d-none')

                }
            },
            error: function() {
                $('.loader').fadeOut();
                $.fn.notifyMe('error', 4, 'There is some error while searching for assignment!');
            }
        });
    }
</script>
<script>
    // $('#sel_topic').blur(function() {
    //     if ($(this).val().length != 0) {
    //         $('#txt_topin_name').attr('disabled', 'disabled');
    //     }
    // });
    // $('#txt_topin_name').blur(function() {
    //     if ($(this).val().length != 0) {
    //         $('#sel_topic').attr('disabled', 'disabled');
    //     }
    // });
</script>
<script>
    $(document).ready(function() {
        $('input[id=t1radio]').on('click',
            function() {
                $('.asg1').prop("disabled", false);
                $('.asg2').prop("disabled", true);
                $('.asg2').prop("value", "");
            });
        $('input[id=t2radio]').on('click',
            function() {
                $('.asg2').prop("disabled", false);
                $('.asg1').prop("disabled", true);
                $('.asg1').prop("value", "");
            });
    });

    function shareContent(url, dateClass_id) {
        var notificationMsg = "Please go through " + url + " for today's notes";

        $('.loader').show();
        $.ajax({
            url: "{{url('student-notify')}}",
            type: "POST",
            data: {
                notificationMsg: notificationMsg,
                dateClass_id: dateClass_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('.loader').fadeOut();
                var response = JSON.parse(result);
                if (response.status == 'success') {
                    $.fn.notifyMe('success', 5, 'Content shared successfully');
                } else {
                    $.fn.notifyMe('error', 5, response.message);
                }
            },
            error: function(error_r) {
                $('.loader').fadeOut();
                var obj = JSON.parse(error_r.responseText);
                $.each(obj.errors, function(key, value) {
                    $.fn.notifyMe('error', 5, value);
                });
            }
        });
    }
</script>

<script>
    $('.chapter').change('[data-chapter]', function() {
        var getChapter = $(this).val();
        var id = $(this).attr('data-chapter');
        var class_name = $("#txt_class_name" + id).val();
        var subject_id = $("#txt_subject_id" + id).val();
        //alert(id);
        if (getChapter != '') {
            $('.loader').show();
            $.ajax({
                type: 'Get',
                url: '{{ route("get-topic") }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'chapter': getChapter,
                    'class': class_name,
                    'subject': subject_id
                },
                success: function(result) {
                    $('.loader').fadeOut();
                    var response = JSON.parse(result);
                    if (response || getChapter == "Select Chapter") {
                        $("#chapterTopic" + id).empty();
                        $("#chapterTopic" + id).append('<option>Select Topic</option>');
                        $.each(response, function(key, value) {
                            $('#chapterTopic' + id).append('<option value="' + key + '">' + value + '</option>').show();
                        });

                    } else {
                        $('.topics').empty();
                    }
                },
                error: function() {
                    $('.loader').fadeOut();
                    $.fn.notifyMe('error', 4, 'There is some error while saving description text!');
                }
            });

        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#teacherlist').DataTable();
    });
</script>
@endsection